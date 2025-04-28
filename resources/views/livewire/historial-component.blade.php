<div>
    <div class="w-3/4 mx-auto py-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Historial de solicitudes de residencia</h1>
        </div>
        <!-- Componente de tabla -->
        @livewire('historial-solicitudes-datatable')
    </div>
    <div x-data="{ showModal: @entangle('showForm') }" x-cloak>
        <!-- Overlay para el modal -->
        <div x-show="showModal" class="fixed inset-0 bg-gray-800 bg-opacity-70 flex items-center justify-center">
            <div
                class="bg-white w-11/12 sm:max-w-lg md:max-w-3xl lg:max-w-5xl p-6 rounded-lg shadow-lg max-h-screen overflow-y-auto">
                <!-- Encabezado del modal -->
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-xl font-bold">Información de {{ $nombre }} - {{ $cedula }}</h2>
                    <button @click="showModal = false" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                    <div class="border p-3 rounded-lg">
                        <h3 class="text-lg font-semibold mb-3">Validación</h3>
                        {{-- usuario --}}
                        <div class="mb-3">
                            <label for="nameAll" class="block text-xs font-medium">Usuario</label>
                            <input type="text" wire:model="nameAll" id="nameAll"
                                class="mt-1 block w-full border-gray-300 rounded text-sm px-2 py-1" disabled>
                        </div>
                        {{-- Cedula --}}
                        <div class="mb-3">
                            <label for="cedula" class="block text-xs font-medium">Cédula</label>
                            <input type="text" wire:model="cedula" id="cedula"
                                class="mt-1 block w-full border-gray-300 rounded text-sm px-2 py-1" disabled>
                        </div>
                         {{-- fecha de creacion --}}
                         <div class="mb-3">
                            <label for="fecha_creacion" class="block text-xs font-medium">Fecha de
                                creación</label>
                            <input type="text" wire:model="fecha_creacion" id="fecha_creacion"
                                class="mt-1 block w-full border-gray-300 rounded text-sm px-2 py-1" disabled>
                        </div>
                        {{-- fecha de validacion --}}
                        <div class="mb-3">
                            <label for="fecha_validacion" class="block text-xs font-medium">Fecha de
                                validación</label>
                            <input type="text" wire:model="fecha_validacion" id="fecha_validacion"
                                class="mt-1 block w-full border-gray-300 rounded text-sm px-2 py-1" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="validacion1" class="block text-xs font-medium">Primer filtro</label>
                            <input type="text" wire:model="validacion1" id="validacion1"
                                class="mt-1 block w-full border-gray-300 rounded text-sm px-2 py-1" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="validacion2" class="block text-xs font-medium">Segundo filtro</label>
                            <input type="text" wire:model="validacion2" id="validacion2"
                                class="mt-1 block w-full border-gray-300 rounded text-sm px-2 py-1" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="JAComunal" class="block text-xs font-medium">Anexos</label>
                            @if ($JAComunal && count($JAComunal) > 0)
                                @foreach ($JAComunal as $archivo)
                                    <a href="{{ asset('storage/' . $archivo) }}" target="_blank"
                                        class="block mt-1 text-sm text-blue-500 underline">
                                        Ver archivo
                                    </a>
                                @endforeach
                            @else
                                <p class="mt-1 text-sm text-gray-500">No hay archivo disponible.</p>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="notas" class="block text-xs font-medium">Notas</label>
                            <div id="notas" class="mt-1 p-3 border border-gray-300 rounded bg-gray-50 text-sm text-gray-700">
                                {{ $notas ?? 'No hay notas disponibles.' }}
                            </div>
                        </div>
                        {{-- mostrar al validador si esta opcion se marco, como visible o no, visible es 1 --}}
                        @if ($visible == 1)
                            <div class="mb-3 bg-green-100 border border-green-300 text-green-800 p-3 rounded">
                                <label for="visible" class="block text-xs font-medium">
                                    Esta validación se marcó como visible para el usuario
                                </label>
                            </div>
                        @else
                            <div class="mb-3 bg-red-100 border border-red-300 text-red-800 p-3 rounded">
                                <label for="visible" class="block text-xs font-medium">
                                    Esta validación se marcó para no ser visible para el usuario
                                </label>
                            </div>
                        @endif

                        {{-- aqui debo mostrar por quien fue validado validador --}}
                        <div class="mb-3">
                            <label for="validador" class="block text-xs font-medium">Validado por</label>
                            <input type="text" wire:model="validador" id="validador"
                                class="mt-1 block w-full border-gray-300 rounded text-sm px-2 py-1" disabled>
                        </div>
                    </div>
                </div>

                <!-- Botones -->
                <div class="flex justify-end space-x-2 mt-6">
                    <button @click="showModal = false" class="px-4 py-2 bg-gray-500 text-white rounded">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
