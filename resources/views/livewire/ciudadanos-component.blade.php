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

    {{-- modal para visualizar el historial residencia --}}
    <div x-data="{ showModalHistory: @entangle('showModalHistory') }" x-cloak>
        <div x-show="showModalHistory" class="fixed inset-0 bg-gray-800 bg-opacity-70 flex items-center justify-center">
            <div
                class="bg-white w-11/12 sm:max-w-lg md:max-w-3xl lg:max-w-5xl p-6 rounded-lg shadow-lg max-h-screen overflow-y-auto">
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-xl font-bold">
                        <span>Historial de solicitudes de residencia</span>
                        <span
                            class="inline-block bg-blue-100 text-blue-800 text-sm font-semibold px-3 py-1 rounded-full ml-2">
                            Residencia
                        </span>
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
                                    <th class="border p-2">Fecha de creación</th>
                                    <th class="border p-2">Notas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($historial as $solicituResidencia)
                                    <tr class="border-b">
                                        <td class="border p-2">{{ $solicituResidencia->id }}</td>
                                        <td class="border p-2">{{ $solicituResidencia->numeroIdentificacion }}</td>
                                        @foreach ($solicituResidencia->validaciones as $validacion)
                                            <td class="border p-2">
                                                <div class="flex space-x-2">
                                                    {{-- Verifica si el estado es "Emitido" --}}
                                                    @if (in_array($solicituResidencia->estado->nombreEstado, ['Emitido', 'Vencido', 'Por vencer'], true))
                                                        <button
                                                            wire:click="$dispatch('generarPDF', { Id: {{ $solicituResidencia->id }} })"
                                                            class="px-4 py-2 bg-green-500 text-white rounded">
                                                            <i class="fa-solid fa-file-arrow-down"></i> Descargar
                                                        </button>
                                                        {{-- Si la solicitud fue "Anulada", mostrar botón para ver detalles --}}
                                                    @elseif ($solicituResidencia->estado->nombreEstado === 'Anulado' && $validacion->visible === 1)
                                                        <button
                                                            wire:click="verAnulacion({{ $solicituResidencia->id }})"
                                                            class="px-4 py-2 bg-red-600 text-white rounded">
                                                            <i class="fa-solid fa-eye"></i> Ver Anulación
                                                        </button>
                                                        {{-- Si está "no completado" y es visible, mostrar observaciones --}}
                                                    @elseif($solicituResidencia->estado->nombreEstado === 'No completado' && $validacion->visible === 1)
                                                        <p>{{ $solicituResidencia->observaciones }}</p>
                                                    @else
                                                        <span class="text-gray-500">
                                                            El certificado no está disponible actualmente
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="border p-2">
                                                {{ $solicituResidencia->estado->nombreEstado . ' - ' . ($solicituResidencia->updated_at ? $solicituResidencia->updated_at->format('d/m/Y') : 'Sin estado') }}
                                            </td>
                                            <td class="border p-2">
                                                {{ $solicituResidencia->fecha_emision ? $solicituResidencia->fecha_emision->format('d/m/Y') : 'N/A' }}
                                            </td>
                                            <td class="border p-2">
                                                {{ $solicituResidencia->created_at->format('d/m/Y') }}
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

    {{-- modal para visualizar el historial Avecindamiento --}}
    <div x-data="{ showModalHistoryAvecindamiento: @entangle('showModalHistoryAvecindamiento') }" x-cloak>
        <div x-show="showModalHistoryAvecindamiento"
            class="fixed inset-0 bg-gray-800 bg-opacity-70 flex items-center justify-center">
            <div
                class="bg-white w-11/12 sm:max-w-lg md:max-w-3xl lg:max-w-5xl p-6 rounded-lg shadow-lg max-h-screen overflow-y-auto">
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-xl font-bold">
                        <span>Historial de solicitudes de avecindamiento</span>
                        <span
                            class="inline-block bg-green-100 text-green-800 text-sm font-semibold px-3 py-1 rounded-full ml-2">
                            Avecindamiento
                        </span>
                    </h2>
                    <button @click="showModalHistoryAvecindamiento = false" wire:click="closeModal"
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
                @if ($historial_avecindamiento->isNotEmpty())
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-300">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border p-2">ID</th>
                                    <th class="border p-2">Número Identificación</th>
                                    <th class="border p-2">Certificado</th>
                                    <th class="border p-2">Estado</th>
                                    <th class="border p-2">Fecha Emisión</th>
                                    <th class="border p-2">Fecha de creación</th>
                                    <th class="border p-2">Notas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($historial_avecindamiento as $solicitud)
                                    <tr class="border-b">
                                        <td class="border p-2">{{ $solicitud->id }}</td>
                                        <td class="border p-2">{{ $solicitud->numeroIdentificacion }}</td>
                                        @foreach ($solicitud->validaciones as $validacion)
                                            <td class="border p-2">
                                                <div class="flex space-x-2">
                                                    {{-- Verifica si el estado es "Emitido" --}}
                                                    @if (in_array($solicitud->estado->nombreEstado, ['Emitido', 'Vencido', 'Por vencer'], true))
                                                        <div class="flex flex-col space-y-2">
                                                            <button
                                                                wire:click="$dispatch('generarPDFAvecindamiento', { Id: {{ $solicitud->id }} })"
                                                                class="px-4 py-2 bg-green-500 text-white rounded">
                                                                Certificado
                                                            </button>
                                                            <button
                                                                wire:click="$dispatch('generarActaAvecindamiento', { Id: {{ $solicitud->id }} })"
                                                                class="px-4 py-2 bg-blue-500 text-white rounded"> Acta
                                                            </button>
                                                        </div>

                                                        {{-- Si la solicitud fue "Anulada", mostrar botón para ver detalles --}}
                                                    @elseif ($solicitud->estado->nombreEstado === 'Anulado' && $validacion->visible === 1)
                                                        <button wire:click="verAnulacion({{ $solicitud->id }})"
                                                            class="px-4 py-2 bg-red-600 text-white rounded">
                                                            <i class="fa-solid fa-eye"></i> Ver Anulación
                                                        </button>
                                                        {{-- Si está "no completado" y es visible, mostrar observaciones --}}
                                                    @elseif($solicitud->estado->nombreEstado === 'No completado' && $validacion->visible === 1)
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
                                                {{ $solicitud->created_at->format('d/m/Y') }}
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
    <!-- Modal para ver detalles de la anulación -->
    <div x-data="{ open: @entangle('mostrarModal') }" x-cloak>
        <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Detalles de la Anulación</h2>

                <!-- Descripción -->
                <p class="text-gray-700"><strong>Descripción:</strong> {{ $descripcionAnulacion }}</p>

                <!-- Archivo (si existe) -->
                @if ($archivoAnulacion)
                    <p class="mt-2"><strong>Archivo:</strong>
                        <a href="{{ asset('storage/' . $archivoAnulacion) }}" class="text-blue-600 underline"
                            target="_blank">Ver Archivo</a>
                    </p>
                @endif

                <!-- ¿Es visible? -->
                <p class="mt-2"><strong>Visible para los usuario:</strong>
                    @if ($visibleAnulacion)
                        <span class="text-green-600 font-bold">Sí</span>
                    @else
                        <span class="text-red-600 font-bold">No</span>
                    @endif
                </p>

                <!-- Botón de cierre -->
                <div class="mt-4 text-right">
                    <button x-on:click="open = false" class="px-4 py-2 bg-gray-500 text-white rounded">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
