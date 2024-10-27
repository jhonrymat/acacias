<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="max-w-md w-full space-y-8">

            @auth
            {{-- Logo --}}
            <div class="flex justify-center">
                <img class="rounded-full max-md:mx-auto block mx-auto w-32 h-32" src="{{ asset('images/logo-web-192x192.png') }}" alt="Logo">
            </div>
                {{-- Si el usuario está autenticado, mostrar un mensaje --}}
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-center text-2xl font-bold text-gray-800 mb-4">Ya estás autenticado</h2>
                    <p class="text-center text-gray-600">Estás actualmente conectado. Haz clic abajo para acceder al Dashboard.</p>
                    <div class="flex justify-center mt-6">
                        <a href="{{ url('/dashboard') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                            Ir al Dashboard
                        </a>
                    </div>
                </div>
            @else
                {{-- Formulario de login --}}
                <x-authentication-card>
                    <x-slot name="logo">
                        <x-authentication-card-logo />
                    </x-slot>

                    <x-validation-errors class="mb-4" />

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2 class="text-center text-2xl font-bold text-blue-custom">Certificador de residencia Acacías</h2>
                    <p class="text-center text-gray-600">Ingresa tus datos para iniciar sesión</p>

                    <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
                        @csrf

                        <div>
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-label for="password" value="{{ __('Password') }}" />
                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                        </div>

                        <div class="block mt-4">
                            <label for="remember_me" class="flex items-center">
                                <x-checkbox id="remember_me" name="remember" />
                                <span class="ml-2 text-sm text-gray-600">{{ __('Recuérdame') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            @if (Route::has('password.request'))
                                <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                    {{ __('¿Olvidaste tu contraseña?') }}
                                </a>
                            @endif
                        </div>

                        <div class="flex justify-center mt-6">
                            <x-button class="w-full">
                                {{ __('Acceder') }}
                            </x-button>
                        </div>
                    </form>

                    {{-- Enlace para registrarse --}}
                    <div class="mt-6 flex justify-center text-sm">
                        <p>¿No tienes cuenta?</p>
                        <a class=" text-green-custom hover:text-gray-900" href="{{ route('register') }}">
                            {{ __('Regístrate') }}
                        </a>
                    </div>
                </x-authentication-card>
            @endauth
        </div>
    </div>
</x-guest-layout>
