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
    </style>
</head>
<body class="text-gray-300 min-h-screen pb-20 px-6">

    <header class="max-w-6xl mx-auto py-10 flex justify-between items-center border-b border-white/5">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tighter">SISTEMA TUPA <span class="text-[#f53003]">2026</span></h1>
            <p class="text-gray-500 text-sm">Explorador de rutas - Modo API JSON</p>
        </div>
        <div class="hidden md:block">
            <span class="text-[10px] border border-[#f53003]/40 px-3 py-1 rounded-full text-[#f53003] uppercase tracking-widest font-bold">Endpoints Disponibles</span>
        </div>
    </header>

    <main class="max-w-6xl mx-auto mt-12">
        
        @php
            // Obtenemos todas las rutas sin excepción para que puedas probarlas
            $groupedRoutes = collect(Route::getRoutes())->groupBy(function($route) {
                return $route->methods()[0]; 
            });
        @endphp

        <div class="space-y-16">
            @foreach($groupedRoutes as $method => $routes)
                <section>
                    <div class="flex items-center gap-4 mb-6">
                        <h2 class="text-xl font-bold text-white tracking-tight">{{ $method }}</h2>
                        <div class="h-px flex-1 bg-gradient-to-r 
                            {{ $method == 'GET' ? 'from-blue-500/50' : ($method == 'POST' ? 'from-green-500/50' : 'from-yellow-500/50') }} to-transparent">
                        </div>
                        <span class="text-xs text-gray-500 font-mono">{{ $routes->count() }} rutas</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($routes as $route)
                            <div class="glass p-5 rounded-2xl hover:border-[#f53003]/30 transition group flex flex-col h-full overflow-hidden">
                                <div class="flex justify-between items-start mb-3">
                                    <code class="text-[13px] text-gray-200 group-hover:text-[#f53003] transition break-all pr-4">/{{ $route->uri() }}</code>
                                    <a href="{{ url($route->uri()) }}" target="_blank" class="text-gray-600 hover:text-white shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </a>
                                </div>
                                
                                <div class="flex flex-col gap-1 mb-4">
                                    <span class="text-[11px] font-bold text-gray-600 uppercase tracking-widest">Nombre de Ruta</span>
                                    <span class="text-xs text-gray-400 font-mono truncate">{{ $route->getName() ?? '—' }}</span>
                                </div>

                                <div class="mt-auto pt-4 border-t border-white/5 flex items-center gap-2 overflow-hidden">
                                    <div class="w-1.5 h-1.5 rounded-full shrink-0 {{ $method == 'GET' ? 'bg-blue-500' : 'bg-green-500' }}"></div>
                                    <span class="text-[10px] text-gray-500 uppercase break-all leading-tight" title="{{ $route->getActionName() }}">
                                        {{ str_replace('App\\Http\\Controllers\\', '', (string)$route->getActionName()) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endforeach
        </div>
    </main>

    <footer class="max-w-6xl mx-auto mt-20 text-center py-10 border-t border-white/5">
        <p class="text-xs text-gray-600 uppercase tracking-[0.2em]">Leonardo 2026 &bull; Debug Mode</p>
    </footer>

</body>
</html>