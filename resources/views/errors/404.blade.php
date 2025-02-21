<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Página no encontrada') }}
        </h2>
    </x-slot>

    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-white shadow-xl sm:rounded-lg p-8 text-center w-full max-w-3xl">
            <x-application-logo class="mx-auto mb-4" /> {{-- Centra el logo --}}

            <h1 class="text-4xl font-bold text-red-500">404</h1>
            <p class="mt-4 text-gray-700 text-lg">Lo sentimos, la página que estás buscando no existe.</p>
            <p class="mt-2 text-gray-500">Es posible que la dirección esté mal escrita o que la página haya sido eliminada.</p>

            <a href="{{ route('dashboard') }}"
                class="mt-6 inline-block bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition-colors">
                Volver a la página principal
            </a>
        </div>
    </div>
</x-guest-layout>
