<!-- filepath: c:\Users\jorge\Desktop\LaravelProject\stock\resources\views\ventas\formulario.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Nueva Venta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-lg w-full">
        <h1 class="text-2xl font-semibold mb-6 text-center">Registrar Venta</h1>

        @if(session('success'))
            <p class="mb-4 p-3 bg-green-100 text-green-700 rounded">{{ session('success') }}</p>
        @endif

        @if(session('error'))
            <p class="mb-4 p-3 bg-red-100 text-red-700 rounded">{{ session('error') }}</p>
        @endif

        <form method="POST" action="{{ route('ventas.guardar') }}" class="space-y-6">
            @csrf

            <!-- Datos Cliente -->
            <div class="mb-4">
                <label for="nit" class="block text-gray-700 font-medium mb-1">NIT Cliente:</label>
                <input id="nit" name="nit" type="text" required
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <div class="mb-4">
                <label for="nombre_cliente" class="block text-gray-700 font-medium mb-1">Nombre Cliente:</label>
                <input id="nombre_cliente" name="nombre_cliente" type="text" readonly
                       class="w-full border border-gray-300 bg-gray-100 rounded px-3 py-2" />
            </div>

            <!-- Productos -->
            <div id="productos" class="space-y-4">
                <div class="producto bg-gray-50 p-4 rounded border border-gray-300 relative">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1" for="producto_id_0">Producto:</label>
                        <select id="producto_id_0" name="productos[0][producto_id]" required
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Seleccione un producto</option>
                            @foreach ($productos as $producto)
                                <option value="{{ $producto['id'] }}">
                                    {{ $producto['nombre'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1" for="cantidad_0">Cantidad:</label>
                        <input id="cantidad_0" type="number" name="productos[0][cantidad]" required min="1"
                               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1" for="precio_unitario_0">Precio unitario:</label>
                        <input id="precio_unitario_0" type="number" step="0.01" name="productos[0][precio_unitario]" required
                               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                               readonly />
                    </div>

                    <!-- Botón eliminar producto -->
                    <button type="button" onclick="eliminarProducto(this)" 
                        class="absolute top-2 right-2 text-red-600 hover:text-red-800 font-bold rounded px-2 py-1 border border-red-600 hover:bg-red-100 transition">
                        Eliminar
                    </button>
                </div>
            </div>

            <button type="button" class="bg-gray-300 hover:bg-gray-400 rounded px-4 py-2 font-semibold" onclick="agregarProducto()">
                Agregar otro producto
            </button>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded transition-colors duration-300">
                Registrar venta
            </button>
        </form>
    </div>

    <script>
        let productoIndex = 1;

        // Autocompletar precio unitario al seleccionar producto
        function agregarEventoPrecioUnitario(select) {
            select.addEventListener('change', function() {
                const productoId = this.value;
                const precioInput = this.closest('.producto').querySelector('input[name$="[precio_unitario]"]');
                if (!productoId) {
                    precioInput.value = '';
                    return;
                }
                fetch(`http://127.0.0.1:5002/productos/${productoId}`)
                    .then(response => {
                        if (!response.ok) throw new Error('No se pudo obtener el producto');
                        return response.json();
                    })
                    .then(data => {
                        precioInput.value = data.precio_unitario || '';
                    })
                    .catch(() => {
                        precioInput.value = '';
                        alert('No se pudo obtener el precio del producto');
                    });
            });
        }

        // Inicializa el evento para el primer select
        document.querySelectorAll('.producto select[name^="productos"]').forEach(agregarEventoPrecioUnitario);

        function agregarProducto() {
            const productosDiv = document.getElementById('productos');
            const primerProducto = productosDiv.querySelector('.producto');
            const nuevoProducto = primerProducto.cloneNode(true);

            nuevoProducto.querySelectorAll('select, input').forEach(el => {
                if(el.name) {
                    el.name = el.name.replace(/\d+/, productoIndex);
                }
                if(el.id) {
                    el.id = el.id.replace(/\d+/, productoIndex);
                }
                if(el.tagName === 'SELECT') {
                    el.selectedIndex = 0;
                } else if(el.tagName === 'INPUT') {
                    el.value = '';
                }
            });

            productosDiv.appendChild(nuevoProducto);
            // Agrega el evento al nuevo select
            agregarEventoPrecioUnitario(nuevoProducto.querySelector('select[name^="productos"]'));
            productoIndex++;
        }

        function eliminarProducto(button) {
            const productoDiv = button.closest('.producto');
            const productosDiv = document.getElementById('productos');

            // No eliminar si solo queda un producto para evitar formulario vacío
            if (productosDiv.children.length > 1) {
                productosDiv.removeChild(productoDiv);
            } else {
                alert("Debe quedar al menos un producto en la venta.");
            }
        }

        // Autocompletar nombre al ingresar NIT
        document.getElementById('nit').addEventListener('blur', function() {
            const nit = this.value.trim();
            const nombreInput = document.getElementById('nombre_cliente');

            if (nit.length === 0) {
                nombreInput.value = '';
                return;
            }

            fetch(`http://127.0.0.1:5003/verificar_usuario?nit=${nit}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Cliente no encontrado');
                    }
                    return response.json();
                })
                .then(data => {
                    nombreInput.value = data.nombre || '';
                })
                .catch(() => {
                    nombreInput.value = '';
                    alert('No se encontró cliente con ese NIT');
                });
        });
    </script>
</body>
</html>