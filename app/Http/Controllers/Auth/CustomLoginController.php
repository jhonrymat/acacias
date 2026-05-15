<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordMailable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
            'password' => ['required', 'string', 'min:4'],
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debes ingresar un correo electrónico válido.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener mínimo 6 caracteres.',
        ]);

        // Intentar autenticación
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // 🔍 Verificar el rol del usuario
            $redirectUrl = '/dashboard'; // Por defecto, redirigir a la raíz

            // Si el usuario tiene el rol 'user', mantener en la página actual
            if ($user->hasRole('user')) {
                $redirectUrl = null; // null = no redirigir, solo recargar
            }

            // SIEMPRE retornar JSON
            return response()->json([
                'success' => true,
                'message' => 'Inicio de sesión exitoso',
                'redirect_url' => $redirectUrl, // 🎯 Incluir URL de redirección
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->getRoleNames()->first() // Opcional: enviar el rol
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

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Usuario no encontrado']);
        }

        // Generar token manualmente
        $token = Password::createToken($user);

        // Enviar correo con plantilla personalizada
        Mail::to($user->email)->send(new ResetPasswordMailable($token, $user->email));

        return response()->json(['success' => true, 'message' => 'Correo de recuperación enviado']);
    }

    public function showResetForm(Request $request, $token)
    {
        return view('xroad.auth.reset-password', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:4|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();

                Auth::login($user);
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->to('/certificado-residencia#')->with('status', '¡Contraseña actualizada correctamente!')
            : back()->withErrors(['email' => __($status)]);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4',
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
