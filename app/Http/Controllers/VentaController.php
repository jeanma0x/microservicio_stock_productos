<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    // Mostrar el formulario de venta con productos y clientes desde microservicios
    public function crearFormulario()
    {
        // Obtener productos desde microservicio
        $responseProductos = Http::get('http://127.0.0.1:5002/productos');
        if (!$responseProductos->successful()) {
            return back()->with('error', 'No se pudieron obtener los productos del inventario.');
        }
        $productos = $responseProductos->json();

        // Obtener clientes desde microservicio
        $responseClientes = Http::get('http://127.0.0.1:5003/clientes');
        if (!$responseClientes->successful()) {
            return back()->with('error', 'No se pudieron obtener los clientes.');
        }
        $clientes = $responseClientes->json();

        // Pasar productos y clientes a la vista
        return view('ventas.formulario', compact('productos', 'clientes'));
    }

    // Registrar una venta y validar stock mediante microservicio
    public function realizarVenta(Request $request)
    {
        $request->validate([
            'productos' => 'required|array',
            'productos.*.producto_id' => 'required|integer',
            'productos.*.cantidad' => 'required|integer|min:1',
            'productos.*.precio_unitario' => 'required|numeric|min:0',
            'nit' => 'required|string', // Asumiendo que enviarás el cliente seleccionado
        ]);

        $total = 0;
        $detalles = [];

        foreach ($request->productos as $producto) {
            $response = Http::get('http://127.0.0.1:5002/verificar_stock_por_id', [
                'id' => $producto['producto_id'],
                'cantidad' => $producto['cantidad']
            ]);

            if (!$response->successful() || !$response->json('disponible')) {
                return back()->with('error', 'Producto ID ' . $producto['producto_id'] . ' sin stock suficiente.');
            }

            $subtotal = $producto['cantidad'] * $producto['precio_unitario'];
            $total += $subtotal;

            $detalles[] = [
                'producto_id' => $producto['producto_id'],
                'cantidad' => $producto['cantidad'],
                'precio_unitario' => $producto['precio_unitario'],
                'subtotal' => $subtotal
            ];
        }

        DB::beginTransaction();
        try {
            // Aquí podrías agregar el cliente_id en la venta si la tabla lo soporta
            $venta = Venta::create([
                'total' => $total,
                'nit' => $request->nit ?? null,
            ]);

            foreach ($detalles as $detalle) {
                $detalle['venta_id'] = $venta->id;
                DetalleVenta::create($detalle);
            }

            DB::commit();

            return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error al registrar la venta: ' . $e->getMessage());
        }
    }

    // Mostrar listado de ventas


public function index()
{
    $ventas = Venta::latest()->get();

    foreach ($ventas as $venta) {
        $venta->nombre_cliente = null;

        if ($venta->nit) {
            $response = \Illuminate\Support\Facades\Http::get('http://127.0.0.1:5003/verificar_usuario', [
                'nit' => $venta->nit
            ]);
            if ($response->successful()) {
                $venta->nombre_cliente = $response->json('nombre');
            }
        }
    }

    return view('ventas.index', compact('ventas'));
}
}
