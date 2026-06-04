<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialController extends Controller
{
    /**
     * Redirige al usuario al formulario de autorización de GitHub.
     */
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Recibe la respuesta de GitHub después de la autenticación.
     */
    public function handleGithubCallback()
    {
        try {
            // Extrae el usuario de GitHub sin levantar excepciones de red intermedias
            $githubUser = Socialite::driver('github')->user();
            
            // Verificamos si el correo devuelto por GitHub no es nulo (cuentas privadas)
            if (!$githubUser->getEmail()) {
                return redirect()->route('login')->withErrors([
                    'email' => 'Tu cuenta de GitHub no proporciona un correo electrónico público obligatorio.'
                ]);
            }

            // Busca si ya existe el usuario registrado por correo electrónico
            $user = User::where('email', $githubUser->getEmail())->first();

            if ($user) {
                // Si el usuario ya existe en el sistema, simplemente iniciamos su sesión
                Auth::login($user, true); // 'true' activa la cookie para "Recordarme"
            } else {
                // Si es un usuario nuevo, lo registramos automáticamente en la tabla 'users'
                $user = User::create([
                    'name' => $githubUser->getName() ?? $githubUser->getNickname(),
                    'email' => $githubUser->getEmail(),
                    // Asignamos un password aleatorio temporal encriptado
                    'password' => Hash::make(Str::random(16)), 
                ]);

                // Iniciamos la sesión del nuevo usuario registrado
                Auth::login($user, true);
            }

            // Redirección exitosa hacia el Home (donde gestionas tus alumnos)
            return redirect()->route('home')->with('status', '¡Sesión iniciada con GitHub!');

        } catch (\Exception $e) {
            // Captura errores de tokens vencidos o cancelaciones del usuario
            return redirect()->route('login')->withErrors([
                'error' => ' Error de autenticación con GitHub o conexión rechazada.'
            ]);
        }
    }
}