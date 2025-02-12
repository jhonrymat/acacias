<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-7">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <!-- Mensaje de éxito -->
        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">{{ session('message') }}</strong>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">{{ session('error') }}</strong>
            </div>
        @endif
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-md shadow-md mb-4">
            <h2 class="font-bold text-lg">⚠️ Importante: Veracidad de la Información</h2>
            <p class="mt-2">
                Al completar esta solicitud para obtener un <strong>certificado de residencia</strong>, usted declara
                que la información proporcionada es <strong>fiel y verdadera</strong>. La presentación de datos falsos,
                como una dirección incorrecta o un documento adulterado, no solo invalida su solicitud, sino que también
                constituye una <strong>falta grave de acuerdo con la normativa legal vigente</strong>.
            </p>
            <p class="mt-2">
                <strong>Advertencia:</strong> Según el <em>Artículo 289 del Código Penal Colombiano</em>, la falsedad en
                documento público es un delito que puede conllevar sanciones penales, incluyendo penas de prisión.
                Asegúrese de que todos los datos ingresados sean correctos y verificables para evitar sanciones y
                garantizar un proceso ágil.
            </p>
            <p class="mt-4 font-semibold text-center">¡Su honestidad es esencial para mantener la integridad de este
                proceso!</p>
        </div>
        <form wire:submit.prevent="save" enctype="multipart/form-data">
            @csrf
            <div class="mt-8 mb-6 text-center">
                <h2 class="text-2xl font-extrabold text-gray-800 uppercase tracking-wide">
                    Solicitud de Certificado de Residencia
                </h2>
                <p class="text-sm text-gray-600 mt-1">Complete este formulario para iniciar su solicitud</p>
            </div>


            <style>
                .tooltip:hover .tooltip-item {
                    visibility: visible;
                }
            </style>

            <!-- Número de identificación tomado de 'user' => $user, y no poder editar -->
            <div class="mb-4 relative">
                <div class="flex items-center">

                    <x-label for="numeroIdentificacion" class="block text-sm font-medium">Número de
                        identificación*</x-label>
                </div>
                <div class="relative group">
                    <x-input id="numeroIdentificacion" type="text" wire:model="numeroIdentificacion"
                        class="mt-1 block w-full focus:ring focus:ring-indigo-300"
                        placeholder="Ingrese el número de identificación" readonly />
                    <!-- Tooltip -->
                    <div class="absolute hidden group-hover:block group-focus:block bg-gray-800 text-white text-sm rounded-lg px-4 py-2 w-64 shadow-lg left-0 z-10"
                        style="top:-6rem">
                        Este campo muestra el número de identificación. No se puede editar porque es un valor de solo
                        lectura.
                    </div>
                </div>
                @error('numeroIdentificacion')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Modal -->
            <!-- Campo de dirección fuera del modal, parte del formulario -->
            <div class="mt-4 mb-4 relative">
                <div class="flex items-center">
                    <x-label class="block text-sm font-medium">Dirección*</x-label>
                </div>
                <div class="w-full mb-4 flex items-center">
                    <div class="relative group w-full">
                        <x-input type="text" wire:model="direccion" id="direccionInput"
                            class="w-full rounded-lg border border-gray-400 p-2 focus:ring focus:ring-indigo-300"
                            placeholder="Seleccione su dirección" readonly />
                        <!-- Tooltip -->
                        <div class="absolute hidden group-hover:block group-focus:block bg-gray-800 text-white text-sm rounded-lg px-4 py-2 w-64 shadow-lg left-0 z-10"
                            style="top:-6rem">
                            Este campo es obligatorio. Haz clic en el ícono de más (+) para seleccionar tu dirección.
                        </div>
                    </div>

                    <div x-data="{
                        modelOpen: false,
                        tipoViaPrimaria: '',
                        numeroViaPrincipal: '',
                        letraViaPrincipal: '',
                        bis: '',
                        letraBis: '',
                        cuadranteViaPrincipal: '',
                        numeroViaGeneradora: '',
                        letraViaGeneradora: '',
                        numeroPlaca: '',
                        cuadranteViaGeneradora: '',
                        complemento: '',
                        otro: '',
                        direccionGenerada: '',
                        actualizarDireccion() {
                            this.direccionGenerada = `${this.tipoViaPrimaria} ${this.numeroViaPrincipal} ${this.letraViaPrincipal} ${this.bis} ${this.letraBis} ${this.cuadranteViaPrincipal} ${this.numeroViaGeneradora} ${this.letraViaGeneradora} ${this.numeroPlaca} ${this.cuadranteViaGeneradora} ${this.complemento} ${this.otro}`.trim().replace(/\s+/g, ' ');
                            $wire.set('direccion', this.direccionGenerada); // Actualiza el campo fuera del modal
                        },
                        limpiarDireccion() {
                            this.tipoViaPrimaria = '';
                            this.numeroViaPrincipal = '';
                            this.letraViaPrincipal = '';
                            this.bis = '';
                            this.letraBis = '';
                            this.cuadranteViaPrincipal = '';
                            this.numeroViaGeneradora = '';
                            this.letraViaGeneradora = '';
                            this.numeroPlaca = '';
                            this.cuadranteViaGeneradora = '';
                            this.complemento = '';
                            this.otro = '';
                            this.direccionGenerada = '';
                            direccionGenerada: '',
                                $wire.set('direccion', ''); // Limpia el campo de dirección fuera del modal
                            // Esperar a que el modal esté completamente cerrado
                            setTimeout(() => {
                                this.modelOpen = false;
                            }, 200);
                        }
                    }" x-cloak>
                        <button type="button" @click="modelOpen = true"
                            class="ml-2 rounded-lg bg-blue-500 p-2 text-white hover:bg-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title"
                            role="dialog" aria-modal="true">
                            <div
                                class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                                <!-- Background overlay -->
                                <div x-cloak @click="modelOpen = false" x-show="modelOpen"
                                    x-transition:enter="transition ease-out duration-300 transform"
                                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition ease-in duration-200 transform"
                                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                    class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40"
                                    aria-hidden="true">
                                </div>

                                <!-- Modal content -->
                                <div x-cloak x-show="modelOpen"
                                    x-transition:enter="transition ease-out duration-300 transform"
                                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                    x-transition:leave="transition ease-in duration-200 transform"
                                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                    class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between space-x-4">
                                        <h1 class="text-xl font-medium text-gray-800">Agregar dirección dirección</h1>
                                        <button type="button" @click="modelOpen = false"
                                            class="text-gray-600 hover:text-gray-700 focus:outline-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Instrucciones -->
                                    <div class="my-4">
                                        <p class="text-md font-semibold">Ingrese la dirección (según el ejemplo) y de
                                            clic sobre el botón Aceptar</p>
                                        <p class="text-sm italic">
                                            (Diligencie los campos requeridos que identifiquen la dirección actual; los
                                            campos que no requiera
                                            los puede dejar en blanco. Vaya verificando en el recuadro inferior
                                            "Dirección Generada" su dirección)
                                        </p>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="mt-4">
                                        <!-- Vía Principal -->
                                        <label class="block font-bold text-sm sm:text-base">Vía Principal:</label>
                                        <div class="grid grid-cols-1 sm:grid-cols-6 gap-2">
                                            <select
                                                class="border border-gray-300 rounded p-1 text-xs sm:text-sm col-span-2"
                                                x-model="tipoViaPrimaria" @change="actualizarDireccion()">
                                                <option value="">Tipo de vía</option>
                                                <option value="AC">Avenida calle</option>
                                                <option value="AK">Avenida carrera</option>
                                                <option value="CL">Calle</option>
                                                <option value="CR">Carrera</option>
                                                <option value="DG">Diagonal</option>
                                                <option value="TV">Transversal</option>
                                                <option value="CQ">Callejón</option>
                                                <option value="CRA">Circunvalar</option>
                                                <option value="AV">Avenida</option>
                                                <option value="TR">Tramo</option>
                                                <option value="MZ">Manzana</option>
                                                <option value="BL">Bloque</option>
                                                <option value="LT">Lote</option>
                                                <option value="CS">Casa</option>
                                                <option value="ED">Edificio</option>
                                                <option value="ET">Etapa</option>
                                                <option value="IN">Interior</option>
                                                <option value="LO">Local</option>
                                                <option value="OF">Oficina</option>
                                                <option value="PA">Parcela</option>
                                                <option value="PI">Piso</option>
                                                <option value="SA">Salón</option>
                                                <option value="SE">Sector</option>
                                                <option value="SU">Suite</option>
                                                <option value="TZ">Torre</option>
                                                <option value="UN">Unidad</option>

                                            </select>

                                            <input type="number"
                                                class="border border-gray-300 rounded p-1 text-xs sm:text-sm col-span-1"
                                                x-model="numeroViaPrincipal" @input="actualizarDireccion()"
                                                placeholder="Número" min="0" step="1">

                                            <select
                                                class="border border-gray-300 rounded p-1 text-xs sm:text-sm col-span-1"
                                                x-model="letraViaPrincipal" @change="actualizarDireccion()">
                                                <option value="">Letra</option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                                <option value="E">E</option>
                                                <option value="F">F</option>
                                                <option value="G">G</option>
                                                <option value="H">H</option>
                                                <option value="I">I</option>
                                                <option value="J">J</option>
                                                <option value="K">K</option>
                                                <option value="L">L</option>
                                                <option value="M">M</option>
                                                <option value="N">N</option>
                                                <option value="O">O</option>
                                                <option value="P">P</option>
                                                <option value="Q">Q</option>
                                                <option value="R">R</option>
                                                <option value="S">S</option>
                                                <option value="T">T</option>
                                                <option value="U">U</option>
                                                <option value="V">V</option>
                                                <option value="W">W</option>
                                                <option value="X">X</option>
                                                <option value="Y">Y</option>
                                                <option value="Z">Z</option>
                                            </select>

                                            <select
                                                class="border border-gray-300 rounded p-1 text-xs sm:text-sm col-span-1"
                                                x-model="bis" @change="actualizarDireccion()">
                                                <option value="">Selecciona</option>
                                                <option value="BIS">BIS</option>
                                                <option value="BIS A">BIS A</option>
                                                <option value="BIS B">BIS B</option>
                                            </select>

                                            <select
                                                class="border border-gray-300 rounded p-1 text-xs sm:text-sm col-span-1"
                                                x-model="cuadranteViaPrincipal" @change="actualizarDireccion()">
                                                <option value="">Sector</option>
                                                <option value="SUR">SUR</option>
                                                <option value="NORTE">NORTE</option>
                                                <option value="OESTE">OESTE</option>
                                                <option value="ESTE">ESTE</option>
                                                <option value="URB">URBANA</option>
                                                <option value="RUR">RURAL</option>

                                            </select>
                                        </div>

                                        <!-- Segundo bloque: Vía Secundaria y Vía Complemento -->
                                        <div class="grid grid-cols-1 sm:grid-cols-6 gap-2 mt-4">
                                            <!-- Vía Secundaria -->
                                            <div class="sm:col-span-4">
                                                <label class="block font-bold text-sm sm:text-base">Vía
                                                    Secundaria:</label>
                                                <div class="grid grid-cols-3 gap-2">
                                                    <input type="text"
                                                        class="border border-gray-300 rounded p-1 text-xs sm:text-sm col-span-1"
                                                        x-model="numeroViaGeneradora" @input="actualizarDireccion()"
                                                        placeholder="No.">

                                                    <select
                                                        class="border border-gray-300 rounded p-1 text-xs sm:text-sm col-span-1"
                                                        x-model="letraViaGeneradora" @change="actualizarDireccion()">
                                                        <option value="">Letra</option>
                                                        <option value="A">A</option>
                                                        <option value="B">B</option>
                                                        <option value="C">C</option>
                                                        <option value="D">D</option>
                                                        <option value="E">E</option>
                                                        <option value="F">F</option>
                                                        <option value="G">G</option>
                                                        <option value="H">H</option>
                                                        <option value="I">I</option>
                                                        <option value="J">J</option>
                                                        <option value="K">K</option>
                                                        <option value="L">L</option>
                                                        <option value="M">M</option>
                                                        <option value="N">N</option>
                                                        <option value="O">O</option>
                                                        <option value="P">P</option>
                                                        <option value="Q">Q</option>
                                                        <option value="R">R</option>
                                                        <option value="S">S</option>
                                                        <option value="T">T</option>
                                                        <option value="U">U</option>
                                                        <option value="V">V</option>
                                                        <option value="W">W</option>
                                                        <option value="X">X</option>
                                                        <option value="Y">Y</option>
                                                        <option value="Z">Z</option>
                                                    </select>

                                                    <input type="text"
                                                        class="border border-gray-300 rounded p-1 text-xs sm:text-sm col-span-1"
                                                        x-model="numeroPlaca" @input="actualizarDireccion()"
                                                        placeholder="Número placa">
                                                </div>
                                            </div>

                                            <!-- Vía Complemento -->
                                            <div class="sm:col-span-2">
                                                <label class="block font-bold text-sm sm:text-base">Vía
                                                    Complemento:</label>
                                                <div class="grid grid-cols-1 gap-2">
                                                    <select
                                                        class="border border-gray-300 rounded p-1 text-xs sm:text-sm"
                                                        x-model="cuadranteViaGeneradora"
                                                        @change="actualizarDireccion()">
                                                        <option value="">Sector</option>
                                                        <option value="SUR">SUR</option>
                                                        <option value="NORTE">NORTE</option>
                                                        <option value="OESTE">OESTE</option>
                                                        <option value="ESTE">ESTE</option>
                                                        <option value="URB">URBANA</option>
                                                        <option value="RUR">RURAL</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Campo adicional -->
                                        <label class="block font-bold text-sm sm:text-base mt-4">Adicionar otro
                                            complemento:</label>
                                        <div class="grid grid-cols-1 sm:grid-cols-6 gap-2">
                                            <select
                                                class="border border-gray-300 rounded p-1 text-xs sm:text-sm sm:col-span-2"
                                                x-model="complemento" @change="actualizarDireccion()">
                                                <option value="">Selecciona</option>
                                                <option value="AP">Apartamento</option>
                                                <option value="AG">Agrupación</option>
                                                <option value="BL">Bloque</option>
                                                <option value="BG">Bodega</option>
                                                <option value="CS">Casa</option>
                                                <option value="CO">Conjunto</option>
                                                <option value="DE">Depósito</json>
                                                <option value="ED">Edificio</option>
                                                <option value="ET">Etapa</option>
                                                <option value="IN">Interior</option>
                                                <option value="LO">Local</option>
                                                <option value="OF">Oficina</option>
                                                <option value="PA">Parcela</option>
                                                <option value="PI">Piso</option>
                                                <option value="SA">Salón</option>
                                                <option value="SE">Sector</option>
                                                <option value="SU">Suite</option>
                                                <option value="TZ">Torre</option>
                                                <option value="UN">Unidad</option>

                                            </select>

                                            <input type="text"
                                                class="border border-gray-300 rounded p-1 text-xs sm:text-sm sm:col-span-2"
                                                x-model="otro" @input="actualizarDireccion()"
                                                placeholder="Escriba lo faltante">
                                        </div>

                                        <!-- Dirección Generada -->
                                        <div class="mt-4">
                                            <label class="block font-bold text-sm sm:text-base">Dirección
                                                Generada:</label>
                                            <input type="text" x-model="direccionGenerada"
                                                class="w-full bg-gray-100 border border-gray-300 rounded p-1 text-xs sm:text-sm"
                                                readonly>
                                        </div>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="mt-4 flex justify-end">
                                        <button type="button" @click="limpiarDireccion()"
                                            class="mr-2 bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Limpiar</button>
                                        <button type="button"
                                            @click="modelOpen = false; $wire.set('direccion', direccionGenerada)"
                                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Aceptar</button>
                                        <button type="button" @click="modelOpen = false"
                                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                @error('direccion')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Modal con Alpine.js y Livewire -->

            <!-- Subir Recibo -->
            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="recibo_input">
                    Suba un recibo de servicio público domiciliario con fecha de expedición no mayor a 30 días
                    (gas, agua o energía). Asegúrese de que la dirección registrada en su solicitud coincida exactamente
                    con la del recibo.*
                </label>
                <div class="relative group">
                    <input wire:model="recibo"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50
                        dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="recibo_input_help" id="recibo_input" type="file" required
                        accept="application/pdf,image/jpeg,image/jpg">

                    <!-- Tooltip -->
                    <div
                        class="absolute left-0 hidden p-2 mt-1 text-xs text-white bg-gray-900 rounded-lg shadow-md group-hover:block dark:bg-gray-800">
                        Asegúrese de que el archivo sea legible y no borroso. Los documentos PDF deben ser originales,
                        emitidos por la respectiva entidad, y no deben contener modificaciones.
                        Solo se aceptarán archivos PDF o JPG que cumplan con estas condiciones.
                    </div>
                </div>

                <!-- Indicador de carga -->
                <div wire:loading wire:target="recibo" class="mt-2 text-sm text-blue-600 dark:text-blue-400">
                    Subiendo archivo, por favor espere...
                </div>

                <!-- Botón para limpiar archivo -->
                @if ($recibo)
                    <div class="flex items-center mt-2">
                        <span class="text-green-600 text-sm">Archivo seleccionado:
                            {{ $recibo->getClientOriginalName() }}</span>
                        <button type="button" wire:click="$set('recibo', null)"
                            class="ml-2 px-2 py-1 text-xs text-white bg-red-500 rounded hover:bg-red-600">
                            Quitar
                        </button>
                    </div>
                @endif

                <!-- Mensaje de error -->
                @error('recibo')
                    <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>
                @enderror

                <p class="mt-1 text-xs text-gray-500 dark:text-gray-300" id="recibo_input_help">
                    PDF, JPG (MAX. 10MB).
                </p>
            </div>

            {{-- barrio --}}
            <div class="mb-4 relative" wire:ignore>
                <div class="flex items-center">
                    <x-label for="id_barrio" class="block text-sm font-medium">Barrio o Vereda*</x-label>
                </div>
                <div class="relative group">
                    <select name="id_barrio" id="id_barrio" wire:model="id_barrio"
                        class="block mt-1 w-full border border-gray-300 rounded-lg focus:ring focus:ring-indigo-300 select2"
                        required>
                        <option value="" selected>Selecciona un barrio o vereda</option>
                        @foreach ($barrios as $barrio)
                            <option value="{{ $barrio->id }}">
                                {{ $barrio->nombreBarrio }} - {{ $barrio->zona }} - {{ $barrio->tipoUnidad }}
                                {{ $barrio->codigoNumero }}
                            </option>
                        @endforeach
                    </select>
                    <!-- Tooltip -->
                    <div class="absolute hidden group-hover:block group-focus:block bg-gray-800 text-white text-sm rounded-lg px-4 py-2 w-64 shadow-lg left-0 z-10"
                        style="top:-6rem">
                        Selecciona el barrio o vereda correspondiente a tu ubicación. Este campo es obligatorio.
                    </div>
                </div>

                @error('id_barrio')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Mapa -->
            <div class="mb-4">
                <label for="map" class="block text-sm font-medium text-gray-700 mb-2">
                    📍 Selecciona la ubicación de tu casa (opcional)
                </label>
                <p class="text-sm text-gray-500 mb-4">
                    No es obligatorio, pero esto nos ayudará a encontrar tu dirección de manera más rápida y precisa.
                </p>
            </div>
            <div id="map" wire:ignore style="height: 400px; z-index: 40"></div>
            @error('lat')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
            @error('lng')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
            <input type="hidden" id="lat" wire:model="lat" readonly>
            <input type="hidden" id="lng" wire:model="lng" readonly>

            <div class="mb-4 relative">
                <p>Latitud seleccionada: {{ $lat }}</p>
                <p>Longitud seleccionada: {{ $lng }}</p>
            </div>
            {{-- observaciones --}}
            <div class="mb-4 relative">
                <div class="flex flex-wrap items-center">
                    <div class="flex items-center">
                        <x-label for="observaciones" class="block text-sm font-medium">Observaciones</x-label>
                    </div>
                    <div class="relative group w-full">
                        <textarea id="observaciones" wire:model="observaciones"
                            class="mt-1 block w-full border border-gray-300 rounded-lg focus:ring focus:ring-indigo-300"></textarea>
                        <!-- Tooltip -->
                        <div class="absolute hidden group-hover:block group-focus:block bg-gray-800 text-white text-sm rounded-lg px-4 py-2 w-64 shadow-lg left-0 z-10"
                            style="top:-7rem; z-index: 100">
                            Ingresa cualquier observación o comentario adicional que consideres importante. Este campo
                            es opcional.
                        </div>
                    </div>
                    @error('observaciones')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Contenedor para los Archivos Adjuntos Opcionales -->
            <div class="p-6 mb-8 border border-blue-300 rounded-lg bg-blue-50">
                <h3 class="text-lg font-semibold text-blue-800 mb-4">Archivos Adjuntos (Opcional)</h3>
                <p class="text-sm text-blue-700 mb-6">
                    Los siguientes anexos son opcionales y pueden ayudar a agilizar el proceso de su solicitud. Si no
                    tiene estos documentos, aún puede completar y enviar el formulario.
                </p>

                <!-- Subir Acción Comunal -->
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        for="accion_comunal_input">
                        Subir Certificación de la Junta de Acción Comunal
                    </label>
                    <div class="relative group">
                        <input wire:model="accion_comunal"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50
            dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="accion_comunal_input" type="file" accept="application/pdf,image/jpeg,image/jpg">

                        <!-- Tooltip -->
                        <div
                            class="absolute left-0 hidden p-2 mt-1 text-xs text-white bg-gray-900 rounded-lg shadow-md group-hover:block dark:bg-gray-800">
                            Asegúrese de que el archivo sea legible y no borroso. Los documentos PDF deben ser
                            originales,
                            emitidos por la respectiva entidad, y no deben contener modificaciones.
                            Solo se aceptarán archivos PDF o JPG.
                        </div>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-300" id="sisben_input_help">PDF, JPG
                            (MAX. 10MB).</p>
                    </div>

                    <!-- Indicador de carga -->
                    <div wire:loading wire:target="accion_comunal"
                        class="mt-2 text-sm text-blue-600 dark:text-blue-400">
                        Subiendo archivo, por favor espere...
                    </div>

                    <!-- Botón para limpiar archivo -->
                    @if ($accion_comunal)
                        <div class="flex items-center mt-2">
                            <span class="text-green-600 text-sm">Archivo seleccionado:
                                {{ $accion_comunal->getClientOriginalName() }}</span>
                            <button type="button" wire:click="$set('accion_comunal', null)"
                                class="ml-2 px-2 py-1 text-xs text-white bg-red-500 rounded hover:bg-red-600">
                                Quitar
                            </button>
                        </div>
                    @endif

                    @error('accion_comunal')
                        <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Subir Certificado Electoral -->
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="electoral_input">
                        Subir Certificado Electoral (Antigüedad mínima de 12 meses)
                    </label>
                    <div class="relative group">
                        <input wire:model="electoral"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50
            dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="electoral_input" type="file" accept="application/pdf,image/jpeg,image/jpg">

                        <div
                            class="absolute left-0 hidden p-2 mt-1 text-xs text-white bg-gray-900 rounded-lg shadow-md group-hover:block dark:bg-gray-800">
                            Asegúrese de que el certificado electoral sea emitido por la entidad oficial
                            correspondiente, con una antigüedad mínima de 12 meses. No se aceptarán documentos
                            con enmiendas o modificaciones. Solo se admiten formatos PDF o JPG.
                        </div>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-300" id="sisben_input_help">PDF, JPG
                            (MAX. 10MB).</p>
                    </div>

                    <div wire:loading wire:target="electoral" class="mt-2 text-sm text-blue-600 dark:text-blue-400">
                        Subiendo archivo, por favor espere...
                    </div>

                    @if ($electoral)
                        <div class="flex items-center mt-2">
                            <span class="text-green-600 text-sm">Archivo seleccionado:
                                {{ $electoral->getClientOriginalName() }}</span>
                            <button type="button" wire:click="$set('electoral', null)"
                                class="ml-2 px-2 py-1 text-xs text-white bg-red-500 rounded hover:bg-red-600">
                                Quitar
                            </button>
                        </div>
                    @endif

                    @error('electoral')
                        <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Subir Constancia de Sisben -->
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="sisben_input">
                        Subir Constancia de Sisben
                    </label>
                    <div class="relative group">
                        <input wire:model="sisben"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50
            dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="sisben_input" type="file" accept="application/pdf,image/jpeg,image/jpg">

                        <div
                            class="absolute left-0 hidden p-2 mt-1 text-xs text-white bg-gray-900 rounded-lg shadow-md group-hover:block dark:bg-gray-800">
                            Asegúrese de que la constancia de Sisben esté emitida por la entidad oficial correspondiente
                            y
                            sea completamente legible. No se aceptarán documentos con tachaduras, enmiendas o copias
                            modificadas.
                            Solo se admitirán formatos PDF o JPG.
                        </div>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-300" id="sisben_input_help">PDF, JPG
                            (MAX. 10MB).</p>
                    </div>

                    <div wire:loading wire:target="sisben" class="mt-2 text-sm text-blue-600 dark:text-blue-400">
                        Subiendo archivo, por favor espere...
                    </div>

                    @if ($sisben)
                        <div class="flex items-center mt-2">
                            <span class="text-green-600 text-sm">Archivo seleccionado:
                                {{ $sisben->getClientOriginalName() }}</span>
                            <button type="button" wire:click="$set('sisben', null)"
                                class="ml-2 px-2 py-1 text-xs text-white bg-red-500 rounded hover:bg-red-600">
                                Quitar
                            </button>
                        </div>
                    @endif

                    @error('sisben')
                        <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Subir Fotocopia de Cédula -->
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="cedula_input">
                        Subir Fotocopia de Cédula
                    </label>
                    <div class="relative group">
                        <input wire:model="cedula"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50
            dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="cedula_input" type="file" accept="application/pdf,image/jpeg,image/jpg">

                        <div
                            class="absolute left-0 hidden p-2 mt-1 text-xs text-white bg-gray-900 rounded-lg shadow-md group-hover:block dark:bg-gray-800">
                            Asegúrese de que la fotocopia sea completamente legible, sin tachaduras ni áreas borrosas.
                            El archivo debe ser escaneado en alta calidad y contener ambos lados de la cédula si es
                            necesario.
                            Solo se aceptan formatos PDF o JPG.
                        </div>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-300" id="sisben_input_help">PDF, JPG
                            (MAX. 10MB).</p>
                    </div>

                    <div wire:loading wire:target="cedula" class="mt-2 text-sm text-blue-600 dark:text-blue-400">
                        Subiendo archivo, por favor espere...
                    </div>

                    @if ($cedula)
                        <div class="flex items-center mt-2">
                            <span class="text-green-600 text-sm">Archivo seleccionado:
                                {{ $cedula->getClientOriginalName() }}</span>
                            <button type="button" wire:click="$set('cedula', null)"
                                class="ml-2 px-2 py-1 text-xs text-white bg-red-500 rounded hover:bg-red-600">
                                Quitar
                            </button>
                        </div>
                    @endif

                    @error('cedula')
                        <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>



            <!-- Título de Términos y Condiciones -->
            <div class="mt-8 mb-6 text-center">
                <h2 class="text-2xl font-extrabold text-gray-800 uppercase tracking-wide">
                    Términos y Condiciones de Datos Personales*
                </h2>
            </div>

            <!-- Sección de Términos y Condiciones con Checkbox -->
            <div class="mb-8">
                <div class="flex items-start space-x-2 p-4 border border-green-500 rounded-lg bg-green-50">
                    <div class="relative group flex items-center">
                        <input type="checkbox" wire:model="terminos"
                            class="w-6 h-6 text-green-600 border-green-500 rounded focus:ring focus:ring-green-400"
                            required>
                        <!-- Tooltip -->
                        <div class="absolute hidden group-hover:block group-focus:block bg-gray-800 text-white text-sm rounded-lg px-4 py-2 w-64 shadow-lg left-8 z-10"
                            style="top:-2.5rem">
                            Acepta los términos y condiciones para continuar. Este campo es obligatorio.
                        </div>
                    </div>

                    <span class="text-green-700 leading-snug font-semibold">
                        Acepto las condiciones establecidas en la política de tratamiento de información de la Alcaldía
                        de Acacias: <a
                            href="https://www.acacias.gov.co/publicaciones/5414/politica-de-tratamiento-de-datos-personales/"
                            target="_blank" class="text-green-700 underline hover:text-green-800">Políticas
                            de Protección de Datos Personales</a>.
                    </span>
                </div>
                @error('terminos')
                    <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Botón de Enviar -->
            <div class="flex justify-end mt-8 mb-12">
                <button type="submit"
                    class="flex items-center justify-center px-6 py-3 space-x-3 text-lg font-semibold text-white uppercase transition duration-300 transform bg-blue-600 rounded-lg shadow-lg hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300"
                    wire:loading.attr="disabled"
                    wire:loading.class="bg-gray-400 hover:bg-gray-400 cursor-not-allowed">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    <span wire:loading.remove>Crear trámite</span>
                    <span wire:loading>Procesando...</span>
                </button>
            </div>

        </form>
    </div>
    <x-sweet-alert-good></x-sweet-alert-good>
    <script>
        var map = L.map('map').setView([3.99077, -73.76714], 15);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.nomaddi.com">Nomaddi</a> 2025'
        }).addTo(map);

        var marker;

        map.on('click', function(e) {
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;

            // Mueve o crea el marcador
            if (marker) {
                marker.setLatLng(e.latlng);
            } else {
                marker = L.marker(e.latlng).addTo(map).bindPopup('Ubicación seleccionada').openPopup();
            }

            // Actualiza los campos ocultos del formulario
            document.getElementById('lat').value = lat;
            document.getElementById('lng').value = lng;

            // Enviar las coordenadas al componente Livewire usando dispatch
            Livewire.dispatch('updateLocation', {
                lat,
                lng
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#id_barrio').select2();

            $('#id_barrio').on('change', function(e) {
                @this.set('id_barrio', e.target.value);
            });
        });

        document.addEventListener("livewire:load", function() {
            Livewire.hook('message.processed', (message, component) => {
                $('#id_barrio').select2();
            });
        });
    </script>



</div>
