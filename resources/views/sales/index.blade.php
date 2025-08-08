<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Ventas Registradas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-indigo-100 via-white to-indigo-100 min-h-screen p-8 flex items-center justify-center">
    <div class="max-w-6xl w-full bg-white p-8 rounded-xl shadow-lg">
        
        <!-- Botón Cerrar sesión -->
        <div class="flex justify-end mb-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded shadow transition-colors duration-300">
                    Cerrar sesión
                </button>
            </form>
        </div>

        <h1 class="text-4xl font-extrabold mb-8 text-center text-indigo-700 drop-shadow-md">Ventas Registradas</h1>

        {{-- Mensajes flash --}}
        @if(session('success'))
            <p class="mb-6 p-4 bg-green-100 text-green-700 rounded shadow">
                {{ session('success') }}
            </p>
        @endif

        @if(session('error'))
            <p class="mb-6 p-4 bg-red-100 text-red-700 rounded shadow">
                {{ session('error') }}
            </p>
        @endif

        @if($ventas->isEmpty())
            <p class="text-gray-600 text-center py-8">No se han registrado ventas aún.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300 rounded-lg">
                    <thead>
                        <tr class="bg-indigo-200 text-left text-indigo-900 font-semibold">
                            <th class="p-4 border-b border-indigo-300">ID Venta</th>
                            <th class="p-4 border-b border-indigo-300">Fecha</th>
                            <th class="p-4 border-b border-indigo-300">Cliente</th>
                            <th class="p-4 border-b border-indigo-300">NIT</th>
                            <th class="p-4 border-b border-indigo-300">Total</th>
                            <th class="p-4 border-b border-indigo-300">Detalles</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ventas as $venta)
                            <tr class="border-b border-indigo-300 hover:bg-indigo-50 transition-colors">
                                <td class="p-4 align-top">{{ $venta->id }}</td>
                                <td class="p-4 align-top">{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                                <td class="p-4 align-top font-medium">{{ $venta->nombre_cliente ?? 'N/A' }}</td>
                                <td class="p-4 align-top">{{ $venta->nit ?? 'N/A' }}</td>
                                <td class="p-4 align-top font-semibold text-indigo-700">Q{{ number_format($venta->total, 2) }}</td>
                                <td class="p-4 align-top">
                                    <ul class="list-disc pl-5 space-y-1 text-sm text-gray-700 max-w-xs">
                                        @foreach ($venta->detalles as $detalle)
                                            <li>
                                                Producto ID: {{ $detalle->producto_id }},<br>
                                                Cantidad: {{ $detalle->cantidad }},<br>
                                                Precio unitario: Q{{ number_format($detalle->precio_unitario, 2) }},<br>
                                                Subtotal: Q{{ number_format($detalle->subtotal, 2) }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div class="mt-8 text-center">
            <a href="{{ route('ventas.formulario') }}" 
               class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded shadow transition-colors duration-300">
                Registrar nueva venta
            </a>
        </div>
    </div>
</body>
</html>
