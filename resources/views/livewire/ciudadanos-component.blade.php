<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ciudadanos registrados') }}
        </h2>
    </x-slot>

    <!-- Tabla generada por el paquete 'rappasoft/laravel-livewire-tables' -->
    <div class="w-3/4 mx-auto py-6">
        <button wire:click="nuevoCiudadano" class="mb-4 px-4 py-2 bg-green-500 text-white rounded">Nuevo
            Ciudadano</button>

        <!-- Tabla de validadores -->
        <livewire:ciudadanos-datatable />
    </div>

    <!-- Modal para creación o edición -->
    <div x-data="{ showModal: @entangle('showModal') }" x-cloak>
        <div x-show="showModal" class="fixed inset-0 bg-gray-800 bg-opacity-70 flex items-center justify-center">
            <div
                class="bg-white w-11/12 sm:max-w-lg md:max-w-3xl lg:max-w-5xl p-6 rounded-lg shadow-lg max-h-screen overflow-y-auto">
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-xl font-bold">
                        <span>Formulario Ciudadanos</span>
                    </h2>
                </div>
                <form wire:submit.prevent="save">
                    <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                        <div>
                            <x-label for="name" value="{{ __('Nombre') }}" />
                            <x-input id="name" class="block mt-1 w-full" type="text" wire:model="name" />
                            @error('name')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-label for="nombre_2" value="{{ __('Segundo nombre') }}" />
                            <x-input id="nombre_2" class="block mt-1 w-full" type="text" wire:model="nombre_2" />
                            @error('nombre_2')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-label for="apellido_1" value="{{ __('Primer apellido') }}" />
                            <x-input id="apellido_1" class="block mt-1 w-full" type="text" wire:model="apellido_1" />
                            @error('apellido_1')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-label for="apellido_2" value="{{ __('Segundo apellido') }}" />
                            <x-input id="apellido_2" class="block mt-1 w-full" type="text" wire:model="apellido_2" />
                            @error('apellido_2')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input id="email" class="block mt-1 w-full" type="email" wire:model="email" />
                            @error('email')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-label for="password" value="{{ __('Contraseña') }}" />
                            <x-input id="password" class="block mt-1 w-full" type="password" wire:model="password" />
                            @error('password')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Campo de Confirmación de Contraseña -->
                        <div>
                            <x-label for="password_confirmation" value="{{ __('Confirmar Contraseña') }}" />
                            <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                wire:model="password_confirmation" />
                            @error('password_confirmation')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-label for="telefonoContacto" value="{{ __('Teléfono de contacto') }}" />
                            <x-input id="telefonoContacto" class="block mt-1 w-full" type="text"
                                wire:model="telefonoContacto" />
                            @error('telefonoContacto')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-label for="numeroIdentificacion" value="{{ __('Número de identificación') }}" />
                            <x-input id="numeroIdentificacion" class="block mt-1 w-full" type="text"
                                wire:model="numeroIdentificacion" />
                            @error('numeroIdentificacion')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-label for="fechaNacimiento" value="{{ __('Fecha de nacimiento') }}" />
                            <x-input id="fechaNacimiento" class="block mt-1 w-full" type="date"
                                wire:model="fechaNacimiento" />
                            @error('fechaNacimiento')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="button" @click="showModal = false"
                            class="px-4 py-2 bg-gray-500 text-white rounded-md">Cancelar</button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md ml-2">Guardar</button>
                    </div>


                </form>

            </div>
        </div>
    </div>

    {{-- modal para visualizar el historial --}}
    <div x-data="{ showModalHistory: @entangle('showModalHistory') }" x-cloak>
        <div x-show="showModalHistory" class="fixed inset-0 bg-gray-800 bg-opacity-70 flex items-center justify-center">
            <div
                class="bg-white w-11/12 sm:max-w-lg md:max-w-3xl lg:max-w-5xl p-6 rounded-lg shadow-lg max-h-screen overflow-y-auto">
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-xl font-bold">
                        <span>Historial de solicitudes</span>
                    </h2>
                    <button @click="showModalHistory = false" wire:click="closeModal"
                        class="text-red-500 hover:text-red-700 text-lg">
                        &times;
                    </button>
                </div>

                @if (session()->has('error'))
                    <div class="bg-red-200 text-red-800 p-2 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Tabla con el historial de solicitudes -->
                @if ($historial->isNotEmpty())
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-300">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border p-2">ID</th>
                                    <th class="border p-2">Número Identificación</th>
                                    <th class="border p-2">Certificado</th>
                                    <th class="border p-2">Estado</th>
                                    <th class="border p-2">Fecha Emisión</th>
                                    <th class="border p-2">Notas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($historial as $solicitud)
                                    <tr class="border-b">
                                        <td class="border p-2">{{ $solicitud->id }}</td>
                                        <td class="border p-2">{{ $solicitud->numeroIdentificacion }}</td>
                                        @foreach ($solicitud->validaciones as $validacion)
                                            <td class="border p-2">
                                                <div class="flex space-x-2">
                                                    {{-- Verifica si el estado es "Emitido" --}}
                                                    @if ($solicitud->estado->nombreEstado === 'Emitido')
                                                        <button
                                                            wire:click="$dispatch('generarPDF', { Id: {{ $solicitud->id }} })"
                                                            class="px-4 py-2 bg-green-500 text-white rounded">
                                                            <i class="fa-solid fa-file-arrow-down"></i> Descargar
                                                        </button>
                                                    @elseif($solicitud->estado->nombreEstado === 'Rechazada' && $validacion->visible === 1)
                                                        <p>{{ $solicitud->observaciones }}</p>
                                                    @else
                                                        <span class="text-gray-500">
                                                            El certificado no está disponible actualmente
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="border p-2">
                                                {{ $solicitud->estado->nombreEstado . ' - ' . ($solicitud->updated_at ? $solicitud->updated_at->format('d/m/Y') : 'Sin estado') }}
                                            </td>
                                            <td class="border p-2">
                                                {{ $solicitud->fecha_emision ? $solicitud->fecha_emision->format('d/m/Y') : 'N/A' }}
                                            </td>
                                            <td class="border p-2">
                                                <p>{{ $validacion->notas }}</p>
                                            </td>
                                        @endforeach

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-600 text-center mt-4">No hay historial disponible.</p>
                @endif
            </div>
        </div>
    </div>
    <x-sweet-alert-good></x-sweet-alert-good>
</div>
