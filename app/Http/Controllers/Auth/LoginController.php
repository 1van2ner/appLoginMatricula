<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

// 1. Redirección forzada a Google sin depender de configs externas
public function redirectToGoogle()
{
    return \Laravel\Socialite\Facades\Socialite::driver('google')
        ->redirectUrl('http://127.0.0.1:8000/login/google/callback')
        ->redirect();
}

// 2. Captura de datos de Google sin fallos de estado
public function handleGoogleCallback()
{
    $googleUser = \Laravel\Socialite\Facades\Socialite::driver('google')
        ->redirectUrl('http://127.0.0.1:8000/login/google/callback')
        ->stateless()
        ->user();

    $user = \App\Models\User::firstOrCreate(
        ['email' => $googleUser->getEmail()],
        [
            'name' => $googleUser->getName(),
            'password' => \Illuminate\Support\Facades\Hash::make(\Illuminate\Support\Str::random(24)),
        ]
    );

    \Illuminate\Support\Facades\Auth::login($user);

    // Guardamos dispositivo e historial
    $device = request()->header('User-Agent');
    $user->sessions()->create(['device' => $device]);
    session(['device' => $device]);

    return redirect('/home');
}

// 3. Login tradicional por formulario
public function authenticated(Request $request, $user)
{
    $device = $request->header('User-Agent');

    // Buscamos la sesión actual del navegador y le actualizamos el campo device
    DB::table('sessions')
        ->where('id', session()->getId())
        ->update(['device' => $device]);

    // Guarda en la sesión del navegador
    session(['device' => $device]);
}
}
