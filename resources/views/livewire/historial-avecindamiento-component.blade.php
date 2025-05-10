<div>
    <div class="w-3/4 mx-auto py-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Historial de solicitudes de avecindamiento</h1>
        </div>
        <!-- Componente de tabla -->
        @livewire('historial-avecindamiento-datatable')
    </div>
    <div x-data="{
        showModal: @entangle('showForm'),
        coordenadas: @entangle('coordenadasFrente'),
        coordenadasMatricula: @entangle('coordenadasMatricula')
    }" x-init="$watch('showModal', value => {
        if (value) {
            setTimeout(() => {
                if (document.getElementById('mapaFrente')?.offsetParent !== null) {
                    window.initLeafletMapaFrente(coordenadas);
                }
                if (document.getElementById('mapaMatricula')?.offsetParent !== null) {
                    window.initLeafletMapaMatricula(coordenadasMatricula);
                }
            }, 300);
        }
    })" x-cloak>
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
                            <h3 class="font-bold text-sm">¿Se evidencia que la persona vive en dirección aportada?</h3>
                            <p class="text-gray-700">{{ $evidencia_residencia ? 'Sí' : 'No' }}</p>
                        </div>

                        <div class="mb-3    ">
                            <h3 class="font-bold text-sm">Tiempo en el que lleva viviendo en el inmueble:</h3>
                            <p class="text-gray-700">Años: {{ $tiempo_residencia_anios ?? 'N/A' }}</p>
                            <p class="text-gray-700">Meses: {{ $tiempo_residencia_meses ?? 'N/A' }}</p>
                        </div>


                        <div class="mb-6" x-data="{
                            tab: 'frente',
                            frenteIniciado: false,
                            matriculaIniciada: false,
                            initMapaFrente() {
                                if (!this.frenteIniciado && typeof window.initLeafletMapaFrente === 'function') {
                                    this.frenteIniciado = true;
                                    setTimeout(() => window.initLeafletMapaFrente(coordenadas), 200);
                                } else {
                                    setTimeout(() => window.mapaFrenteInstancia.invalidateSize(), 200);
                                }
                            },
                            initMapaMatricula() {
                                if (!this.matriculaIniciada && typeof window.initLeafletMapaMatricula === 'function') {
                                    this.matriculaIniciada = true;
                                    setTimeout(() => window.initLeafletMapaMatricula(coordenadasMatricula), 200);
                                } else {
                                    setTimeout(() => window.mapaMatriculaInstancia.invalidateSize(), 200);
                                }
                            }
                        }">
                            <h3 class="text-lg font-semibold mb-2">Captura de imágenes</h3>

                            <div class="flex mb-4">
                                <button class="px-4 py-2 rounded-l border border-gray-300 text-sm"
                                    :class="tab === 'frente' ? 'bg-blue-500 text-white' : 'bg-white text-gray-700'"
                                    @click="tab = 'frente'; initMapaFrente()">
                                    Frente
                                </button>
                                <button class="px-4 py-2 rounded-r border border-gray-300 text-sm"
                                    :class="tab === 'matricula' ? 'bg-blue-500 text-white' : 'bg-white text-gray-700'"
                                    @click="tab = 'matricula'; initMapaMatricula()">
                                    Matrícula
                                </button>
                            </div>

                            {{-- TAB FRENTE --}}
                            <div x-show="tab === 'frente'" x-transition>
                                @if (isset($solicitud_avecindamiento) && $solicitud_avecindamiento->imagenes->where('tipo', 'frente')->count())
                                    <div class="mb-6">
                                        <h3 class="text-lg font-semibold mb-2">Fotos del frente de la casa</h3>
                                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                                            @foreach ($solicitud_avecindamiento->imagenes->where('tipo', 'frente') as $img)
                                                <div
                                                    class="flex flex-col items-center bg-white p-2 rounded border shadow-sm">
                                                    <a href="{{ Storage::url($img->ruta) }}" target="_blank"
                                                        class="mb-2">
                                                        <img src="{{ Storage::url($img->ruta) }}"
                                                            class="w-28 h-28 object-cover rounded">
                                                    </a>
                                                    <p class="text-[11px] text-center text-gray-600 leading-tight">
                                                        Lat: {{ $img->lat ?? 'N/A' }}<br>
                                                        Lng: {{ $img->lng ?? 'N/A' }}
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div id="mapaFrente" class="h-80 rounded border"></div>
                                    </div>
                                @else
                                    <div class="text-sm text-gray-500 italic">No se encontraron imágenes del frente.
                                    </div>
                                @endif
                            </div>

                            {{-- TAB MATRÍCULA --}}
                            <div x-show="tab === 'matricula'" x-transition>
                                @if (isset($solicitud_avecindamiento) && $solicitud_avecindamiento->imagenes->where('tipo', 'matricula')->count())
                                    <div class="mb-6">
                                        <h3 class="text-lg font-semibold mb-2">Fotos de la matrícula</h3>
                                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                                            @foreach ($solicitud_avecindamiento->imagenes->where('tipo', 'matricula') as $img)
                                                <div
                                                    class="flex flex-col items-center bg-white p-2 rounded border shadow-sm">
                                                    <a href="{{ Storage::url($img->ruta) }}" target="_blank"
                                                        class="mb-2">
                                                        <img src="{{ Storage::url($img->ruta) }}"
                                                            class="w-28 h-28 object-cover rounded">
                                                    </a>
                                                    <p class="text-[11px] text-center text-gray-600 leading-tight">
                                                        Lat: {{ $img->lat ?? 'N/A' }}<br>
                                                        Lng: {{ $img->lng ?? 'N/A' }}
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div id="mapaMatricula" class="h-80 rounded border mt-4"></div>
                                    </div>
                                @else
                                    <div class="text-sm text-gray-500 italic">No se encontraron imágenes de matrícula.
                                    </div>
                                @endif
                            </div>
                        </div>
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
                    <button @click="showModal = false"
                        class="px-4 py-2 bg-gray-500 text-white rounded">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.initLeafletMapaFrente = function(coordenadas) {
            if (window.mapaFrenteInstancia) {
                window.mapaFrenteInstancia.remove(); // eliminar mapa previo si lo hay
            }

            const contenedor = document.getElementById('mapaFrente');
            if (!contenedor) return;

            window.mapaFrenteInstancia = L.map(contenedor).setView([4.15, -73.63], 15);
            if (coordenadas.length > 0) {
                const lat = parseFloat(coordenadas[0].lat);
                const lng = parseFloat(coordenadas[0].lng);
                window.mapaFrenteInstancia.setView([lat, lng], 14);
            }


            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.nomaddi.com" target="_blank">Nomaddi</a> 2025'
            }).addTo(window.mapaFrenteInstancia);

            console.log('Puntos cargados:', coordenadas);

            coordenadas.forEach((coordenada, i) => {
                console.log('Marcador', i, coordenada.lat, coordenada.lng);
                if (coordenada.lat && coordenada.lng) {
                    L.marker([parseFloat(coordenada.lat), parseFloat(coordenada.lng)])
                        .addTo(window.mapaFrenteInstancia)
                        .bindPopup(
                            `<img src='${coordenada.url}' width='100'><br>Lat: ${coordenada.lat}<br>Lng: ${coordenada.lng}`
                        );
                    // .openPopup();
                }
            });

        };
    </script>
    <script>
        window.initLeafletMapaMatricula = function(coordenadas) {
            if (window.mapaMatriculaInstancia) {
                window.mapaMatriculaInstancia.remove();
            }

            const contenedor = document.getElementById('mapaMatricula');
            if (!contenedor) return;

            window.mapaMatriculaInstancia = L.map(contenedor).setView([4.15, -73.63], 15);

            if (coordenadas.length > 0) {
                const lat = parseFloat(coordenadas[0].lat);
                const lng = parseFloat(coordenadas[0].lng);
                window.mapaMatriculaInstancia.setView([lat, lng], 14);
            }

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.nomaddi.com" target="_blank">Nomaddi</a> 2025'
            }).addTo(window.mapaMatriculaInstancia);

            console.log('Puntos matrícula:', coordenadas);

            coordenadas.forEach((coordenada, i) => {
                const marker = L.marker([parseFloat(coordenada.lat), parseFloat(coordenada.lng)])
                    .addTo(window.mapaMatriculaInstancia)
                    .bindPopup(
                        `<img src='${coordenada.url}' width='100'><br>Lat: ${coordenada.lat}<br>Lng: ${coordenada.lng}`
                    );

                // if (i === 0) {
                //     marker.openPopup();
                // }
            });

            setTimeout(() => {
                window.mapaMatriculaInstancia.invalidateSize();
            }, 300);
        };
    </script>
</div>
