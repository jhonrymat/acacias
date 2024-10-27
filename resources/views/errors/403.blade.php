<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sin Autorización') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <x-application-logo class="" /> {{-- las clases aca no me quieren funcionar --}}

                    <div class="text-center p-6 rounded-lg ">
                        <h1 class="text-4xl font-bold text-red-500">403</h1>
                        <p class="mt-4 text-gray-700 text-lg">No tienes permisos para acceder a esta página.</p>
                        <p class="mt-2 text-gray-500">Si crees que esto es un error, por favor, contacta al
                            administrador.</p>

                        <a href="{{ route('dashboard') }}"
                            class="mt-6 inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition-colors">
                            Ir al Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
