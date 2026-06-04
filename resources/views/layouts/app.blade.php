<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50/50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistema Matrícula') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] }
                }
            }
        }
    </script>
</head>
<body class="h-full font-sans antialiased text-slate-900 bg-gradient-to-br from-slate-50 via-gray-50 to-blue-50/30">
    <div id="app" class="min-h-screen flex flex-col">
        
        <header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-200/80 flex items-center justify-between px-10 sticky top-0 z-40 shadow-sm transition-all">
            <div class="flex items-center gap-6">
                <a href="{{ url('/home') }}" class="flex items-center gap-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 p-2.5 rounded-xl shadow-md shadow-blue-500/20 text-white transition hover:opacity-95">
                    <span class="text-xl">🎓</span>
                    <span class="font-bold tracking-tight text-sm pr-1">Portal Matrícula</span>
                </a>
                <span class="text-slate-300 font-light text-xl">/</span>
                <div class="flex items-center gap-2">
                    <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Panel</span>
                    <span class="text-xs text-slate-300">&rarr;</span>
                    <span class="text-sm font-bold text-slate-700 bg-slate-100 px-3 py-1 rounded-md border border-slate-200">Base de Datos</span>
                </div>
            </div>

            <div class="flex items-center gap-6">
                <div class="text-xs font-bold text-indigo-600 bg-indigo-50/80 px-3.5 py-2 rounded-xl border border-indigo-100 flex items-center gap-2 shadow-sm">
                    <span>📅</span> {{ now()->format('d/m/Y') }}
                </div>

                @auth
                    <div class="flex items-center gap-4 border-l border-slate-200 pl-6">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-bold text-slate-800 leading-tight">{{ Auth::user()->name }}</p>
                            <p class="text-xs font-medium text-slate-400 mt-0.5">{{ Auth::user()->email }}</p>
                        </div>
                        <a href="{{ route('logout') }}" 
                           class="flex items-center gap-1.5 text-slate-500 hover:text-rose-600 font-semibold text-xs bg-slate-50 hover:bg-rose-50 border border-slate-200/70 hover:border-rose-200 px-3 py-2 rounded-xl transition-all duration-200 shadow-sm"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           title="Cerrar Sesión">
                            <span>🔓</span> Salir
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </div>
                @endauth
            </div>
        </header>

        <main class="flex-1 py-10 px-8 max-w-7xl w-full mx-auto">
            <div class="animate-fade-in">
                @yield('content')
            </div>
        </main>

        <footer class="py-4 border-t border-slate-200/60 text-center text-xs text-slate-400 font-medium bg-white/40">
            &copy; {{ now()->year }} Sistema de Control Académico. Todos los derechos reservados.
        </footer>

    </div>
</body>
</html>