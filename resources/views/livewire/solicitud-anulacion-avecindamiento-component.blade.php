<div>
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-6 border">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Anulación de Solicitud de avecindamiento #{{ $numeroSolicitud }}</h2>

        <!-- Input para Número de Solicitud -->
        <div class="mb-4" x-data>
            <label for="numeroSolicitud" class="block font-semibold">Número de Solicitud:</label>
            <input type="text" x-ref="numSolicitud" wire:model.defer="numeroSolicitud" class="w-full border rounded p-2"
                placeholder="Ingrese el número de solicitud"
                x-on:input="$refs.numSolicitud.value = $refs.numSolicitud.value.replace(/\D/g, '')"
                x-on:keydown.enter.prevent="$wire.buscarSolicitud()">

            <!-- Botón de Búsqueda -->
            <button wire:click="buscarSolicitud" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded">
                Buscar
            </button>
        </div>
    </div>



    @if (session()->has('error'))
        <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-6 border">
            <div class="text-red-600">{{ session('error') }}</div>
        </div>
    @endif
    @if ($solicitud)
        @php

        @endphp
        <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-6 border">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Anulación de Solicitud #{{ $numeroSolicitud }} -
                {{ $solicitud->numeroIdentificacion }}</h2>
            <p class="text-xl font-semibold text-gray-800 mb-4">Nombre :{{ $solicitud->nombre_completo }}</p>

            <!-- Descripción -->
            <div class="mb-4">
                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción:</label>
                <textarea id="descripcion" wire:model="descripcion"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    rows="4" placeholder="Describe el motivo de la anulación..." required></textarea>
                @error('descripcion')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Carga de Archivo -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Cargar Archivo (PDF, Imagen máx. 5MB):</label>
                <input type="file" wire:model="archivo"
                    class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                file:rounded-lg file:border-0 file:text-sm file:font-semibold
                file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                @if ($errors->has('archivo'))
                    <span class="text-red-500 text-sm">{{ $errors->first('archivo') }}</span>
                @endif
            </div>

            <!-- Checkbox para Visibilidad -->
            <div class="flex items-center mb-4">
                <input type="checkbox" id="visible" wire:model="visible"
                    class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" required>
                <label for="visible" class="ml-2 text-sm text-gray-700">¿Hacer visible la anulación al usuario?</label>
            </div>

            <!-- Botón para Anular -->
            <div class="text-right">
                <button wire:click="confirmarAnulacion"
                    class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                    🔴 Anular Solicitud
                </button>
            </div>
        </div>
    @endif
    @if (session()->has('success'))
        <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-6 border">
            <div class="text-green-600 mt-4">{{ session('success') }}</div>
        </div>
    @endif

    <x-anular></x-anular>

</div>
