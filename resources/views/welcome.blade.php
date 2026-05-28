<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido - Sistema de Matrícula</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col justify-between font-sans">

    <nav class="bg-white shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0 flex items-center">
                    <span class="text-xl font-bold text-blue-600 tracking-wider">🎓 Innovatec</span>
                </div>
                <div class="flex space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">Iniciar Sesión</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-md text-sm font-medium transition duration-150">Registrarse</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl text-center space-y-8">
            <div class="space-y-4">
                <h1 class="text-4xl sm:text-6xl font-extrabold text-gray-900 tracking-tight">
                    Sistema de Matrícula <span class="text-blue-600">Académica</span>
                </h1>
                <p class="max-w-xl mx-auto text-base sm:text-xl text-gray-500">
                    Gestiona tus cursos, horarios y procesos de inscripción de forma rápida, segura y completamente digital.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row justify-center items-center gap-4 pt-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto px-8 py-3 bg-blue-600 text-white font-medium rounded-lg shadow-md hover:bg-blue-700 transition duration-150 text-center">
                        Ir a mi Panel de Control
                    </a>
                @else
                    <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-3 bg-blue-600 text-white font-medium rounded-lg shadow-md hover:bg-blue-700 transition duration-150 text-center">
                        Comenzar Registro
                    </a>
                    <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-3 bg-white text-gray-700 border border-gray-300 font-medium rounded-lg shadow-sm hover:bg-gray-50 transition duration-150 text-center">
                        Ya tengo cuenta
                    </a>
                @endauth
            </div>
        </div>
    </main>

    <footer class="bg-white border-t border-gray-100 py-6 text-center text-sm text-gray-400">
        <p>&copy; 2026 Innovatec. Todos los derechos reservados.</p>
    </footer>

</body>
</html>