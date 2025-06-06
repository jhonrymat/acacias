<div class="w-3/4 mx-auto py-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Solicitudes de Avecindamiento</h1>
    </div>
    <div class="flex justify-end my-4"> <!-- Alinea a la derecha y agrega espaciado vertical -->
        <button wire:click="$dispatch('view')" class="px-4 py-2 bg-blue-500 text-white rounded">
            Mis datos
        </button>
    </div>
    <!-- Componente de tabla -->
    @livewire('solicitudes-avecindamiento-datatable')


    <!-- Modal con Alpine.js -->
    <div x-data="{ showModal: @entangle('showForm') }" x-cloak>
        <!-- Overlay para el modal -->
        <div x-show="showModal" class="fixed inset-0 bg-gray-800 bg-opacity-70 flex items-center justify-center">
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

    {{-- visualizar nota --}}
    <div x-data="{ mostrarNotasModal: @entangle('abrirmodal') }" x-cloak>
        <div x-show="mostrarNotasModal"
            class="fixed inset-0 bg-gray-800 bg-opacity-70 flex items-center justify-center" x-inz>
            <div class="bg-white p-6 rounded shadow-md">
                <h2 class="text-lg font-semibold mb-4">Detalles del Validador</h2>
                <p class="text-gray-700">{{ $notasDelValidador }}</p>
                <button @click="mostrarNotasModal = false" class="mt-4 px-4 py-2 bg-red-500 text-white rounded">
                    Cerrar
                </button>
            </div>
        </div>
    </div>

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
                @role('validador2')
                    <p class="mt-2"><strong>Visible para los usuario:</strong>
                        @if ($visibleAnulacion)
                            <span class="text-green-600 font-bold">Sí</span>
                        @else
                            <span class="text-red-600 font-bold">No</span>
                        @endif
                    </p>
                @endrole

                <!-- Botón de cierre -->
                <div class="mt-4 text-right">
                    <button x-on:click="open = false" class="px-4 py-2 bg-gray-500 text-white rounded">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


</div>
