<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-cyan-600 dark:from-emerald-400 dark:to-cyan-400">
                {{ __('Nueva Venta') }}
            </h2>
            <a href="{{ route('dashboard') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg shadow-md transition-all duration-300 hover:shadow-lg transform hover:-translate-y-0.5">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Volver al Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
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

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                <!-- Header del formulario -->
                <div class="bg-gradient-to-r from-emerald-500 to-cyan-600 p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-white bg-opacity-20 rounded-lg mr-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold">Registrar Nueva Venta</h3>
                            <p class="text-emerald-100">Complete los datos del cliente y productos</p>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('ventas.guardar') }}" class="p-8 space-y-8" id="ventaForm">
                    @csrf

                    <!-- Sección Cliente -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900 dark:to-indigo-900 p-6 rounded-xl border border-blue-200 dark:border-blue-700">
                        <h4 class="text-lg font-semibold text-blue-800 dark:text-blue-200 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Datos del Cliente
                        </h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="nit" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    NIT del Cliente <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input id="nit" name="nit" type="text" required
                                           class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300"
                                           placeholder="Ingrese el NIT" />
                                    <div class="absolute right-3 top-3 hidden" id="nitLoader">
                                        <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-blue-500"></div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="nombre_cliente" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Nombre del Cliente
                                </label>
                                <input id="nombre_cliente" name="nombre_cliente" type="text" readonly
                                       class="w-full border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-900 dark:text-gray-100 rounded-lg px-4 py-3"
                                       placeholder="Se completará automáticamente" />
                            </div>
                        </div>

                        <!-- Selector de cliente predefinido -->
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                O seleccione un cliente:
                            </label>
                            <select id="cliente_select" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Seleccione un cliente</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente['nit'] }}" data-nombre="{{ $cliente['nombre_completo'] }}">
                                        {{ $cliente['nombre_completo'] }} - {{ $cliente['nit'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Sección Productos -->
                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900 dark:to-pink-900 p-6 rounded-xl border border-purple-200 dark:border-purple-700">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="text-lg font-semibold text-purple-800 dark:text-purple-200 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                Productos de la Venta
                            </h4>
                            <button type="button" onclick="agregarProducto()"
                                    class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium rounded-lg shadow-md transition-all duration-300 hover:shadow-lg transform hover:-translate-y-0.5">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Agregar Producto
                            </button>
                        </div>

                        <div id="productos" class="space-y-4">
                            <div class="producto bg-white dark:bg-gray-700 p-6 rounded-lg border border-gray-200 dark:border-gray-600 shadow-sm relative">
                                <button type="button" onclick="eliminarProducto(this)" 
                                        class="absolute top-3 right-3 text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 p-2 rounded-full hover:bg-red-100 dark:hover:bg-red-900 transition-all duration-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>

                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="producto_nombre_0">
                                            Producto <span class="text-red-500">*</span>
                                        </label>
                                        <select id="producto_nombre_0" name="productos[0][producto_nombre]" required
                                                class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all duration-300">
                                            <option value="">Seleccione un producto</option>
                                            @foreach ($productos as $producto)
                                                <option value="{{ $producto['id'] }}" data-precio="{{ $producto['precio_unitario'] }}" data-stock="{{ $producto['stock'] }}">
                                                    {{ $producto['nombre'] }} (Stock: {{ $producto['stock'] }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1" id="stock_info_0">
                                            Seleccione un producto para ver el stock disponible
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="cantidad_0">
                                            Cantidad <span class="text-red-500">*</span>
                                        </label>
                                        <input id="cantidad_0" type="number" name="productos[0][cantidad]" required min="1"
                                               class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all duration-300"
                                               placeholder="1" />
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="precio_unitario_0">
                                            Precio Unitario <span class="text-red-500">*</span>
                                        </label>
                                        <input id="precio_unitario_0" type="number" step="0.01" name="productos[0][precio_unitario]" required
                                               class="w-full border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-900 dark:text-gray-100 rounded-lg px-4 py-3"
                                               readonly placeholder="Q 0.00" />
                                    </div>
                                </div>

                                <div class="mt-4 text-right">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Subtotal: </span>
                                    <span class="text-lg font-semibold text-purple-600 dark:text-purple-400" id="subtotal_0">Q 0.00</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total -->
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900 dark:to-emerald-900 p-6 rounded-xl border border-green-200 dark:border-green-700">
                        <div class="flex items-center justify-between">
                            <h4 class="text-lg font-semibold text-green-800 dark:text-green-200 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                Total de la Venta
                            </h4>
                            <div class="text-right">
                                <div class="text-3xl font-bold text-green-700 dark:text-green-300" id="total_venta">Q 0.00</div>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6">
                        <button type="submit"
                                class="flex-1 bg-gradient-to-r from-emerald-600 to-cyan-600 hover:from-emerald-700 hover:to-cyan-700 text-white font-semibold py-4 px-6 rounded-lg shadow-lg transition-all duration-300 hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center"
                                id="submitBtn">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Registrar Venta
                        </button>
                        
                        <a href="{{ route('ventas.index') }}"
                           class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-semibold py-4 px-6 rounded-lg shadow-lg transition-all duration-300 hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            Ver Ventas
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let productoIndex = 1;

        // Inicializar eventos para el primer producto
        document.addEventListener('DOMContentLoaded', function() {
            const primerSelect = document.querySelector('#producto_nombre_0');
            if (primerSelect) {
                agregarEventosProducto(primerSelect.closest('.producto'));
            }
        });

        // Selector de cliente predefinido
        document.getElementById('cliente_select').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption.value) {
                document.getElementById('nit').value = selectedOption.value;
                document.getElementById('nombre_cliente').value = selectedOption.dataset.nombre;
            } else {
                document.getElementById('nit').value = '';
                document.getElementById('nombre_cliente').value = '';
            }
        });

        // Autocompletar nombre al ingresar NIT
        document.getElementById('nit').addEventListener('blur', function() {
            const nit = this.value.trim();
            const nombreInput = document.getElementById('nombre_cliente');
            const loader = document.getElementById('nitLoader');

            if (nit.length === 0) {
                nombreInput.value = '';
                return;
            }

            loader.classList.remove('hidden');

            fetch(`http://127.0.0.1:5003/verificar_usuario?nit=${nit}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Cliente no encontrado');
                    }
                    return response.json();
                })
                .then(data => {
                    nombreInput.value = data.nombre_completo || '';
                    // Limpiar el select de clientes
                    document.getElementById('cliente_select').value = '';
                })
                .catch(() => {
                    nombreInput.value = '';
                    mostrarAlerta('No se encontró cliente con ese NIT', 'warning');
                })
                .finally(() => {
                    loader.classList.add('hidden');
                });
        });

        function agregarEventosProducto(productoDiv) {
            const select = productoDiv.querySelector('select[name*="producto_nombre"]');
            const cantidadInput = productoDiv.querySelector('input[name*="cantidad"]');
            const precioInput = productoDiv.querySelector('input[name*="precio_unitario"]');
            const stockInfo = productoDiv.querySelector('[id^="stock_info_"]');

            // Evento cuando cambia el producto seleccionado
            select.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                if (selectedOption.value) {
                    const precio = selectedOption.dataset.precio;
                    const stock = selectedOption.dataset.stock;
                    
                    precioInput.value = precio || '';
                    cantidadInput.max = stock;
                    stockInfo.textContent = `Stock disponible: ${stock} unidades`;
                    stockInfo.className = 'text-xs text-green-600 dark:text-green-400 mt-1';
                } else {
                    precioInput.value = '';
                    cantidadInput.max = '';
                    stockInfo.textContent = 'Seleccione un producto para ver el stock disponible';
                    stockInfo.className = 'text-xs text-gray-500 dark:text-gray-400 mt-1';
                }
                calcularSubtotal(productoDiv);
                calcularTotal();
            });

            // Eventos para recalcular subtotal
            cantidadInput.addEventListener('input', function() {
                const max = parseInt(this.max);
                const value = parseInt(this.value);
                
                if (max && value > max) {
                    mostrarAlerta(`La cantidad no puede exceder el stock disponible (${max})`, 'error');
                    this.value = max;
                }
                
                calcularSubtotal(productoDiv);
                calcularTotal();
            });

            precioInput.addEventListener('input', function() {
                calcularSubtotal(productoDiv);
                calcularTotal();
            });
        }

        function calcularSubtotal(productoDiv) {
            const cantidad = parseFloat(productoDiv.querySelector('input[name*="cantidad"]').value) || 0;
            const precio = parseFloat(productoDiv.querySelector('input[name*="precio_unitario"]').value) || 0;
            const subtotal = cantidad * precio;
            
            const subtotalElement = productoDiv.querySelector('[id^="subtotal_"]');
            if (subtotalElement) {
                subtotalElement.textContent = `Q ${subtotal.toFixed(2)}`;
            }
        }

        function calcularTotal() {
            let total = 0;
            document.querySelectorAll('.producto').forEach(productoDiv => {
                const cantidad = parseFloat(productoDiv.querySelector('input[name*="cantidad"]').value) || 0;
                const precio = parseFloat(productoDiv.querySelector('input[name*="precio_unitario"]').value) || 0;
                total += cantidad * precio;
            });
            
            document.getElementById('total_venta').textContent = `Q ${total.toFixed(2)}`;
        }

        function agregarProducto() {
            const productosDiv = document.getElementById('productos');
            const primerProducto = productosDiv.querySelector('.producto');
            const nuevoProducto = primerProducto.cloneNode(true);

            // Actualizar índices y limpiar valores
            nuevoProducto.querySelectorAll('select, input, [id]').forEach(el => {
                if (el.name) {
                    el.name = el.name.replace(/\[\d+\]/, `[${productoIndex}]`);
                }
                if (el.id) {
                    el.id = el.id.replace(/_\d+/, `_${productoIndex}`);
                }
                if (el.tagName === 'SELECT') {
                    el.selectedIndex = 0;
                } else if (el.tagName === 'INPUT') {
                    el.value = '';
                }
            });

            // Resetear texto de stock
            const stockInfo = nuevoProducto.querySelector('[id^="stock_info_"]');
            if (stockInfo) {
                stockInfo.textContent = 'Seleccione un producto para ver el stock disponible';
                stockInfo.className = 'text-xs text-gray-500 dark:text-gray-400 mt-1';
            }

            // Resetear subtotal
            const subtotalElement = nuevoProducto.querySelector('[id^="subtotal_"]');
            if (subtotalElement) {
                subtotalElement.textContent = 'Q 0.00';
            }

            productosDiv.appendChild(nuevoProducto);
            agregarEventosProducto(nuevoProducto);
            
            productoIndex++;
            
            // Animar la entrada del nuevo producto
            nuevoProducto.style.opacity = '0';
            nuevoProducto.style.transform = 'translateY(20px)';
            setTimeout(() => {
                nuevoProducto.style.transition = 'all 0.3s ease';
                nuevoProducto.style.opacity = '1';
                nuevoProducto.style.transform = 'translateY(0)';
            }, 10);
        }

        function eliminarProducto(button) {
            const productoDiv = button.closest('.producto');
            const productosDiv = document.getElementById('productos');

            if (productosDiv.children.length > 1) {
                // Animar salida
                productoDiv.style.transition = 'all 0.3s ease';
                productoDiv.style.opacity = '0';
                productoDiv.style.transform = 'translateX(-100%)';
                
                setTimeout(() => {
                    productosDiv.removeChild(productoDiv);
                    calcularTotal();
                }, 300);
            } else {
                mostrarAlerta("Debe quedar al menos un producto en la venta.", 'warning');
            }
        }

        function mostrarAlerta(mensaje, tipo = 'info') {
            // Crear elemento de alerta
            const alerta = document.createElement('div');
            alerta.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 animate-fade-in max-w-sm ${
                tipo === 'error' ? 'bg-red-100 border-l-4 border-red-400 text-red-700' :
                tipo === 'warning' ? 'bg-yellow-100 border-l-4 border-yellow-400 text-yellow-700' :
                'bg-blue-100 border-l-4 border-blue-400 text-blue-700'
            }`;
            
            alerta.innerHTML = `
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        ${tipo === 'error' ? 
                            '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>' :
                            '<path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>'
                        }
                    </svg>
                    <span>${mensaje}</span>
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-gray-400 hover:text-gray-600">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            `;
            
            document.body.appendChild(alerta);
            
            // Auto-eliminar después de 5 segundos
            setTimeout(() => {
                if (alerta.parentElement) {
                    alerta.remove();
                }
            }, 5000);
        }

        // Validación del formulario antes de enviar
        document.getElementById('ventaForm').addEventListener('submit', function(e) {
            const productos = document.querySelectorAll('.producto');
            let valid = true;
            
            productos.forEach(producto => {
                const select = producto.querySelector('select[name*="producto_nombre"]');
                const cantidad = producto.querySelector('input[name*="cantidad"]');
                const precio = producto.querySelector('input[name*="precio_unitario"]');
                
                if (!select.value) {
                    mostrarAlerta('Debe seleccionar un producto', 'error');
                    valid = false;
                }
                
                if (!cantidad.value || cantidad.value <= 0) {
                    mostrarAlerta('La cantidad debe ser mayor a 0', 'error');
                    valid = false;
                }
                
                if (!precio.value || precio.value <= 0) {
                    mostrarAlerta('El precio debe ser mayor a 0', 'error');
                    valid = false;
                }
            });
            
            const nit = document.getElementById('nit').value;
            if (!nit.trim()) {
                mostrarAlerta('Debe ingresar el NIT del cliente', 'error');
                valid = false;
            }
            
            if (!valid) {
                e.preventDefault();
                return false;
            }
            
            // Mostrar loading en el botón
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-white mr-2"></div>
                Procesando venta...
            `;
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
        
        /* Estilos para campos con error */
        .campo-error {
            border-color: #ef4444 !important;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1) !important;
        }
        
        /* Hover effects mejorados */
        .producto:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
    </style>
</x-app-layout>