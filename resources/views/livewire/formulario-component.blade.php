<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-7">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <!-- Mensaje de éxito -->
        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">{{ session('message') }}</strong>
            </div>
        @endif
        <form wire:submit.prevent="save" enctype="multipart/form-data">
            @csrf
            <div class="mb-2 underline text-center">
                <h2 class="text-lg">Información de la solicitud</h2>
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
                    <!-- Ícono de pregunta -->
                    <div class="ml-1 tooltip">
                        <a href="#" class="hover:text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                        </a>
                        <div
                            class="absolute left-5 top-0 z-10 w-48 p-2 mt-2 text-sm text-gray-700 bg-white border border-gray-300 rounded shadow-lg invisible tooltip-item">
                            El documento de identidad no se puede modificar.
                        </div>
                    </div>
                </div>
                <x-input id="numeroIdentificacion" type="text" wire:model="numeroIdentificacion"
                    class="mt-1 block w-full" placeholder="Ingrese el número de identificación" readonly />
                @error('numeroIdentificacion')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Modal -->
            <!-- Campo de dirección fuera del modal, parte del formulario -->
            <div class="mt-4 mb-4 relative">
                <div class="flex items-center">
                    <x-label class="block text-sm font-medium">Dirección*</x-label>
                    <!-- Ícono de pregunta -->
                    <div class="ml-1 tooltip">
                        <a href="#" class="hover:text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                        </a>
                        <div
                            class="absolute left-5 top-0 z-10 w-48 p-2 mt-2 text-sm text-gray-700 bg-white border border-gray-300 rounded shadow-lg invisible tooltip-item">
                            De clic en el boton azul con el simbolo más, para agregar se dirección.
                        </div>
                    </div>
                </div>
                <div class="w-full mb-4 flex items-center">
                    <x-input type="text" wire:model="direccion" id="direccionInput"
                        class="w-full rounded-lg border border-gray-400 p-2" placeholder="Seleccione su dirección"
                        readonly />
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
                                        <label class="block font-bold">Vía Principal:</label>
                                        <div class="grid grid-cols-6 gap-2">
                                            <select class="border border-gray-300 rounded p-1 text-sm col-span-2"
                                                x-model="tipoViaPrimaria" @change="actualizarDireccion()">
                                                <option value="">Tipo de vía</option>
                                                <option value="AC">Avenida calle</option>
                                                <option value="AK">Avenida carrera</option>
                                                <option value="CL">Calle</option>
                                                <option value="KR">Carrera</option>
                                                <option value="DG">Diagonal</option>
                                                <option value="TV">Transversal</option>
                                            </select>

                                            <input type="number"
                                                class="border border-gray-300 rounded p-1 text-sm col-span-1"
                                                x-model="numeroViaPrincipal" @input="actualizarDireccion()"
                                                placeholder="Número" min="0" step="1">

                                            <select class="border border-gray-300 rounded p-1 text-sm col-span-1"
                                                x-model="letraViaPrincipal" @change="actualizarDireccion()">
                                                <option value="">Letra</option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                            </select>

                                            <select class="border border-gray-300 rounded p-1 text-sm col-span-1"
                                                x-model="bis" @change="actualizarDireccion()">
                                                <option value="">Bis</option>
                                                <option value="BIS">BIS</option>
                                            </select>

                                            <select class="border border-gray-300 rounded p-1 col-span-1 text-sm"
                                                x-model="cuadranteViaPrincipal" @change="actualizarDireccion()">
                                                <option value="">Sector</option>
                                                <option value="SUR">SUR</option>
                                                <option value="NORTE">NORTE</option>
                                                <option value="OESTE">OESTE</option>
                                                <option value="ESTE">ESTE</option>
                                            </select>
                                        </div>

                                        <!-- Segundo bloque: Vía Secundaria y Vía Complemento en dos columnas -->
                                        <div class="grid grid-cols-6 gap-2 mt-4">
                                            <!-- Vía Secundaria (col-span-3) -->
                                            <div class="col-span-4">
                                                <label class="block font-bold">Vía Secundaria</label>
                                                <div class="grid grid-cols-3 gap-2">
                                                    <input type="text"
                                                        class="border border-gray-300 rounded p-1 text-sm col-span-1"
                                                        x-model="numeroViaGeneradora" @input="actualizarDireccion()"
                                                        placeholder="No.">

                                                    <select
                                                        class="border border-gray-300 rounded p-1 text-sm col-span-1"
                                                        x-model="letraViaGeneradora" @change="actualizarDireccion()">
                                                        <option value="">Letra</option>
                                                        <option value="A">A</option>
                                                        <option value="B">B</option>
                                                    </select>

                                                    <input type="text"
                                                        class="border border-gray-300 rounded p-1 text-sm col-span-1"
                                                        x-model="numeroPlaca" @input="actualizarDireccion()"
                                                        placeholder="Número placa">
                                                </div>
                                            </div>

                                            <!-- Vía Complemento (col-span-3) -->
                                            <div class="col-span-2">
                                                <label class="block font-bold">Vía Complemento</label>
                                                <div class="grid grid-cols-1 gap-2">
                                                    <select
                                                        class="border border-gray-300 rounded p-1 text-sm col-span-1"
                                                        x-model="cuadranteViaGeneradora"
                                                        @change="actualizarDireccion()">
                                                        <option value="">Sector</option>
                                                        <option value="SUR">SUR</option>
                                                        <option value="NORTE">NORTE</option>
                                                        <option value="OESTE">OESTE</option>
                                                        <option value="ESTE">ESTE</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- campo adicional -->
                                        <label class="block font-bold  mt-4">Adicionar otro complemento:</label>
                                        <div class="grid grid-cols-6 gap-2">
                                            <select class="border border-gray-300 rounded p-1 text-sm col-span-2"
                                                x-model="complemento" @change="actualizarDireccion()">
                                                <option value="AP">Apartamento</option>
                                                <option value="AG">Agrupación</option>
                                                <option value="BL">Bloque</option>
                                                <option value="BG">Bodega</option>
                                                <option value="CN">Camino</option>
                                                <option value="CT ">Carretera</option>
                                                <option value="CEL">Célula</option>
                                                <option value="CA">Casa</option>
                                                <option value="CONJ">Conjunto</option>
                                                <option value="CS ">Consultorio</option>
                                                <option value="DP">Depósito</option>
                                                <option value="ED ">Edificio</option>
                                                <option value="EN">Entrada</option>
                                                <option value="ESQ">Esquina</option>
                                                <option value="ET">Etapa</option>
                                                <option value="GJ">Garaje</option>
                                                <option value="IN">Interior</option>
                                                <option value="KM">Kilómetro</option>
                                                <option value="LC">Local</option>
                                                <option value="LT">Lote</option>
                                                <option value="MZ">Manzana</option>
                                                <option value="MN">Mezanine</option>
                                                <option value="MD">Módulo</option>
                                                <option value="OF">Oficina</option>
                                                <option value="PS">Paseo</option>
                                                <option value="PA">Parcela</option>
                                                <option value="PH">Penthouse</option>
                                                <option value="PI">Piso</option>
                                                <option value="PN">Puente</option>
                                                <option value="PD">Predio</option>
                                                <option value="SC">Salón comunal</option>
                                                <option value="SR">Sector</option>
                                                <option value="SL">Solar</option>
                                                <option value="SS">Semi sótano</option>
                                                <option value="SM">Super manzana</option>
                                                <option value="TO">Torre</option>
                                                <option value="UN">Unidad</option>
                                                <option value="UR">Unidad residencialc</option>
                                                <option value="URB">Urbanización</option>
                                                <option value="ZN">Zona</option>
                                            </select>

                                            <input type="text"
                                                class="border border-gray-300 rounded p-1 text-sm col-span-2"
                                                x-model="otro" @input="actualizarDireccion()"
                                                placeholder="escriba lo faltante">
                                        </div>

                                        <!-- Dirección Generada -->
                                        <div class="mt-4">
                                            <label class="block font-bold">Dirección Generada:</label>
                                            <input type="text" x-model="direccionGenerada"
                                                class="w-full bg-gray-100 border border-gray-300 rounded p-1" readonly>
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

            {{-- barrio --}}
            <div class="mb-4 relative">
                <div class="flex items-center">
                    <x-label for="id_barrio" class="block text-sm font-medium">Barrio</x-label>
                    <!-- Ícono de pregunta -->
                    <div class="ml-1 tooltip">
                        <a href="#" class="hover:text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                        </a>
                        <div
                            class="absolute left-5 top-0 z-10 w-48 p-2 mt-2 text-sm text-gray-700 bg-white border border-gray-300 rounded shadow-lg invisible tooltip-item">
                            Seleccione el barrio de donde vive.
                        </div>
                    </div>
                </div>
                <select name="id_barrio" id="id_barrio" wire:model="id_barrio"
                    class="block mt-1 w-full border border-gray-300 rounded-lg">
                    <option value="" selected>Selecciona un barrio</option>
                    @foreach ($barrios as $barrio)
                        <option value="{{ $barrio->id }}">{{ $barrio->nombreBarrio }}</option>
                    @endforeach
                </select>
                @error('id_barrio')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>


            {{-- observaciones --}}
            <div class="mb-4 relative">
                <div class="flex flex-wrap items-center">
                    <x-label for="observaciones" class="block text-sm font-medium">Observaciones</x-label>
                    <!-- Ícono de pregunta -->
                    <div class="ml-1 tooltip">
                        <a href="#" class="hover:text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                        </a>
                        <div
                            class="absolute left-5 top-0 z-10 w-48 p-2 mt-2 text-sm text-gray-700 bg-white border border-gray-300 rounded shadow-lg invisible tooltip-item">
                            Algo que quieras agregar de mas.
                        </div>
                    </div>
                    <textarea id="observaciones" wire:model="observaciones" class="mt-1 block w-full border border-gray-300 rounded-lg"></textarea>
                    @error('observaciones')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>



            {{-- evidenciaPDF --}}
            <div class="relative">
                <label for="dropzone-file"
                    class="mx-auto cursor-pointer flex w-full max-w-lg flex-col items-center rounded-xl border-2 border-dashed border-blue-400 bg-white p-6 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>

                    <h2 class="mt-4 text-xl font-medium text-gray-700 tracking-wide">Anexa documentos de soporte
                    </h2>

                    <p class="mt-2 text-gray-500 tracking-wide">Fornatos permitidos: .7z .csv .doc .docm .docx
                        .dotm
                        .dotx .flv .gif .tif .tiff .jpg .jpeg .mp3 .pdf .png .pot .potx .pps .ppsm .ppsx .ppt .pptx
                        .rar
                        .swf .xls .xlsm .xlsx .zip
                    </p>

                    <input id="dropzone-file" type="file" wire:model="evidenciaPDF" multiple class="hidden" />
                    <!-- Ícono de pregunta -->
                    <div class="ml-1 tooltip">
                        <a href="#" class="hover:text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                        </a>
                        <div
                            class="absolute left-auto top-auto z-10 w-48 p-2 mt-2 text-sm text-gray-700 bg-white border border-gray-300 rounded shadow-lg invisible tooltip-item">
                            Agregue aquí el anexo obligatorio. {{-- jhon aqui no se bien que texto poner --}}
                        </div>
                    </div>
                    @error('evidenciaPDF')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
            </div>

            <div class="mb-2 mt-4 underline text-center">
                <h2 class="text-lg">Términos y Condiciones de datos personales*</h2>
            </div>


            {{-- Términos y Condiciones de datos personales --}}
            <div class="mb-2 mt-4">
                <div class="mt-1 block w-full border border-gray-300 rounded-lg bg-gray-300 bg-opacity-30">
                    <input type="checkbox" wire:model="terminos"
                        class="w-5 h-5 text-indigo-800 border-gray-300 rounded">
                    <span class="ml-2">Acepto las condiciones establecidas en la política de tratamiento de
                        información de la Alcaldía de Acacias: Políticas de Protección de Datos Personales.</span>
                </div>
                @error('terminos')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>


            <div class="flex justify-end">
                <button type="submit"
                    class="flex items-center justify-center px-3 py-2 space-x-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Crear tramite</span>
                </button>
            </div>
        </form>
    </div>
</div>
