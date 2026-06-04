<!DOCTYPE html>
<html lang="es">
<head>  <!-- Pagina principal -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Académico - Instituto Forum</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#f8fafc] min-h-screen flex flex-col justify-between antialiased selection:bg-blue-500 selection:text-white">

    <!-- Navegación Superior -->
    <nav class="bg-white/80 backdrop-blur-md border-b border-slate-200/80 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center space-x-3">
                    <!-- Logo Vectorial Estilizado -->
                    <div class="bg-blue-600 p-2.5 rounded-xl shadow-md shadow-blue-600/20">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                        </svg>
                    </div>
                    <span class="text-xl font-extrabold text-slate-900 tracking-tight">
                        FORUM <span class="text-blue-600 font-medium text-lg">Instituto</span>
                    </span>
                </div>
                
                <div class="flex items-center space-x-5">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-slate-600 hover:text-blue-600 text-sm font-semibold transition-colors duration-200">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-slate-600 hover:text-blue-600 text-sm font-semibold transition-colors duration-200">Iniciar Sesión</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-slate-900 text-white hover:bg-slate-800 px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 shadow-sm hover:shadow">Registrarse</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="flex-grow">
        
        <!-- Sección Hero -->
        <section class="relative overflow-hidden max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32 text-center">
            <!-- Decoración de Fondo -->
            <div class="absolute top-0 left-1/2 -translate-x-1/2 -z-10 w-full max-w-7xl h-[500px] opacity-30 pointer-events-none bg-[radial-gradient(100%_100%_at_top_center,#3b82f6_0%,transparent_60%)]"></div>
            
            <div class="max-w-4xl mx-auto space-y-8">
                <div class="inline-flex items-center gap-2 bg-blue-50 text-blue-700 px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wider">
                    ⚡ Proceso de Admisión Abierto - 2026
                </div>
                <div class="space-y-4">
                    <h1 class="text-4xl sm:text-6xl font-black text-slate-900 tracking-tight leading-[1.1]">
                        Simplifica tu camino al éxito con <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Instituto Forum</span>
                    </h1>
                    <p class="max-w-2xl mx-auto text-lg sm:text-xl text-slate-500 font-normal leading-relaxed">
                        Gestiona tus asignaturas, horarios y procesos de inscripción desde una plataforma moderna, intuitiva y 100% digital.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row justify-center items-center gap-4 pt-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto px-8 py-4 bg-blue-600 text-white font-semibold rounded-xl shadow-lg shadow-blue-600/20 hover:bg-blue-700 hover:shadow-blue-700/30 transition-all duration-200 text-center">
                            Ir al Panel de Control
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 bg-blue-600 text-white font-semibold rounded-xl shadow-lg shadow-blue-600/20 hover:bg-blue-700 hover:shadow-blue-700/30 transition-all duration-200 text-center">
                            Iniciar Matrícula Digital
                        </a>
                        <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-4 bg-white text-slate-700 border border-slate-200 font-semibold rounded-xl shadow-sm hover:bg-slate-50 hover:border-slate-300 transition-all duration-200 text-center">
                            Acceso Estudiantes
                        </a>
                    @endauth
                </div>
            </div>
        </section>

        <!-- Sección de Propuesta de Valor -->
        <section class="bg-white border-y border-slate-200/60 py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
                    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight sm:text-4xl">¿Por qué elegir Instituto Forum?</h2>
                    <p class="text-lg text-slate-500">Diseñamos una infraestructura educativa enfocada en potenciar tu perfil profesional técnico.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Tarjeta 1 -->
                    <div class="p-8 bg-[#f8fafc] border border-slate-100 rounded-2xl space-y-4 hover:border-slate-200 hover:shadow-sm transition-all duration-200">
                        <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900">Tecnología de Vanguardia</h3>
                        <p class="text-slate-600 text-sm leading-relaxed">
                            Planes curriculares dinámicos alineados con las herramientas, lenguajes de programación y metodologías más demandadas del ecosistema de software global.
                        </p>
                    </div>

                    <!-- Tarjeta 2 -->
                    <div class="p-8 bg-[#f8fafc] border border-slate-100 rounded-2xl space-y-4 hover:border-slate-200 hover:shadow-sm transition-all duration-200">
                        <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900">Autogestión Ágil</h3>
                        <p class="text-slate-600 text-sm leading-relaxed">
                            Optimiza tu tiempo. Inscríbete en tus asignaturas, estructura tus horarios y consulta tu historial académico en tiempo real sin trámites presenciales.
                        </p>
                    </div>

                    <!-- Tarjeta 3 -->
                    <div class="p-8 bg-[#f8fafc] border border-slate-100 rounded-2xl space-y-4 hover:border-slate-200 hover:shadow-sm transition-all duration-200">
                        <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900">Docentes Expertos</h3>
                        <p class="text-slate-600 text-sm leading-relaxed">
                            Aprende de ingenieros y profesionales líderes activos en el sector, enfocados en resolver problemas prácticos y reales del mercado corporativo.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sección de Proceso Integrado -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight sm:text-4xl">Flujo de Inscripción Simplificado</h2>
                <p class="text-lg text-slate-500">Un proceso estructurado para garantizar tu correcta incorporación académica.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative">
                <!-- Tarjeta Paso 1 -->
                <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm relative group">
                    <div class="w-8 h-8 bg-slate-900 text-white text-xs font-bold rounded-lg flex items-center justify-center mb-4 transition-colors group-hover:bg-blue-600">01</div>
                    <h4 class="text-lg font-bold text-slate-900 mb-2">Registro Inicial</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">Crea tus credenciales únicas de acceso validando tu documento de identidad y datos personales.</p>
                </div>

                <!-- Tarjeta Paso 2 -->
                <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm relative group">
                    <div class="w-8 h-8 bg-slate-900 text-white text-xs font-bold rounded-lg flex items-center justify-center mb-4 transition-colors group-hover:bg-blue-600">02</div>
                    <h4 class="text-lg font-bold text-slate-900 mb-2">Selección de Ruta</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">Define tu carrera tecnológica, programa académico o ciclo correspondiente a tu plan.</p>
                </div>

                <!-- Tarjeta Paso 3 -->
                <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm relative group">
                    <div class="w-8 h-8 bg-slate-900 text-white text-xs font-bold rounded-lg flex items-center justify-center mb-4 transition-colors group-hover:bg-blue-600">03</div>
                    <h4 class="text-lg font-bold text-slate-900 mb-2">Horarios y Bloques</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">Asigna los módulos y turnos que mejor se adapten a tus necesidades laborales y personales.</p>
                </div>

                <!-- Tarjeta Paso 4 -->
                <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm relative group">
                    <div class="w-8 h-8 bg-slate-900 text-white text-xs font-bold rounded-lg flex items-center justify-center mb-4 transition-colors group-hover:bg-blue-600">04</div>
                    <h4 class="text-lg font-bold text-slate-900 mb-2">Alta Definitiva</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">Confirma los datos, genera tu constancia digital en PDF y obtén acceso directo a las aulas.</p>
                </div>
            </div>
        </section>

    </main>

    <!-- Pie de Página Premium -->
    <footer class="bg-slate-900 text-slate-400 border-t border-slate-800 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-center gap-6">
            <div class="flex items-center space-x-2">
                <span class="text-white font-extrabold text-lg tracking-tight">FORUM</span>
                <span class="text-slate-500 text-sm">| Portal de Servicios Académicos</span>
            </div>
            <p class="text-xs text-slate-500">&copy; 2026 Instituto Forum. Todos los derechos reservados.</p>
        </div>
    </footer>

</body>
</html>