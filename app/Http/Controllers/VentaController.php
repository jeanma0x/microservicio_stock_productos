<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VentaController extends Controller
{
    // Mostrar el formulario de venta con productos y clientes desde microservicios
    public function crearFormulario()
    {
        try {
            // Obtener productos desde microservicio
            $responseProductos = Http::timeout(10)->get('http://127.0.0.1:5002/productos');
            if (!$responseProductos->successful()) {
                return back()->with('error', 'No se pudieron obtener los productos del inventario. Verifique que el microservicio esté funcionando.');
            }
            $productos = $responseProductos->json();

            // Obtener clientes desde microservicio
            $responseClientes = Http::timeout(10)->get('http://127.0.0.1:5003/clientes');
            if (!$responseClientes->successful()) {
                return back()->with('error', 'No se pudieron obtener los clientes. Verifique que el microservicio SAT esté funcionando.');
            }
            $clientes = $responseClientes->json();

            return view('ventas.registro_venta', compact('productos', 'clientes'));

        } catch (\Exception $e) {
            Log::error('Error al cargar formulario de venta: ' . $e->getMessage());
            return back()->with('error', 'Error de conexión con los microservicios. Intente nuevamente.');
        }
    }

    // Registrar una venta, validar stock y descontar inventario
    public function realizarVenta(Request $request)
    {
        $request->validate([
            'productos' => 'required|array|min:1',
            'productos.*.producto_nombre' => 'required|integer',
            'productos.*.cantidad' => 'required|integer|min:1',
            'productos.*.precio_unitario' => 'required|numeric|min:0',
            'nit' => 'required|string|max:25',
        ]);

        // Verificar estado tributario del cliente
        try {
            $responseSAT = Http::timeout(10)->get('http://127.0.0.1:5003/verificar_sat', [
                'nit' => $request->nit
            ]);

            if ($responseSAT->successful()) {
                $dataSAT = $responseSAT->json();
                if (isset($dataSAT['estado_tributario']) && $dataSAT['estado_tributario']) {
                    return back()->with('error', 'El cliente tiene problemas tributarios y no puede realizar compras.');
                }
            }
        } catch (\Exception $e) {
            Log::warning('No se pudo verificar estado tributario: ' . $e->getMessage());
            // Continuar con la venta aunque no se pueda verificar SAT
        }

        $total = 0;
        $detalles = [];
        $productosParaDescuento = [];

        // Verificar stock para todos los productos antes de procesar
        foreach ($request->productos as $producto) {
            try {
                $response = Http::timeout(10)->get('http://127.0.0.1:5002/verificar_stock_por_id', [
                    'id' => $producto['producto_nombre'],
                    'cantidad' => $producto['cantidad']
                ]);

                if (!$response->successful()) {
                    return back()->with('error', 'Error al verificar stock del producto ID ' . $producto['producto_nombre']);
                }

                $stockData = $response->json();
                if (!$stockData['disponible']) {
                    return back()->with('error', 'Producto "' . ($stockData['producto'] ?? 'ID ' . $producto['producto_nombre']) . '" sin stock suficiente. Stock disponible: ' . ($stockData['stock_actual'] ?? 0));
                }

                $subtotal = $producto['cantidad'] * $producto['precio_unitario'];
                $total += $subtotal;

                $detalles[] = [
                    'producto_nombre' => $producto['producto_nombre'],
                    'cantidad' => $producto['cantidad'],
                    'precio_unitario' => $producto['precio_unitario'],
                    'subtotal' => $subtotal
                ];

                $productosParaDescuento[] = [
                    'producto_nombre' => $producto['producto_nombre'],
                    'cantidad' => $producto['cantidad']
                ];

            } catch (\Exception $e) {
                Log::error('Error verificando stock: ' . $e->getMessage());
                return back()->with('error', 'Error de conexión al verificar stock. Intente nuevamente.');
            }
        }

        // Iniciar transacción de base de datos
        DB::beginTransaction();
        
        try {
            // Crear la venta
            $venta = Venta::create([
                'total' => $total,
                'nit' => $request->nit,
                'fecha' => now(),
                // 'user_id' => auth()->id(), // Agregar el usuario que registra la venta
            ]);

            // Crear detalles de venta
            foreach ($detalles as $detalle) {
                $detalle['venta_id'] = $venta->id;
                DetalleVenta::create($detalle);
            }

            // DESCONTAR STOCK en el microservicio
            $stockDescontado = true;
            $erroresDescuento = [];

            foreach ($productosParaDescuento as $producto) {
                try {
                    $responseDescuento = Http::timeout(10)->post('http://127.0.0.1:5002/descontar_stock', [
                        'producto_nombre' => $producto['producto_nombre'],
                        'cantidad' => $producto['cantidad']
                    ]);

                    if (!$responseDescuento->successful()) {
                        $stockDescontado = false;
                        $erroresDescuento[] = "Error descontando producto ID {$producto['producto_nombre']}";
                        Log::error('Error descontando stock: ' . $responseDescuento->body());
                    }

                } catch (\Exception $e) {
                    $stockDescontado = false;
                    $erroresDescuento[] = "Error de conexión descontando producto ID {$producto['producto_nombre']}";
                    Log::error('Excepción descontando stock: ' . $e->getMessage());
                }
            }

            // Si hubo errores descontando stock, registrar pero continuar
            if (!$stockDescontado) {
                Log::warning('Venta registrada pero con errores en descuento de stock: ' . implode(', ', $erroresDescuento));
                
                // Confirmar transacción pero notificar el problema
                DB::commit();
                
                return redirect()->route('ventas.index')->with('warning', 
                    'Venta registrada correctamente (ID: ' . $venta->id . '), pero hubo problemas actualizando el inventario. Verifique manualmente el stock.');
            }

            // Todo salió bien
            DB::commit();

            return redirect()->route('ventas.index')->with('success', 
                'Venta registrada correctamente. Total: Q' . number_format($total, 2) . ' (ID: ' . $venta->id . ')');

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error registrando venta: ' . $e->getMessage());
            return back()->with('error', 'Error al registrar la venta: ' . $e->getMessage());
        }
    }

    // Mostrar listado de ventas
    public function index()
    {
        try {
            $ventas = Venta::with('detalles')
                          ->orderByDesc('fecha')
                          ->paginate(20);

            // Obtener nombres de clientes desde microservicio SAT
            foreach ($ventas as $venta) {
                $venta->nombre_cliente = 'Cliente no encontrado';

                if ($venta->nit) {
                    try {
                        $response = Http::timeout(5)->get('http://127.0.0.1:5003/verificar_usuario', [
                            'nit' => $venta->nit
                        ]);
                        
                        if ($response->successful()) {
                            $clienteData = $response->json();
                            $venta->nombre_cliente = $clienteData['nombre_completo'] ?? 'Nombre no disponible';
                        }
                    } catch (\Exception $e) {
                        Log::warning('Error obteniendo nombre cliente NIT ' . $venta->nit . ': ' . $e->getMessage());
                        // Mantener valor por defecto
                    }
                }
            }

            return view('ventas.index', compact('ventas'));

        } catch (\Exception $e) {
            Log::error('Error cargando ventas: ' . $e->getMessage());
            return back()->with('error', 'Error cargando las ventas.');
        }
    }

    // Dashboard principal mostrando resumen de ventas
    public function dashboard()
    {
        try {
            $ventas = Venta::orderByDesc('fecha')->limit(50)->get();

            // Obtener nombres de clientes para las ventas recientes
            foreach ($ventas as $venta) {
                $venta->nombre_cliente = null;

                if ($venta->nit) {
                    try {
                        $response = Http::timeout(3)->get('http://127.0.0.1:5003/verificar_usuario', [
                            'nit' => $venta->nit
                        ]);
                        
                        if ($response->successful()) {
                            $clienteData = $response->json();
                            $venta->nombre_cliente = $clienteData['nombre_completo'] ?? null;
                        }
                    } catch (\Exception $e) {
                        // Silenciar errores en dashboard para mejor UX
                        Log::warning('Error obteniendo cliente en dashboard: ' . $e->getMessage());
                    }
                }
            }

            return view('dashboard', compact('ventas'));

        } catch (\Exception $e) {
            Log::error('Error cargando dashboard: ' . $e->getMessage());
            return view('dashboard', ['ventas' => collect()]);
        }
    }

    // Método para verificar estado de microservicios (opcional)
    public function verificarMicroservicios()
    {
        $servicios = [
            'stock' => false,
            'sat' => false
        ];

        try {
            $responseStock = Http::timeout(5)->get('http://127.0.0.1:5002/health');
            $servicios['stock'] = $responseStock->successful();
        } catch (\Exception $e) {
            Log::info('Microservicio stock no disponible');
        }

        try {
            $responseSAT = Http::timeout(5)->get('http://127.0.0.1:5003/clientes');
            $servicios['sat'] = $responseSAT->successful();
        } catch (\Exception $e) {
            Log::info('Microservicio SAT no disponible');
        }

        return response()->json($servicios);
    }
}