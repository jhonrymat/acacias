<div class="w-4/5 mx-auto py-6">

    <!-- Componente de tabla -->
    @livewire('solicitud-datatable')

    <!-- Modal con Alpine.js -->
    <div x-data="{ showModal: @entangle('showForm') }" x-cloak>
        <!-- Overlay para el modal -->
        <div x-show="showModal" class="fixed inset-0 bg-gray-800 bg-opacity-70 flex items-center justify-center" x-inz>
            <div
                class="bg-white w-11/12 sm:max-w-lg md:max-w-3xl lg:max-w-5xl p-6 rounded-lg shadow-lg max-h-screen overflow-y-auto">
                <!-- Encabezado del modal -->
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-xl font-bold">Información de Usuario</h2>
                    <button @click="showModal = false" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Formulario -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Sección Datos Personales -->
                    <div class="border p-3 rounded-lg">
                        <h3 class="text-lg font-semibold mb-3">Datos Personales</h3>
                        <div class="mb-3">
                            <label for="nombreCompleto" class="block text-xs font-medium">Nombre completo</label>
                            <input type="text" wire:model="nombreCompleto" id="nombreCompleto"
                                class="mt-1 block w-full border-gray-300 rounded text-sm px-2 py-1">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="block text-xs font-medium">Correo Electrónico</label>
                            <input type="email" wire:model="email" id="email"
                                class="mt-1 block w-full border-gray-300 rounded text-sm px-2 py-1">
                        </div>
                        <div class="mb-3">
                            <label for="telefonoContacto" class="block text-xs font-medium">Teléfono de Contacto</label>
                            <input type="text" wire:model="telefonoContacto" id="telefonoContacto"
                                class="mt-1 block w-full border-gray-300 rounded text-sm px-2 py-1">
                        </div>
                        <div class="mb-3">
                            <label for="id_genero" class="block text-xs font-medium">Género</label>
                            <input type="text" wire:model="id_genero" id="id_genero"
                                class="mt-1 block w-full border-gray-300 rounded text-sm px-2 py-1">
                        </div>
                    </div>

                    <!-- Sección Información Adicional -->
                    <div class="border p-3 rounded-lg">
                        <h3 class="text-lg font-semibold mb-3">Información Adicional</h3>
                        <div class="mb-3">
                            <label for="id_tipoSolicitante" class="block text-xs font-medium">Tipo de
                                Solicitante</label>
                            <input type="text" wire:model="id_tipoSolicitante" id="id_tipoSolicitante"
                                class="mt-1 block w-full border-gray-300 rounded text-sm px-2 py-1">
                        </div>
                        <div class="mb-3">
                            <label for="id_tipoDocumento" class="block text-xs font-medium">Tipo de Documento</label>
                            <input type="text" wire:model="id_tipoDocumento" id="id_tipoDocumento"
                                class="mt-1 block w-full border-gray-300 rounded text-sm px-2 py-1">
                        </div>
                        <div class="mb-3">
                            <label for="numeroIdentificacion" class="block text-xs font-medium">Número de
                                Identificación</label>
                            <input type="text" wire:model="numeroIdentificacion" id="numeroIdentificacion"
                                class="mt-1 block w-full border-gray-300 rounded text-sm px-2 py-1">
                        </div>
                        <div class="mb-3">
                            <label for="ciudadExpedicion" class="block text-xs font-medium">Ciudad de Expedición</label>
                            <input type="text" wire:model="ciudadExpedicion" id="ciudadExpedicion"
                                class="mt-1 block w-full border-gray-300 rounded text-sm px-2 py-1">
                        </div>
                    </div>

                    <!-- Sección Detalles Personales -->
                    <div class="border p-3 rounded-lg">
                        <h3 class="text-lg font-semibold mb-3">Detalles Personales</h3>
                        <div class="mb-3">
                            <label for="fechaNacimiento" class="block text-xs font-medium">Fecha de Nacimiento</label>
                            <input type="date" wire:model="fechaNacimiento" id="fechaNacimiento"
                                class="mt-1 block w-full border-gray-300 rounded text-sm px-2 py-1">
                        </div>
                        <div class="mb-3">
                            <label for="id_nivelEstudio" class="block text-xs font-medium">Nivel de Estudio</label>
                            <input type="text" wire:model="id_nivelEstudio" id="id_nivelEstudio"
                                class="mt-1 block w-full border-gray-300 rounded text-sm px-2 py-1">
                        </div>
                    </div>

                    <!-- Sección Ocupación y Población -->
                    <div class="border p-3 rounded-lg">
                        <h3 class="text-lg font-semibold mb-3">Ocupación y Población</h3>
                        <div class="mb-3">
                            <label for="id_ocupacion" class="block text-xs font-medium">Ocupación</label>
                            <input type="text" wire:model="id_ocupacion" id="id_ocupacion"
                                class="mt-1 block w-full border-gray-300 rounded text-sm px-2 py-1">
                        </div>
                        <div class="mb-3">
                            <label for="id_poblacion" class="block text-xs font-medium">Población</label>
                            <input type="text" wire:model="id_poblacion" id="id_poblacion"
                                class="mt-1 block w-full border-gray-300 rounded text-sm px-2 py-1">
                        </div>
                    </div>
                </div>

                <!-- Botones -->
                <div class="flex justify-end space-x-2 mt-6">
                    <button @click="showModal = false"
                        class="px-4 py-2 bg-gray-500 text-white rounded">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal para validar la solicitud se va a llamar validar , por el momento solo va a tener un select que va a permitir cambien el estado de la solicitud --}}
    <div x-data="validationModal" x-cloak>
        <div x-show="showModal" class="fixed inset-0 bg-gray-800 bg-opacity-70 flex items-center justify-center"
            x-inz>
            <div
                class="bg-white w-11/12 sm:max-w-lg md:max-w-3xl lg:max-w-5xl p-6 rounded-lg shadow-lg max-h-screen overflow-y-auto">
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-xl font-bold">Validar Solicitud</h2>
                </div>

                <form wire:submit.prevent="save">
                    <div class="border p-3 rounded-lg mb-3">
                        <h3 class="text-lg font-semibold mb-3">Moverse a</h3>
                        <div class="mb-3">
                            <label for="estado" class="block text-xs font-medium">Primer filtro</label>
                            <select wire:model="estado_id" id="estado"
                                class="mt-1 block w-full border-gray-300 rounded text-sm px-2 py-1" required>
                                <option value="">Seleccione una opción</option>
                                <option value="Finalizar">FINALIZAR - Rechazar</option>
                                <option value="Avanzar">AVANZAR - Validar</option>
                            </select>
                            {{-- error --}}
                            @error('estado_id')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="numeroIdentificacion_id" class="block text-xs font-medium">Numero de
                            identificación</label>
                        <input type="text" wire:model="numeroIdentificacion_id" id="numeroIdentificacion_id"
                            class="mt-1 block w-full border-gray-300 rounded text-sm px-2 py-1" disabled>
                        {{-- error --}}
                        @error('numeroIdentificacion_id')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- nombre completo --}}
                    <div class="mb-3">
                        <label for="nameAll" class="block text-xs font-medium">Nombre completo</label>
                        <input type="text" wire:model="nameAll" id="nameAll"
                            class="mt-1 block w-full border-gray-300 rounded text-sm px-2 py-1" disabled>
                        {{-- error --}}
                        @error('nameAll')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="border p-3 rounded-lg mb-3">
                        <h3 class="text-lg font-semibold mb-3">Estado de certificado</h3>
                        <div class="mb-3">
                            <label for="estado" class="block text-xs font-medium">Segundo filtro</label>
                            <select wire:model="estado_id2" id="estado2"
                                class="mt-1 block w-full border-gray-300 rounded text-sm px-2 py-1" required>
                                <option value="">Seleccione una opción de estado</option>
                                @foreach ($estados as $estado)
                                    <option value="{{ $estado->id }}">{{ $estado->nombreEstado }} -
                                        {{ $estado->descripcion }}</option>
                                @endforeach
                            </select>
                            {{-- error --}}
                            @error('estado_id2')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <input type="hidden" wire:model="solicitud_id" id="solicitud_id"
                            value="{{ $solicitud_id }}">
                    </div>

                    <!-- Copia registro JAC -->
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="JAComunal_input">
                            Anexos
                        </label>
                        <input wire:model="JAComunal" multiple
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50
        dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="JAComunal_input" type="file"
                            accept="application/pdf,image/jpeg,image/jpg,image/png">

                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-300" id="JAComunal_input_help">
                            Adjunte anexos que requiera. PDF, PNG, JPG (MAX. 10MB).
                        </p>

                        <!-- Indicador de carga -->
                        <div wire:loading wire:target="JAComunal"
                            class="mt-2 text-sm text-blue-600 dark:text-blue-400">
                            Subiendo archivos, por favor espere...
                        </div>

                        <!-- Lista de archivos subidos -->
                        @if ($JAComunal)
                            <div class="mt-2">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Archivos seleccionados:
                                </p>
                                <ul class="mt-1 space-y-1">
                                    @foreach ($JAComunal as $index => $file)
                                        <li
                                            class="flex items-center justify-between text-sm text-gray-700 dark:text-gray-300">
                                            <span>{{ $file->getClientOriginalName() }}</span>
                                            <button type="button" wire:click="removeFile({{ $index }})"
                                                class="px-2 py-1 text-xs text-white bg-red-500 rounded hover:bg-red-600">
                                                Quitar
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Manejo de errores -->
                        @error('JAComunal')
                            <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>
                        @enderror
                        @error('JAComunal.*')
                            <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>
                        @enderror
                    </div>



                    {{-- input text area, detalles --}}
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="detalles">
                            Observaciones
                        </label>
                        <textarea wire:model="detalles"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="detalles_help" id="detalles" rows="3" required></textarea>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-300" id="detalles_help">Detalles
                            adicionales sobre la solicitud.</p>
                        {{-- error --}}
                        @error('detalles')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- un check en don de diga, permitir visualización de la observación al ciudadano --}}
                    <div class="mb-4 p-4 bg-gray-100 border border-gray-300 rounded-md">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="visible">
                            Habilitar visualización
                        </label>
                        <div class="flex items-center">
                            <input wire:model="visible" type="checkbox" id="visible" name="visible"
                                value="1" class="mr-2">
                            <label for="visible" class="text-sm text-gray-700 dark:text-gray-300">
                                Permitir visualización de la observación al ciudadano
                            </label>
                            {{-- error --}}
                            @error('visible')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="flex justify-end space-x-2">
                        <!-- Botón para liberar la solicitud -->
                        <button type="button" wire:click.prevent="confirmLiberar"
                            class="px-4 py-2 bg-gray-500 text-white rounded">
                            Liberar
                        </button>
                        <!-- Botón para guardar el formulario -->
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">
                            Validar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div x-data="{ showAdditionalModal: @entangle('showAdditional') }" x-cloak>
        <div x-show="showAdditionalModal"
            class="fixed inset-0 bg-gray-800 bg-opacity-70 flex items-center justify-center" x-inz>
            <div
                class="bg-white w-11/12 sm:max-w-lg md:max-w-3xl lg:max-w-5xl p-6 rounded-lg shadow-lg max-h-screen overflow-y-auto">
                <!-- Encabezado del modal -->
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-xl font-bold">Información de {{ $nombre }} - {{ $cedula }}</h2>
                    <button @click="showAdditionalModal = false" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                    <div class="border p-3 rounded-lg">
                        <h3 class="text-lg font-semibold mb-3">Validación</h3>
                        <div class="mb-3">
                            <label for="cedula" class="block text-xs font-medium">Numero de
                                identificación</label>
                            <input type="text" wire:model="cedula" id="cedula"
                                class="mt-1 block w-full border-gray-300 rounded text-sm px-2 py-1" disabled>
                            {{-- error --}}
                            @error('cedula')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- nombre completo --}}
                        <div class="mb-3">
                            <label for="nameAll" class="block text-xs font-medium">Nombre completo</label>
                            <input type="text" wire:model="nameAll" id="nameAll"
                                class="mt-1 block w-full border-gray-300 rounded text-sm px-2 py-1" disabled>
                            {{-- error --}}
                            @error('nameAll')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
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
                        {{-- solo para rol validador2 --}}
                        @if (auth()->user()->hasRole('validador2'))
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
                        @endif
                        <div class="mb-3">
                            <label for="notas" class="block text-xs font-medium">Notas</label>
                            <div id="notas"
                                class="mt-1 p-3 border border-gray-300 rounded bg-gray-50 text-sm text-gray-700">
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
                    <button @click="showAdditionalModal = false"
                        class="px-4 py-2 bg-gray-500 text-white rounded">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div x-data="{ modalRechazadaModal: @entangle('modalRechazada') }" x-cloak>
        <div x-show="modalRechazadaModal"
            class="fixed inset-0 bg-gray-800 bg-opacity-70 flex items-center justify-center" x-inz>
            <div
                class="bg-white w-11/12 sm:max-w-lg md:max-w-3xl lg:max-w-5xl p-6 rounded-lg shadow-lg max-h-screen overflow-y-auto">
                <!-- Encabezado del modal -->
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-xl font-bold">Información de {{ $nombre }} - {{ $cedula }}</h2>
                    <button @click="modalRechazadaModal = false" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                    <div class="border p-3 rounded-lg">
                        {{-- nombre completo --}}
                        <div class="mb-3">
                            <label for="nameAll" class="block text-xs font-medium">Nombre usuario</label>
                            <input type="text" wire:model="nameAll" id="nameAll"
                                class="mt-1 block w-full border-gray-300 rounded text-sm px-2 py-1" disabled>
                        </div>
                        {{-- aqui debo mostrar por quien fue validado validador --}}
                        <div class="mb-3">
                            <label for="validador" class="block text-xs font-medium">Validado por</label>
                            <input type="text" wire:model="validador" id="validador"
                                class="mt-1 block w-full border-gray-300 rounded text-sm px-2 py-1" disabled>
                        </div>
                        <h3 class="text-lg font-semibold mb-3">¿Por que se va a Cancelar?</h3>
                        <form wire:submit.prevent="rechazarsweet">
                            <div class="mb-3">
                                <label for="observaciones"
                                    class="block text-xs font-medium text-gray-900 dark:text-white">
                                    Observaciones
                                </label>
                                <textarea wire:model="observaciones" id="observaciones" rows="4"
                                    class="mt-1 block w-full p-3 text-sm text-gray-700 border border-gray-300 rounded-lg bg-gray-50
                                dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Escriba sus observaciones aquí...">{{ old('observaciones', $observaciones) }}</textarea>

                                <!-- Mostrar error si lo hay -->
                                @error('observaciones')
                                    <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- cerrar --}}
                            <!-- Botones -->
                            <div class="flex justify-end space-x-2">
                                <button @click="modalRechazadaModal = false"
                                    class="px-4 py-2 bg-red-500 text-white rounded">Cancelar</button>
                                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">
                                    Guardar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div x-data="{ showModal: false }" x-on:confirm-save.window="showModal = true" x-cloak>
        <!-- Modal de Confirmación -->
        <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg p-6 w-96">
                <h2 class="text-lg font-bold text-gray-700">¿Estás seguro?</h2>
                <p class="text-sm text-gray-600 mt-2">Esta acción no se puede deshacer.</p>
                <p class="text-sm text-gray-600 mt-2">
                    <strong>Filtro 1:</strong> <span x-text="$wire.estado_id"></span>
                </p>
                <p class="text-sm text-gray-600 mt-2">
                <div x-data="{ selectedEstado2: '' }" x-init="$watch('$wire.estado_id2', value => {
                    const estado = @js($AllStatus).find(status => status.id == value);
                    selectedEstado2 = estado ? estado.nombreEstado : 'Sin seleccionar';
                });">
                    <strong>Filtro 2:</strong>
                    <span x-text="selectedEstado2"></span>
                </div>

                </p>
                <div class="mt-4 flex justify-end space-x-2">
                    <button @click="showModal = false" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                        Cancelar
                    </button>
                    <button @click="$wire.handleSave(); showModal = false"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Confirmar
                    </button>
                </div>
            </div>
        </div>
    </div>




    <style>
        [x-cloak] {
            display: none !important;
        }

        [x-inz] {
            z-index: 11;
        }
    </style>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('validationModal', () => ({
                showModal: @entangle('showValidar'),

                init() {
                    // Detectar cuando se está revisando la solicitud y el modal está abierto
                    window.addEventListener('beforeunload', (e) => {
                        if (this
                            .showModal) { // Solo mostrar advertencia si el modal está visible
                            e.preventDefault();
                            e.returnValue = ''; // Mostrar mensaje de advertencia
                        }
                    });
                }
            }));
        });
    </script>


    <x-sweet-alert-good></x-sweet-alert-good>
    <x-confirm></x-confirm>
    <x-alert></x-alert>
    <x-2alert></x-2alert>
</div>
