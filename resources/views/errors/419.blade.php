<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Página Expirada') }}
        </h2>
    </x-slot>

    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-white shadow-xl sm:rounded-lg p-8 text-center w-full max-w-3xl">
            <!-- Logo -->
            <x-application-logo class="w-20 h-20 mx-auto mb-4" />

            <!-- Error Code -->
            <h1 class="text-4xl font-bold text-red-500">419</h1>
            <p class="mt-4 text-gray-700 text-lg font-semibold">Tu sesión ha expirado</p>
            <p class="mt-2 text-gray-500">
                Por razones de seguridad, tu sesión ha expirado. Por favor, inicia sesión nuevamente para continuar.
            </p>

            <!-- Botón para redirigir al login -->
            <a href="{{ route('login') }}"
                class="mt-6 inline-block bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition-colors">
                Iniciar Sesión
            </a>
        </div>
    </div>
</x-guest-layout>
