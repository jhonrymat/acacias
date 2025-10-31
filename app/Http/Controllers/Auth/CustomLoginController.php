<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class CustomLoginController extends Controller
{
    /**
     * Manejar el intento de login con AJAX
     * IMPORTANTE: Esta ruta SOLO funciona con AJAX, no hace redirecciones
     */
    public function login(Request $request)
    {
        // Validar credenciales
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:6'],
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debes ingresar un correo electrónico válido.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener mínimo 6 caracteres.',
        ]);

        // Intentar autenticación
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            // SIEMPRE retornar JSON (nunca redirigir)
            return response()->json([
                'success' => true,
                'message' => 'Inicio de sesión exitoso',
                'user' => [
                    'id' => Auth::user()->id,
                    'name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                ]
            ]);
        }

        // Login fallido - SIEMPRE retornar JSON
        return response()->json([
            'success' => false,
            'errors' => [
                'email' => ['Las credenciales proporcionadas no coinciden con nuestros registros.']
            ]
        ], 422);
    }

    /**
     * Cerrar sesión
     * Retorna JSON para mantener al usuario en la misma página
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'success' => true,
            'message' => 'Sesión cerrada correctamente'
        ]);
    }

    // En tu controlador CertificadoAuthController
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink($request->only('email'));
        return response()->json(['success' => $status === Password::RESET_LINK_SENT]);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $validated['nombre'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);
        return response()->json(['success' => true]);
    }

}
