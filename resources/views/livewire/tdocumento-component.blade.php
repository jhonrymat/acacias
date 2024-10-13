<div>
    <div class="w-3/4 mx-auto py-6">
        <!-- Botón para crear un nuevo tipo de documento -->
        <button wire:click="create" class="mb-4 px-4 py-2 bg-green-500 text-white rounded">
            Nuevo Tipo de Documento
        </button>

        <!-- Componente de tabla -->
        @livewire('tdocumento-datatable')
    </div>

    <!-- Modal con Alpine.js -->
    <div x-data="{ showModal: @entangle('showForm') }" x-cloak>
        <!-- Overlay para el modal -->
        <div x-show="showModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" style="display: none;">
            <div class="relative top-20 mx-auto p-5 border w-1/2 shadow-lg rounded-md bg-white">
                <!-- Formulario dentro del modal -->
                <form wire:submit.prevent="save">
                    <div class="mb-4">
                        <label for="tipoDocumento" class="block text-sm font-medium">Tipo de documento</label>
                        <input type="text" wire:model="tipoDocumento" id="tipoDocumento" class="mt-1 block w-full" required>
                        @error('tipoDocumento') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end space-x-2">
                        <!-- Botón para cerrar el modal -->
                        <button type="button" @click="showModal = false" class="px-4 py-2 bg-gray-500 text-white rounded">
                            Cancelar
                        </button>
                        <!-- Botón para guardar el formulario -->
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">
                            @if ($documento_id) Actualizar @else Crear @endif
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
