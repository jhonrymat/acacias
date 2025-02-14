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
        <div x-show="showModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full"
            style="display: none;">
            <div class="relative top-20 mx-auto p-5 border w-full max-w-lg shadow-lg rounded-md bg-white">

                <!-- Formulario dentro del modal -->
                <form wire:submit.prevent="save">
                    <div class="mb-4">
                        <label for="nombreBarrio" class="block text-sm font-medium">Nombre del Barrio</label>
                        <input type="text" wire:model="nombreBarrio" id="nombreBarrio" class="mt-1 block w-full"
                            required>
                        @error('nombreBarrio')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="tipoUnidad" class="block text-sm font-medium">Tipo de unidad (UPZ o UPR)</label>
                        <select wire:model="tipoUnidad" id="tipoUnidad" class="mt-1 block w-full" required>
                            <option value="" selected>Selecciona una unidad</option>
                            <option value="UPZ">UPZ</option>
                            <option value="UPR">UPR</option>
                        </select>
                        @error('tipoUnidad')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="codigoNumero" class="block text-sm font-medium">Numero</label>
                        <select wire:model="codigoNumero" id="codigoNumero" class="mt-1 block w-full" required>
                            <option value="" selected>Selecciona una Numero</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                        @error('codigoNumero')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="zona" class="block text-sm font-medium">Zona (Barrio, Vereda)</label>
                        <select wire:model="zona" id="zona" class="mt-1 block w-full" required>
                            <option value="" selected>Selecciona una zona</option>
                            <option value="Barrio">Barrio</option>
                            <option value="Vereda">Vereda</option>
                            <!-- Agregar más opciones según lo que necesites -->
                        </select>
                        @error('zona')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- latitud y logitud --}}
                    <div class="mb-4">
                        <label for="lat" class="block text-sm font-medium">Latitud</label>
                        <input type="text" wire:model="lat" id="lat" class="mt-1 block w-full" required>
                    </div>
                    @error('lat')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror

                    <div class="mb-4">
                        <label for="lng" class="block text-sm font-medium">Longitud</label>
                        <input type="text" wire:model="lng" id="lng" class="mt-1 block w-full" required>
                    </div>
                    @error('lng')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror

                    <!-- Botón para obtener la ubicación -->
                    <div class="mb-4">
                        <button type="button" onclick="getLocation()" class="px-4 py-2 bg-blue-500 text-white rounded">
                            Obtener ubicación actual
                        </button>
                        <button type="button" onclick="improveLocation()"
                            class="px-4 py-2 bg-gray-500 text-white rounded ml-2">
                            Mejorar ubicación
                        </button>
                    </div>


                    <div class="flex justify-end space-x-2">
                        <!-- Botón para cerrar el modal -->
                        <button type="button" @click="showModal = false"
                            class="px-4 py-2 bg-gray-500 text-white rounded">
                            Cancelar
                        </button>
                        <!-- Botón para guardar el formulario -->
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">
                            @if ($barrio_id)
                                Actualizar
                            @else
                                Crear
                            @endif
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;

                        // Actualiza los campos de latitud y longitud
                        document.getElementById('lat').value = lat;
                        document.getElementById('lng').value = lng;

                        // Envía las coordenadas al componente Livewire
                        Livewire.dispatch('updateCoordinates', {
                            lat,
                            lng
                        });

                        // Muestra un mensaje de éxito
                        Swal.fire({
                            icon: 'success',
                            title: '¡Ubicación obtenida!',
                            text: `Latitud: ${lat}, Longitud: ${lng}`,
                            timer: 3000,
                            showConfirmButton: false
                        });

                        console.log("Ubicación obtenida:", lat, lng);
                    },
                    function(error) {
                        handleLocationError(error);
                    }, {
                        enableHighAccuracy: true, // Habilitar alta precisión
                        timeout: 10000, // Tiempo de espera máximo
                        maximumAge: 0 // No usar ubicaciones en caché
                    }
                );
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Geolocalización no soportada',
                    text: 'Tu navegador no soporta la geolocalización.',
                });
            }
        }

        function improveLocation() {
            Swal.fire({
                icon: 'info',
                title: 'Mejorando precisión...',
                text: 'Intentando mejorar la precisión de la ubicación.',
                timer: 2000,
                showConfirmButton: false
            });
            getLocation();
        }

        function handleLocationError(error) {
            let message = 'Error al obtener la ubicación.';
            let helpMessage = '';

            switch (error.code) {
                case error.PERMISSION_DENIED:
                    message = 'Permiso denegado.';
                    helpMessage = `
                <p>Por favor, sigue las instrucciones para activar los permisos de ubicación:</p>
                <ul style="text-align: left;">
                    <li><strong>En Chrome:</strong> Haz clic en el candado junto a la barra de direcciones y selecciona "Permitir ubicación".</li>
                    <li><strong>En Firefox:</strong> Ve a la configuración del sitio y habilita los permisos de ubicación.</li>
                    <li><strong>En Safari:</strong> Ve a "Configuración > Privacidad > Servicios de localización" y permite la ubicación.</li>
                </ul>
            `;
                    break;
                case error.POSITION_UNAVAILABLE:
                    message = 'Ubicación no disponible.';
                    helpMessage = 'Verifica que tu GPS esté activado.';
                    break;
                case error.TIMEOUT:
                    message = 'La solicitud de ubicación ha caducado.';
                    helpMessage = 'Intenta obtener la ubicación nuevamente.';
                    break;
                default:
                    message = 'Ha ocurrido un error desconocido.';
                    helpMessage = 'Por favor, intenta nuevamente.';
                    break;
            }

            Swal.fire({
                icon: 'error',
                title: message,
                html: helpMessage,
                footer: '<a target="_blank" href="https://support.google.com/chrome/answer/142065">¿Cómo activar permisos de ubicación?</a>',
                confirmButtonText: 'Intentar de nuevo',
                showCancelButton: true,
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    getLocation(); // Reintenta obtener la ubicación
                }
            });

            console.error("Error al obtener la ubicación:", error);
        }
    </script>


</div>
