<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Página Expirada') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <div class="text-center p-6 rounded-lg">
                        <!-- Logo -->
                        <x-application-logo class="w-20 h-20 mx-auto mb-4" />

                        <!-- Error Code -->
                        <h1 class="text-4xl font-bold text-red-500">419</h1>
                        <p class="mt-4 text-gray-700 text-lg font-semibold">Tu sesión ha expirado</p>
                        <p class="mt-2 text-gray-500">Por razones de seguridad, tu sesión ha expirado. Por favor, inicia sesión nuevamente para continuar.</p>

                        <!-- Botón para redirigir al login -->
                        <a href="{{ route('login') }}"
                            class="mt-6 inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition-colors">
                            Iniciar Sesión
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
