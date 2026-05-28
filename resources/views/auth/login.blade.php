<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Sistema Matrícula</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">¡Bienvenido!</h2>
            <p class="text-gray-500 mt-2">Ingresa tus credenciales para acceder</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r">
                <div class="flex">
                    <div class="text-sm text-red-700">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf 

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900 bg-gray-50">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input type="password" id="password" name="password" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900 bg-gray-50">
            </div>

            <div class="flex items-center justify-between text-sm">
                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-gray-900">Recordarme</label>
                </div>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline">¿Olvidaste tu contraseña?</a>
                @endif
            </div>

            <div>
                <button type="submit" 
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150">
                    Iniciar Sesión
                </button>
            </div>
        </form>

        <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-gray-500">O continúa con</span>
            </div>
        </div>

        <a href="{{ url('/login/google') }}" 
           class="w-full flex items-center justify-center gap-3 bg-white border border-gray-300 rounded-md py-2 px-4 text-sm font-medium text-gray-700 hover:bg-gray-50 shadow-sm transition duration-150">
            <svg class="h-5 w-5" viewBox="0 0 24 24" width="24" height="24" xmlns="http://www.w3.org/2000/svg">
                <g transform="matrix(1, 0, 0, 1, 0, 0)">
                    <path d="M21.35,11.1H12v2.7h5.38c-0.24,1.28 -0.96,2.37 -2.04,3.1v2.56h3.3c1.93,-1.78 3.04,-4.4 3.04,-7.49c0,-0.61 -0.05,-1.2 -0.16,-1.77Z" fill="#4285F4"/>
                    <path d="M12,20.65c2.43,0 4.47,-0.8 5.96,-2.18l-3.3,-2.56c-0.91,0.61 -2.08,0.98 -3.3,0.98c-2.34,0 -4.33,-1.58 -5.04,-3.71H2.9v2.64c1.49,2.97 4.56,5.01,8.1,5.01Z" fill="#34A853"/>
                    <path d="M6.96,13.18a5.15,5.15,0,0,1,0,-3.3V7.24H2.9a8.65,8.65,0,0,0,0,8.58l4.06,-3.14Z" fill="#FBBC05"/>
                    <path d="M12,6.38c1.32,0 2.51,0.45 3.44,1.35l2.58,-2.58C16.46,3.68 14.42,3 12,3C8.46,3 5.39,5.04 3.9,8.01l4.06,3.14c0.71,-2.13 2.7,-3.71 5.04,-3.71Z" fill="#EA4335"/>
                </g>
            </svg>
            <span>Iniciar sesión con Google</span>
        </a>

        @if (Route::has('register'))
            <div class="mt-6 text-center text-sm">
                <p class="text-gray-600">
                    ¿No tienes una cuenta? 
                    <a href="{{ route('register') }}" class="text-blue-600 font-medium hover:underline">Regístrate aquí</a>
                </p>
            </div>
        @endif
    </div>

</body>
</html>