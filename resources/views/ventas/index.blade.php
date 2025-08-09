<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-400 dark:to-purple-400">
                {{ __('Historial de Ventas') }}
            </h2>
            <div class="flex gap-3">
                <a href="{{ route('ventas.registro_venta') }}"
                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-emerald-600 to-cyan-600 hover:from-emerald-700 hover:to-cyan-700 text-white text-sm font-medium rounded-lg shadow-md transition-all duration-300 hover:shadow-lg transform hover:-translate-y-0.5">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Nueva Venta
                </a>
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg shadow-md transition-all duration-300 hover:shadow-lg transform hover:-translate-y-0.5">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2v1M9 7V5a2 2 0 012-2h2a2 2 0 012 2v2M13 7h-2"></path>
                    </svg>
                    Dashboard
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Mensajes flash -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-gradient-to-r from-green-50 to-green-100 border-l-4 border-green-400 text-green-700 rounded-lg shadow-sm animate-fade-in">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if(session('warning'))
                <div class="mb-6 p-4 bg-gradient-to-r from-yellow-50 to-yellow-100 border-l-4 border-yellow-400 text-yellow-700 rounded-lg shadow-sm animate-fade-in">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ session('warning') }}
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-gradient-to-r from-red-50 to-red-100 border-l-4 border-red-400 text-red-700 rounded-lg shadow-sm animate-fade-in">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            <!-- Estadísticas rápidas -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-6 rounded-xl text-white shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm font-medium">Total Ventas</p>
                            <p class="text-2xl font-bold">{{ $ventas->total() ?? $ventas->count() }}</p>
                        </div>
                        <div class="p-3 bg-white bg-opacity-20 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-green-500 to-green-600 p-6 rounded-xl text-white shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm font-medium">Ingresos Totales</p>
                            <p class="text-2xl font-bold">Q{{ number_format($ventas->sum('total'), 2) }}</p>
                        </div>
                        <div class="p-3 bg-white bg-opacity-20 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-purple-500 to-purple-600 p-6 rounded-xl text-white shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-sm font-medium">Promedio por Venta</p>
                            <p class="text-2xl font-bold">Q{{ $ventas->count() > 0 ? number_format($ventas->avg('total'), 2) : '0.00' }}</p>
                        </div>
                        <div class="p-3 bg-white bg-opacity-20 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-6 rounded-xl text-white shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-orange-100 text-sm font-medium">Ventas Hoy</p>
                            <p class="text-2xl font-bold">{{ $ventas->where('fecha', '>=', today())->count() }}</p>
                        </div>
                        <div class="p-3 bg-white bg-opacity-20 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabla de ventas -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                <!-- Header de la tabla -->
                <div class="bg-gradient-to-r from-blue-600 to-purple-600 p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="p-3 bg-white bg-opacity-20 rounded-lg mr-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold">Registro de Ventas</h3>
                                <p class="text-blue-100">Historial completo de transacciones</p>
                            </div>
                        </div>
                        
                        <!-- Filtros (futuro) -->
                        <div class="hidden md:flex space-x-2">
                            <button class="px-4 py-2 bg-white bg-opacity-20 rounded-lg hover:bg-opacity-30 transition-all duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                @if($ventas->isEmpty())
                    <div class="p-12 text-center">
                        <div class="max-w-md mx-auto">
                            <div class="mx-auto w-24 h-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-6">
                                <svg class="w-12 h-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-3">No hay ventas registradas</h3>
                            <p class="text-gray-500 dark:text-gray-400 mb-6">Comienza registrando tu primera venta para ver el historial aquí.</p>
                            <a href="{{ route('ventas.registro_venta') }}"
                               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-600 to-cyan-600 hover:from-emerald-700 hover:to-cyan-700 text-white font-medium rounded-lg shadow-lg transition-all duration-300 hover:shadow-xl transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Registrar Primera Venta
                            </a>
                        </div>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        ID / Fecha
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Cliente
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Total
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Productos
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($ventas as $venta)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                        <!-- ID y Fecha -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-sm mr-3">
                                                    {{ $venta->id }}
                                                </div>
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                        Venta #{{ $venta->id }}
                                                    </div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                                        {{ $venta->created_at ? $venta->created_at->format('d/m/Y H:i') : ($venta->fecha ? \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y H:i') : 'Sin fecha') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Cliente -->
                                        <td class="px-6 py-4">
                                            <div>
                                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                    {{ $venta->nombre_cliente ?? 'Cliente no encontrado' }}
                                                </div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                                    NIT: {{ $venta->nit ?? 'N/A' }}
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Total -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-lg font-bold text-green-600 dark:text-green-400">
                                                Q{{ number_format($venta->total, 2) }}
                                            </div>
                                        </td>

                                        <!-- Productos -->
                                        <td class="px-6 py-4">
                                            <div class="max-w-xs">
                                                @if($venta->detalles && $venta->detalles->count() > 0)
                                                    <div class="space-y-1">
                                                        @foreach ($venta->detalles->take(2) as $detalle)
                                                            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-2 text-xs">
                                                                <div class="font-medium text-gray-800 dark:text-gray-200">
                                                                    <span class="producto-nombre" data-id="{{ $detalle->producto_nombre }}">
                                                                        Producto ID: {{ $detalle->producto_nombre }}
                                                                    </span>
                                                                </div>
                                                                <div class="text-gray-600 dark:text-gray-400">
                                                                    {{ $detalle->cantidad }} x Q{{ number_format($detalle->precio_unitario, 2) }}
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        @if($venta->detalles->count() > 2)
                                                            <div class="text-xs text-gray-500 dark:text-gray-400 text-center">
                                                                +{{ $venta->detalles->count() - 2 }} productos más
                                                            </div>
                                                        @endif
                                                    </div>
                                                @else
                                                    <span class="text-gray-500 dark:text-gray-400 text-sm">Sin detalles</span>
                                                @endif
                                            </div>
                                        </td>

                                        <!-- Acciones -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex justify-center">
                                                <button onclick="verDetalle({{ $venta->id }})"
                                                        class="inline-flex items-center px-4 py-2 bg-blue-100 hover:bg-blue-200 text-blue-800 text-sm font-medium rounded-lg transition-all duration-300 hover:shadow-md transform hover:-translate-y-0.5">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                    Ver Detalle
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    @if(method_exists($ventas, 'links'))
                        <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4">
                            {{ $ventas->links() }}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>

    <!-- Modal para ver detalle (futuro) -->
    <div id="modalDetalle" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Detalle de Venta</h3>
                    <button onclick="cerrarModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div id="contenidoModal">
                    <!-- Contenido dinámico -->
                </div>
            </div>
        </div>
    </div>

    <script>
        // Cache para nombres de productos
        let productosCache = {};
        
        // Cargar nombres de productos al cargar la página
        document.addEventListener('DOMContentLoaded', async function() {
            await cargarNombresProductos();
        });

        async function cargarNombresProductos() {
            try {
                const response = await fetch('http://127.0.0.1:5002/productos');
                if (!response.ok) throw new Error('Error cargando productos');
                
                const productos = await response.json();
                
                // Crear cache de productos
                productos.forEach(producto => {
                    productosCache[producto.id] = producto.nombre;
                });

                // Actualizar nombres en la tabla
                document.querySelectorAll('.producto-nombre').forEach(elemento => {
                    const id = elemento.dataset.id;
                    if (productosCache[id]) {
                        elemento.textContent = productosCache[id];
                        elemento.classList.add('text-green-600', 'font-medium');
                    } else {
                        elemento.textContent = `Producto ID: ${id}`;
                        elemento.classList.add('text-gray-500');
                    }
                });

            } catch (error) {
                console.warn('No se pudieron cargar los nombres de productos:', error);
                // Mantener los IDs como fallback
            }
        }

        function verDetalle(ventaId) {
            const modal = document.getElementById('modalDetalle');
            const contenido = document.getElementById('contenidoModal');
            
            // Mostrar loading
            contenido.innerHTML = `
                <div class="flex items-center justify-center py-12">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-500"></div>
                    <span class="ml-3 text-gray-600 dark:text-gray-300">Cargando detalles...</span>
                </div>
            `;
            
            modal.classList.remove('hidden');
            
            // Buscar datos de la venta en la tabla actual
            const filaVenta = Array.from(document.querySelectorAll('tbody tr')).find(fila => {
                const idElement = fila.querySelector('.w-10');
                return idElement && idElement.textContent.trim() == ventaId;
            });

            if (filaVenta) {
                // Extraer información de la fila
                const fecha = filaVenta.querySelector('.text-xs').textContent.trim();
                const cliente = filaVenta.querySelector('td:nth-child(2) .text-sm').textContent.trim();
                const nit = filaVenta.querySelector('td:nth-child(2) .text-xs').textContent.replace('NIT: ', '').trim();
                const total = filaVenta.querySelector('.text-green-600').textContent.trim();
                
                // Obtener detalles de productos
                const productosDiv = filaVenta.querySelector('td:nth-child(4) .space-y-1');
                let productosHtml = '';
                
                if (productosDiv) {
                    const productos = productosDiv.querySelectorAll('.bg-gray-100');
                    productos.forEach((producto, index) => {
                        const nombre = producto.querySelector('.font-medium').textContent.trim();
                        const cantidad = producto.querySelector('.text-gray-600').textContent.trim();
                        
                        productosHtml += `
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 ${index > 0 ? 'mt-3' : ''}">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <h4 class="font-medium text-gray-900 dark:text-gray-100">${nombre}</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">${cantidad}</p>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    
                    // Si hay más productos
                    const masProductos = productosDiv.querySelector('.text-center');
                    if (masProductos) {
                        productosHtml += `
                            <div class="text-center text-sm text-gray-500 dark:text-gray-400 mt-3 p-3 bg-gray-100 dark:bg-gray-700 rounded-lg">
                                ${masProductos.textContent}
                            </div>
                        `;
                    }
                } else {
                    productosHtml = '<p class="text-gray-500 dark:text-gray-400">No se encontraron detalles de productos</p>';
                }

                setTimeout(() => {
                    contenido.innerHTML = `
                        <div class="space-y-6">
                            <!-- Header de la venta -->
                            <div class="bg-gradient-to-r from-blue-500 to-purple-600 -m-6 mb-6 p-6 text-white">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="text-2xl font-bold">Venta #${ventaId}</h4>
                                        <p class="text-blue-100 text-sm">${fecha}</p>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-3xl font-bold">${total}</div>
                                        <div class="text-blue-100 text-sm">Total</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Información del cliente -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="bg-blue-50 dark:bg-blue-900 p-4 rounded-lg">
                                    <h5 class="font-semibold text-blue-800 dark:text-blue-200 mb-2 flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        Cliente
                                    </h5>
                                    <p class="text-blue-700 dark:text-blue-300 font-medium">${cliente}</p>
                                    <p class="text-blue-600 dark:text-blue-400 text-sm">${nit}</p>
                                </div>

                                <div class="bg-green-50 dark:bg-green-900 p-4 rounded-lg">
                                    <h5 class="font-semibold text-green-800 dark:text-green-200 mb-2 flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        Fecha
                                    </h5>
                                    <p class="text-green-700 dark:text-green-300 font-medium">${fecha}</p>
                                </div>
                            </div>

                            <!-- Productos -->
                            <div>
                                <h5 class="font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                    Productos Vendidos
                                </h5>
                                <div class="space-y-3">
                                    ${productosHtml}
                                </div>
                            </div>

                            <!-- Resumen -->
                            <div class="border-t border-gray-200 dark:border-gray-600 pt-6">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-semibold text-gray-800 dark:text-gray-200">Total de la Venta:</span>
                                    <span class="text-2xl font-bold text-green-600 dark:text-green-400">${total}</span>
                                </div>
                            </div>
                        </div>
                    `;
                }, 500);
            } else {
                setTimeout(() => {
                    contenido.innerHTML = `
                        <div class="text-center py-8">
                            <div class="text-red-500 mb-4">
                                <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.732 15c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Error al cargar</h4>
                            <p class="text-gray-600 dark:text-gray-400">No se pudieron cargar los detalles de la venta.</p>
                        </div>
                    `;
                }, 500);
            }
        }
        
        function cerrarModal() {
            document.getElementById('modalDetalle').classList.add('hidden');
        }
        
        // Cerrar modal al hacer clic fuera
        document.getElementById('modalDetalle').addEventListener('click', function(e) {
            if (e.target === this) {
                cerrarModal();
            }
        });

        // Cerrar modal con tecla Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                cerrarModal();
            }
        });
    </script>

    <style>
        @keyframes fade-in {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .animate-fade-in {
            animation: fade-in 0.5s ease-out;
        }
    </style>
</x-app-layout>