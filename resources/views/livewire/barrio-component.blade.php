<div>
    <div class="w-3/4 mx-auto py-6">
        <!-- Botón para crear un nuevo barrio -->
        <button wire:click="create" class="mb-4 px-4 py-2 bg-green-500 text-white rounded">
            Nuevo Barrio
        </button>

        <!-- Componente de tabla -->
        @livewire('barrio-datatable')
    </div>

    <!-- Modal con Alpine.js -->
    <div x-data="{ showModal: @entangle('showForm') }" x-cloak>
        <!-- Overlay para el modal -->
        <div x-show="showModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" style="display: none;">
            <div class="relative top-20 mx-auto p-5 border w-1/2 shadow-lg rounded-md bg-white">
                <!-- Formulario dentro del modal -->
                <form wire:submit.prevent="save">
                    <div class="mb-4">
                        <label for="nombreBarrio" class="block text-sm font-medium">Nombre del Barrio</label>
                        <input type="text" wire:model="nombreBarrio" id="nombreBarrio" class="mt-1 block w-full" required>
                        @error('nombreBarrio') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="tipoUnidad" class="block text-sm font-medium">Tipo de unidad (UPZ o UPR)</label>
                        <select wire:model="tipoUnidad" id="tipoUnidad" class="mt-1 block w-full" required>
                            <option value="" selected>Selecciona una unidad</option>
                            <option value="UPZ">UPZ</option>
                            <option value="UPR">UPR</option>
                        </select>
                        @error('tipoUnidad') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="codigoNumero" class="block text-sm font-medium">Numero</label>
                        <select wire:model="codigoNumero" id="codigoNumero" class="mt-1 block w-full" required>
                            <option value="" selected>Selecciona una Numero</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="2">3</option>
                            <option value="2">4</option>
                            <option value="2">5</option>
                            <option value="2">6</option>
                        </select>
                        @error('codigoNumero') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="zona" class="block text-sm font-medium">Zona (Barrio, Vereda)</label>
                        <select wire:model="zona" id="zona" class="mt-1 block w-full" required>
                            <option value="" selected>Selecciona una zona</option>
                            <option value="Barrio">Barrio</option>
                            <option value="Vereda">Vereda</option>
                            <!-- Agregar más opciones según lo que necesites -->
                        </select>
                        @error('zona') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end space-x-2">
                        <!-- Botón para cerrar el modal -->
                        <button type="button" @click="showModal = false" class="px-4 py-2 bg-gray-500 text-white rounded">
                            Cancelar
                        </button>
                        <!-- Botón para guardar el formulario -->
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">
                            @if ($barrio_id) Actualizar @else Crear @endif
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
