<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Página no encontrada') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200 text-center">
                    <x-application-logo class="mx-auto mb-4" /> {{-- Ajusté la clase para centrar el logo --}}

                    <h1 class="text-4xl font-bold text-red-500">404</h1>
                    <p class="mt-4 text-gray-700 text-lg">Lo sentimos, la página que estás buscando no existe.</p>
                    <p class="mt-2 text-gray-500">Es posible que la dirección esté mal escrita o que la página haya sido eliminada.</p>

                    <a href="{{ route('dashboard') }}"
                        class="mt-6 inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition-colors">
                        Volver a la página principal
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
