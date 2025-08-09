<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600 dark:from-purple-400 dark:to-pink-400">
                {{ __('Sistema de Ventas') }}
            </h2>
            <div class="flex items-center space-x-2">
                <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                <span class="text-sm text-gray-600 dark:text-gray-300">Sistema activo</span>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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

            <!-- Bienvenida -->
            <div class="bg-gradient-to-br from-purple-500 via-pink-500 to-indigo-600 rounded-2xl shadow-xl p-8 mb-8 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white bg-opacity-10 rounded-full -mr-16 -mt-16"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-white bg-opacity-10 rounded-full -ml-12 -mb-12"></div>
                
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-3xl font-bold mb-2 animate-fade-in-up">
                                ¡Bienvenido/a, {{ Auth::user()->name }}! 👋
                            </h1>
                            <p class="text-purple-100 text-lg animate-fade-in-up animation-delay-200">
                                Gestiona tu negocio de manera eficiente con nuestro sistema integral
                            </p>
                        </div>
                        <div class="hidden lg:block">
                            <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center backdrop-blur-sm">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cards de acciones principales -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Nueva Venta -->
                <a href="{{ route('ventas.registro_venta') }}" class="group">
                    <div class="bg-gradient-to-br from-emerald-400 to-cyan-500 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 text-white">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-white bg-opacity-20 rounded-lg">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </div>
                            <div class="text-right">
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Nueva Venta</h3>
                        <p class="text-emerald-100">Registra una nueva transacción</p>
                    </div>
                </a>

                <!-- Ver Ventas -->
                <a href="{{ route('ventas.index') }}" class="group">
                    <div class="bg-gradient-to-br from-blue-500 to-purple-600 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 text-white">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-white bg-opacity-20 rounded-lg">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <div class="text-right">
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Ver Ventas</h3>
                        <p class="text-blue-100">Consulta el historial de transacciones</p>
                    </div>
                </a>

                <!-- Gestionar Stock -->
                <a href="#" class="group" onclick="alert('Función en desarrollo')">
                    <div class="bg-gradient-to-br from-orange-400 to-red-500 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 text-white">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-white bg-opacity-20 rounded-lg">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <div class="text-right">
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Gestionar Stock</h3>
                        <p class="text-orange-100">Administra tu inventario</p>
                    </div>
                </a>

                <!-- Reportes -->
                <a href="#" class="group" onclick="alert('Función en desarrollo')">
                    <div class="bg-gradient-to-br from-violet-500 to-purple-600 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 text-white">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-white bg-opacity-20 rounded-lg">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div class="text-right">
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Reportes</h3>
                        <p class="text-violet-100">Analiza el rendimiento del negocio</p>
                    </div>
                </a>
            </div>

            <!-- Estadísticas rápidas -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8">
                <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-3 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    Resumen del día
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Total ventas hoy -->
                    <div class="bg-gradient-to-r from-green-50 to-green-100 dark:from-green-900 dark:to-green-800 p-6 rounded-xl border border-green-200 dark:border-green-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-green-600 dark:text-green-400 text-sm font-medium">Ventas de hoy</p>
                                <p class="text-2xl font-bold text-green-700 dark:text-green-300">
                                    @if(isset($ventas))
                                        {{ $ventas->where('fecha', '>=', today())->count() }}
                                    @else
                                        0
                                    @endif
                                </p>
                            </div>
                            <div class="p-3 bg-green-200 dark:bg-green-700 rounded-full">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Total ingresos -->
                    <div class="bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900 dark:to-blue-800 p-6 rounded-xl border border-blue-200 dark:border-blue-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-blue-600 dark:text-blue-400 text-sm font-medium">Ingresos del día</p>
                                <p class="text-2xl font-bold text-blue-700 dark:text-blue-300">
                                    Q{{ number_format(isset($ventas) ? $ventas->where('fecha', '>=', today())->sum('total') : 0, 2) }}
                                </p>
                            </div>
                            <div class="p-3 bg-blue-200 dark:bg-blue-700 rounded-full">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Estado del sistema -->
                    <div class="bg-gradient-to-r from-purple-50 to-purple-100 dark:from-purple-900 dark:to-purple-800 p-6 rounded-xl border border-purple-200 dark:border-purple-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-purple-600 dark:text-purple-400 text-sm font-medium">Microservicios</p>
                                <p class="text-2xl font-bold text-purple-700 dark:text-purple-300">Activos</p>
                            </div>
                            <div class="p-3 bg-purple-200 dark:bg-purple-700 rounded-full">
                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes fade-in-up {
            from { 
                opacity: 0;
                transform: translateY(20px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in {
            animation: fade-in 0.5s ease-out;
        }
        
        .animate-fade-in-up {
            animation: fade-in-up 0.6s ease-out;
        }
        
        .animation-delay-200 {
            animation-delay: 0.2s;
            animation-fill-mode: both;
        }
    </style>
</x-app-layout>