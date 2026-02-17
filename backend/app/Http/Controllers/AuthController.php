<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TUPA | API Explorer</title>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Instrument Sans', sans-serif; background-color: #0a0a0a; }
        .glass { background: rgba(255, 255, 255, 0.02); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.05); }
        .break-all { word-break: break-all; }
        /* Animación suave para hover */
        .route-card { transition: all 0.3s ease; }
        .route-card:hover { border-color: rgba(245, 48, 3, 0.4); transform: translateY(-2px); background: rgba(255, 255, 255, 0.04); }
    </style>
</head>
<body class="text-gray-300 min-h-screen pb-20 px-6">

    <header class="max-w-6xl mx-auto py-10 flex justify-between items-center border-b border-white/5">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tighter">SISTEMA TUPA <span class="text-[#f53003]">2026</span></h1>
            <p class="text-gray-500 text-sm">Explorador de Endpoints (Modo Visualización JSON)</p>
        </div>
        <div class="flex items-center gap-3">
            <span class="text-[10px] bg-green-500/10 text-green-400 border border-green-500/20 px-3 py-1 rounded-full font-bold uppercase">Online</span>
        </div>
    </header>

    <main class="max-w-6xl mx-auto mt-12">
        @php
            // Agrupamos por método y evitamos duplicados de HEAD
            $groupedRoutes = collect(Route::getRoutes())->groupBy(function($route) {
                return $route->methods()[0]; 
            });
        @endphp

        <div class="space-y-16">
            @foreach($groupedRoutes as $method => $routes)
                <section>
                    <div class="flex items-center gap-4 mb-6">
                        <div class="px-3 py-1 rounded-md text-xs font-black bg-white/5 border border-white/10
                            {{ $method == 'GET' ? 'text-blue-400' : ($method == 'POST' ? 'text-green-400' : 'text-yellow-400') }}">
                            {{ $method }}
                        </div>
                        <div class="h-px flex-1 bg-gradient-to-r from-white/10 to-transparent"></div>
                        <span class="text-[10px] text-gray-600 font-mono tracking-widest uppercase">{{ $routes->count() }} Rutas</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                        @foreach($routes as $route)
                            <div class="glass route-card p-5 rounded-2xl flex flex-col h-full overflow-hidden relative group">
                                
                                <a href="{{ url($route->uri()) }}" target="_blank" title="Ver JSON en pestaña nueva"
                                   class="absolute top-4 right-4 text-gray-600 hover:text-[#f53003] transition-colors p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                </a>

                                <div class="mb-5">
                                    <span class="text-[10px] font-bold text-gray-600 uppercase tracking-tighter block mb-1">Ruta del Endpoint</span>
                                    <code class="text-[13px] text-gray-100 font-mono break-all pr-8">/{{ $route->uri() }}</code>
                                </div>
                                
                                <div class="mb-5">
                                    <span class="text-[10px] font-bold text-gray-600 uppercase tracking-tighter block mb-1">Nombre Identificador</span>
                                    <span class="text-xs text-gray-400 font-medium italic">{{ $route->getName() ?? 'Sin nombre asignado' }}</span>
                                </div>

                                <div class="mt-auto pt-4 border-t border-white/5">
                                    <span class="text-[10px] font-bold text-gray-600 uppercase tracking-tighter block mb-1">Controlador & Acción</span>
                                    <div class="flex items-start gap-2">
                                        <div class="w-1.5 h-4 rounded-full shrink-0 mt-0.5 {{ $method == 'GET' ? 'bg-blue-500' : 'bg-green-500' }}"></div>
                                        <span class="text-[10px] text-gray-500 font-mono break-all leading-tight">
                                            {{ str_replace('App\\Http\\Controllers\\', '', (string)$route->getActionName()) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endforeach
        </div>
    </main>

    <footer class="max-w-6xl mx-auto mt-20 text-center py-10 border-t border-white/5">
        <p class="text-[10px] text-gray-600 uppercase tracking-[0.4em]">MDNCH &bull; TUPA Backend &bull; Laravel v{{ Illuminate\Foundation\Application::VERSION }}</p>
    </footer>

</body>
</html>