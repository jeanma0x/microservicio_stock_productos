<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SalesFlow - Sistema de Ventas e Inventario</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
            }
            
            .floating {
                animation: floating 6s ease-in-out infinite;
            }
            
            .floating-delay {
                animation: floating 6s ease-in-out infinite;
                animation-delay: 2s;
            }
            
            @keyframes floating {
                0%, 100% { transform: translateY(0px) rotate(0deg); }
                33% { transform: translateY(-20px) rotate(2deg); }
                66% { transform: translateY(-10px) rotate(-1deg); }
            }
            
            .fade-in-up {
                animation: fadeInUp 0.8s ease-out forwards;
            }
            
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            .bg-grid {
                background-image: 
                    linear-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
                background-size: 50px 50px;
            }
        </style>
    </head>
    <body class="bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 relative">
        
        <!-- Elementos de fondo decorativos -->
        <div class="absolute inset-0 bg-grid opacity-20"></div>
        <div class="absolute top-20 left-20 w-72 h-72 bg-gradient-to-br from-emerald-400 to-cyan-500 rounded-full opacity-20 blur-3xl floating"></div>
        <div class="absolute bottom-20 right-20 w-96 h-96 bg-gradient-to-br from-purple-400 to-pink-500 rounded-full opacity-20 blur-3xl floating-delay"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-full opacity-10 blur-3xl"></div>

        @if (Route::has('login'))
            <nav class="absolute top-0 right-0 p-6 z-50">
                <div class="flex gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" 
                           class="group relative px-6 py-3 bg-white/10 backdrop-blur-xl text-white border border-white/20 rounded-xl font-medium overflow-hidden transition-all duration-300 hover:bg-white/20 hover:border-white/40 hover:scale-105">
                            <span class="relative z-10 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2v1M9 7V5a2 2 0 012-2h2a2 2 0 012 2v2M13 7h-2"></path>
                                </svg>
                                Dashboard
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-emerald-400/20 to-cyan-400/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </a>
                    @else
                        <a href="{{ route('login') }}" 
                           class="group relative px-6 py-3 bg-white/10 backdrop-blur-xl text-white border border-white/20 rounded-xl font-medium overflow-hidden transition-all duration-300 hover:bg-white/20 hover:border-white/40 hover:scale-105">
                            <span class="relative z-10">Iniciar Sesión</span>
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-400/20 to-purple-400/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" 
                               class="group relative px-6 py-3 bg-gradient-to-r from-emerald-500 to-cyan-500 text-white rounded-xl font-medium overflow-hidden transition-all duration-300 hover:from-emerald-600 hover:to-cyan-600 hover:scale-105 hover:shadow-2xl">
                                <span class="relative z-10">Registrarse</span>
                                <div class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </a>
                        @endif
                    @endauth
                </div>
            </nav>
        @endif

        <main class="relative z-20 min-h-screen py-12">
            <div class="max-w-7xl mx-auto">
                <div class="text-center space-y-12">
                    
                    <!-- Logo y Branding -->
                    <div class="fade-in-up pt-20">
                        <div class="flex items-center justify-center mb-8">
                            <div class="w-20 h-20 bg-gradient-to-br from-emerald-400 to-cyan-500 rounded-2xl flex items-center justify-center shadow-2xl transform hover:scale-110 transition-transform duration-300">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                            </div>
                            <div class="ml-4 text-left">
                                <h1 class="text-4xl md:text-6xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-cyan-400 to-blue-400">
                                    SalesFlow
                                </h1>
                                <p class="text-emerald-300 text-lg font-medium">Sistema de Ventas e Inventario</p>
                            </div>
                        </div>
                        
                        <p class="text-xl md:text-2xl text-gray-300 max-w-4xl mx-auto leading-relaxed">
                            Gestiona tu negocio con una plataforma moderna que integra 
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-cyan-400 font-semibold">ventas</span>, 
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-400 font-semibold">inventario</span> y 
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400 font-semibold">verificación tributaria</span> 
                            en una sola solución.
                        </p>
                    </div>

                    <!-- Características principales -->
                    <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto fade-in-up" style="animation-delay: 0.2s">
                        <!-- Gestión de Ventas -->
                        <div class="group relative bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-8 hover:bg-white/10 hover:border-white/20 transition-all duration-500 hover:transform hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 to-cyan-500/10 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="relative z-10">
                                <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-cyan-500 rounded-xl flex items-center justify-center mx-auto mb-6 group-hover:shadow-2xl transition-shadow duration-300">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-white mb-4">Gestión de Ventas</h3>
                                <p class="text-gray-300 leading-relaxed">
                                    Registra ventas de forma rápida y eficiente. Interfaz intuitiva con validación de stock en tiempo real.
                                </p>
                                <div class="mt-6 flex flex-wrap gap-2">
                                    <span class="px-3 py-1 bg-emerald-500/20 text-emerald-300 rounded-full text-sm">Tiempo Real</span>
                                    <span class="px-3 py-1 bg-cyan-500/20 text-cyan-300 rounded-full text-sm">Intuitivo</span>
                                </div>
                            </div>
                        </div>

                        <!-- Control de Inventario -->
                        <div class="group relative bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-8 hover:bg-white/10 hover:border-white/20 transition-all duration-500 hover:transform hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 to-purple-500/10 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="relative z-10">
                                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-500 rounded-xl flex items-center justify-center mx-auto mb-6 group-hover:shadow-2xl transition-shadow duration-300">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-white mb-4">Control de Inventario</h3>
                                <p class="text-gray-300 leading-relaxed">
                                    Monitorea tu stock automáticamente. Descuentos automáticos y alertas de productos con bajo inventario.
                                </p>
                                <div class="mt-6 flex flex-wrap gap-2">
                                    <span class="px-3 py-1 bg-blue-500/20 text-blue-300 rounded-full text-sm">Automático</span>
                                    <span class="px-3 py-1 bg-purple-500/20 text-purple-300 rounded-full text-sm">Alertas</span>
                                </div>
                            </div>
                        </div>

                        <!-- Verificación SAT -->
                        <div class="group relative bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-8 hover:bg-white/10 hover:border-white/20 transition-all duration-500 hover:transform hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-pink-500/10 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="relative z-10">
                                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center mx-auto mb-6 group-hover:shadow-2xl transition-shadow duration-300">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-white mb-4">Verificación SAT</h3>
                                <p class="text-gray-300 leading-relaxed">
                                    Verifica automáticamente el estado tributario de tus clientes antes de realizar cualquier venta.
                                </p>
                                <div class="mt-6 flex flex-wrap gap-2">
                                    <span class="px-3 py-1 bg-purple-500/20 text-purple-300 rounded-full text-sm">Seguro</span>
                                    <span class="px-3 py-1 bg-pink-500/20 text-pink-300 rounded-full text-sm">Automático</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Estadísticas -->
                    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-8 max-w-4xl mx-auto fade-in-up" style="animation-delay: 0.4s">
                        <h3 class="text-2xl font-bold text-white mb-8">Tecnología de Vanguardia</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-cyan-400 mb-2">Laravel</div>
                                <p class="text-gray-400 text-sm">Framework PHP</p>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-400 mb-2">Flask</div>
                                <p class="text-gray-400 text-sm">Microservicios</p>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400 mb-2">MySQL</div>
                                <p class="text-gray-400 text-sm">Base de Datos</p>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-400 mb-2">API REST</div>
                                <p class="text-gray-400 text-sm">Integración</p>
                            </div>
                        </div>
                    </div>

                    <!-- Call to Action -->
                    <div class="fade-in-up" style="animation-delay: 0.6s">
                        @guest
                            <div class="flex flex-col sm:flex-row gap-6 justify-center max-w-md mx-auto">
                                <a href="{{ route('register') }}" 
                                   class="group relative px-8 py-4 bg-gradient-to-r from-emerald-500 to-cyan-500 text-white rounded-xl font-semibold overflow-hidden transition-all duration-300 hover:from-emerald-600 hover:to-cyan-600 hover:scale-105 hover:shadow-2xl">
                                    <span class="relative z-10 flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                        Comenzar Ahora
                                    </span>
                                    <div class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </a>
                                <a href="{{ route('login') }}" 
                                   class="group relative px-8 py-4 bg-white/10 backdrop-blur-xl border-2 border-white/30 text-white rounded-xl font-semibold overflow-hidden transition-all duration-300 hover:bg-white/20 hover:border-white/50 hover:scale-105">
                                    <span class="relative z-10">Ya tengo cuenta</span>
                                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-400/20 to-cyan-400/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </a>
                            </div>
                        @else
                            <div class="flex flex-col sm:flex-row gap-4 justify-center max-w-4xl mx-auto">
                                <a href="{{ url('/dashboard') }}" 
                                   class="group relative px-8 py-4 bg-gradient-to-r from-emerald-500 to-cyan-500 text-white rounded-xl font-semibold overflow-hidden transition-all duration-300 hover:from-emerald-600 hover:to-cyan-600 hover:scale-105 hover:shadow-2xl">
                                    <span class="relative z-10 flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2v1M9 7V5a2 2 0 012-2h2a2 2 0 012 2v2M13 7h-2"></path>
                                        </svg>
                                        Ir al Dashboard
                                    </span>
                                    <div class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </a>
                                <a href="{{ route('ventas.registro_venta') }}" 
                                   class="group relative px-8 py-4 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-xl font-semibold overflow-hidden transition-all duration-300 hover:from-blue-600 hover:to-purple-600 hover:scale-105 hover:shadow-2xl">
                                    <span class="relative z-10 flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                        Nueva Venta
                                    </span>
                                    <div class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </a>
                                <a href="{{ route('ventas.index') }}" 
                                   class="group relative px-8 py-4 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-xl font-semibold overflow-hidden transition-all duration-300 hover:from-purple-600 hover:to-pink-600 hover:scale-105 hover:shadow-2xl">
                                    <span class="relative z-10 flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                        Ver Ventas
                                    </span>
                                    <div class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </a>
                            </div>
                        @endguest
                    </div>

                    <!-- Footer info -->
                    <div class="text-center text-gray-400 text-sm fade-in-up pb-12" style="animation-delay: 0.8s">
                        <p>© {{ date('Y') }} SalesFlow. Desarrollado con ❤️ usando Laravel y Flask</p>
                    </div>

                </div>
            </div>
        </main>
    </body>
</html>