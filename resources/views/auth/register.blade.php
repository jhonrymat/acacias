<x-guest-layout>
    <!-- Contenedor de los botones -->
    <div class="flex justify-end space-x-4 p-4 bg-gray-100">
        <!-- Botón para consultar trámite -->
        <a href="{{ route('consulta.tramite') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition font-bold shadow-md w-full sm:w-auto text-center">
            Consultar Trámite
        </a>
        <!-- Botón para registrarse -->
        <a href="{{ route('login') }}"
            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition font-bold shadow-md w-full sm:w-auto text-center">
            Iniciar Sesión
        </a>
    </div>

    <x-authentication-card>
        <!-- Botón superior derecho -->
        <x-slot name="logo">
            <a href="{{ route('login') }}">
                <x-authentication-card-logo />
            </a>
        </x-slot>

        {{-- <x-validation-errors class="mb-4" /> --}}
        <form method="POST" action="{{ route('register') }}">
            @csrf
            {{-- titulo --}}
            <h2 class="text-center text-2xl font-bold text-gray-800 mb-4">Registro de Usuario</h2>
            {{-- descripcion --}}
            <p class="text-center text-gray-600">Ingresa tus datos para registrarte en el sistema</p>
            {{-- name --}}

            <div class="relative mt-4">
                <div class="flex items-center">
                    <x-label for="name" value="Primer Nombre*" />
                </div>
                <div class="relative group">
                    <x-input id="name" class="block mt-1 w-full focus:ring focus:ring-indigo-300" type="text"
                        name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <!-- Tooltip -->
                    <div class="absolute hidden group-hover:block group-focus:block bg-gray-800 text-white text-sm rounded-lg px-4 py-2 w-64 shadow-lg left-0 z-10"
                        style="top:-3.5rem">
                        Introduce tu primer nombre.
                    </div>
                </div>
                @error('name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            {{-- nombre_2 --}}
            <div class="relative mt-4">
                <div class="flex items-center">
                    <x-label for="nombre_2" value="Segundo Nombre" />
                </div>
                <div class="relative group">
                    <x-input id="nombre_2" class="block mt-1 w-full focus:ring focus:ring-indigo-300" type="text"
                        name="nombre_2" :value="old('nombre_2')" autofocus autocomplete="nombre_2" />
                    <!-- Tooltip -->
                    <div class="absolute hidden group-hover:block group-focus:block bg-gray-800 text-white text-sm rounded-lg px-4 py-2 w-64 shadow-lg left-0 z-10"
                        style="top:-6rem">
                        Introduce tu segundo nombre. Si no tienes uno, puedes dejar este campo vacío.
                    </div>
                </div>
                @error('nombre_2')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            {{-- apellido_1 --}}
            <div class="relative mt-4">
                <div class="flex items-center">
                    <x-label for="apellido_1" value="Primer Apellido*" />
                </div>
                <div class="relative group">
                    <x-input id="apellido_1" class="block mt-1 w-full focus:ring focus:ring-indigo-300" type="text"
                        name="apellido_1" :value="old('apellido_1')" required autofocus autocomplete="apellido_1" />
                    <!-- Tooltip -->
                    <div class="absolute hidden group-hover:block group-focus:block bg-gray-800 text-white text-sm rounded-lg px-4 py-2 w-64 shadow-lg left-0 z-10"
                        style="top:-6rem">
                        Introduce tu primer apellido. Este campo es obligatorio y debe contener solo letras.
                    </div>
                </div>

                @error('apellido_1')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            {{-- apellido_2 --}}
            <div class="relative mt-4">
                <div class="flex items-center">
                    <x-label for="apellido_2" value="Segundo Apellido" />
                </div>
                <div class="relative group">
                    <x-input id="apellido_2" class="block mt-1 w-full focus:ring focus:ring-indigo-300" type="text"
                        name="apellido_2" :value="old('apellido_2')" autofocus autocomplete="apellido_2" />
                    <!-- Tooltip -->
                    <div class="absolute hidden group-hover:block group-focus:block bg-gray-800 text-white text-sm rounded-lg px-4 py-2 w-64 shadow-lg left-0 z-10"
                        style="top:-6rem">
                        Introduce tu segundo apellido. Si no tienes uno, puedes dejar este campo vacío.
                    </div>
                </div>
                @error('apellido_2')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4 relative">
                <div class="flex items-center">
                    <x-label for="email" value="Correo Electrónico*" />
                </div>
                <div class="relative group">
                    <x-input id="email" class="block mt-1 w-full focus:ring focus:ring-indigo-300" type="email"
                        name="email" :value="old('email')" required autocomplete="email" />
                    <!-- Tooltip -->
                    <div class="absolute hidden group-hover:block group-focus:block bg-gray-800 text-white text-sm rounded-lg px-4 py-2 w-64 shadow-lg left-0 z-10"
                        style="top:-7.5rem">
                        Introduce tu dirección de correo electrónico. Este campo es obligatorio y debe ser un correo
                        válido.
                    </div>
                </div>
                @error('email')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>


            <div class="col-span-12 mt-4" x-data="{ show: true }">
                <label class="block" for="password">Contraseña*
                    <p class="block text-gray-500 text-xs">Escribe una contraseña segura</p>
                </label>
                <div class="relative">
                    <div class="relative group">
                        <input
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring focus:ring-indigo-300 text-base"
                            :type="show ? 'password' : 'text'" name="password" id="password" autocomplete="off"
                            type="password">
                        <!-- Tooltip -->
                        <div class="absolute hidden group-hover:block group-focus:block bg-gray-800 text-white text-sm rounded-lg px-4 py-2 w-64 shadow-lg left-0 z-10"
                            style="top:-9rem">
                            Introduce una contraseña segura. Debe contener al menos 8 caracteres, incluyendo letras y
                            números.
                        </div>
                    </div>
                    <div class="absolute top-1/2 right-4 cursor-pointer" style="transform: translateY(-50%);">
                        <svg class="h-4 text-gray-700 block" fill="none" @click="show = !show"
                            :class="{ 'hidden': !show, 'block': show }" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 576 512">
                            <path fill="currentColor"
                                d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                            </path>
                        </svg>

                        <svg class="h-4 text-gray-700 hidden" fill="none" @click="show = !show"
                            :class="{ 'block': !show, 'hidden': show }" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 640 512">
                            <path fill="currentColor"
                                d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                            </path>
                        </svg>
                    </div>
                </div>
                @error('password')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            {{-- Confirmar contraseña --}}
            <div class="col-span-12 mt-4" x-data="{ show: true }">
                <label class="block" for="password_confirmation">Confirmar contraseña*
                    <p class="block text-gray-500 text-xs">Asegurate que sea la misma contraseña</p>
                </label>

                <div class="relative">
                    <div class="relative group">
                        <input
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring focus:ring-indigo-300 text-base"
                            :type="show ? 'password' : 'text'" name="password_confirmation" id="password_confirmation"
                            autocomplete="off" type="password">
                        <!-- Tooltip -->
                        <div class="absolute hidden group-hover:block group-focus:block bg-gray-800 text-white text-sm rounded-lg px-4 py-2 w-64 shadow-lg left-0 z-10"
                            style="top:-9rem">
                            Confirma tu contraseña ingresándola nuevamente. Este campo debe coincidir con la contraseña
                            anterior.
                        </div>
                    </div>
                    <div class="absolute top-1/2 right-4 cursor-pointer" style="transform: translateY(-50%);">
                        <svg class="h-4 text-gray-700 block" fill="none" @click="show = !show"
                            :class="{ 'hidden': !show, 'block': show }" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 576 512">
                            <path fill="currentColor"
                                d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                            </path>
                        </svg>

                        <svg class="h-4 text-gray-700 hidden" fill="none" @click="show = !show"
                            :class="{ 'block': !show, 'hidden': show }" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 640 512">
                            <path fill="currentColor"
                                d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                            </path>
                        </svg>
                    </div>
                </div>
                @error('password_confirmation')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>


            {{-- telefonoContacto --}}
            <div class="relative mt-4">
                <div class="flex items-center">
                    <x-label for="telefonoContacto" value="{{ __('Telefono de Contacto*') }}" />
                </div>
                <div class="relative group">
                    <x-input id="telefonoContacto" class="block mt-1 w-full focus:ring focus:ring-indigo-300"
                        type="number" min="3000000000" max="3999999999" name="telefonoContacto" :value="old('telefonoContacto')"
                        required autofocus autocomplete="telefonoContacto" />
                    <!-- Tooltip -->
                    <div class="absolute hidden group-hover:block group-focus:block bg-gray-800 text-white text-sm rounded-lg px-4 py-2 w-64 shadow-lg left-0 z-10"
                        style="top:-7.5rem">
                        Introduce un número de teléfono válido, comenzando con 3 y seguido por 9 dígitos. Ejemplo:
                        3001234567.
                    </div>
                </div>
                @error('telefonoContacto')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            {{-- fechaNacimiento --}}
            <div class="relative mt-4">
                <div class="flex items-center">
                    <x-label for="fechaNacimiento" value="{{ __('Fecha de Nacimiento*') }}" />
                </div>
                <div class="relative group">
                    <x-input id="fechaNacimiento" class="block mt-1 w-full focus:ring focus:ring-indigo-300"
                        type="date" name="fechaNacimiento" :value="old('fechaNacimiento')" required autofocus
                        autocomplete="fechaNacimiento" />
                    <!-- Tooltip -->
                    <div class="absolute hidden group-hover:block group-focus:block bg-gray-800 text-white text-sm rounded-lg px-4 py-2 w-64 shadow-lg left-0 z-10"
                        style="top:-7.5rem">
                        Selecciona tu fecha de nacimiento. Este campo es obligatorio y debe tener un formato válido
                        (DD/MM/AAAA).
                    </div>
                </div>

                @error('fechaNacimiento')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            {{-- id_tipoSolicitante select de la tabla tsolicitantes --}}
            <div class="relative mt-4">
                <div class="flex items-center">
                    <x-label for="id_tipoSolicitante" value="{{ __('Tipo de Solicitante*') }}" />
                </div>
                <div class="relative group">
                    <select name="id_tipoSolicitante" id="id_tipoSolicitante"
                        class="block mt-1 w-full focus:ring focus:ring-indigo-300" required>
                        <option value="" disabled {{ old('id_tipoSolicitante') == '' ? 'selected' : '' }}>
                            Selecciona un tipo de solicitante
                        </option>
                        @foreach ($tsolicitantes as $tsolicitante)
                            <option value="{{ $tsolicitante->id }}"
                                {{ old('id_tipoSolicitante') == $tsolicitante->id ? 'selected' : '' }}>
                                {{ $tsolicitante->tipoSolicitante }}
                            </option>
                        @endforeach
                    </select>
                    <!-- Tooltip -->
                    <div class="absolute hidden group-hover:block group-focus:block bg-gray-800 text-white text-sm rounded-lg px-4 py-2 w-64 shadow-lg left-0 z-10"
                        style="top:-6rem">
                        Selecciona el tipo de solicitante que corresponde a tu perfil. Este campo es obligatorio.
                    </div>
                </div>
                @error('id_tipoSolicitante')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            {{-- id_tipoDocumento select de la tabla tdocumentos --}}
            <div class="relative mt-4">
                <div class="flex items-center">
                    <x-label for="id_tipoDocumento" value="{{ __('Tipo de Documento*') }}" />
                </div>
                <div class="relative group">
                    <select name="id_tipoDocumento" id="id_tipoDocumento"
                        class="block mt-1 w-full focus:ring focus:ring-indigo-300" required>
                        <option value="" disabled {{ old('id_tipoDocumento') == '' ? 'selected' : '' }}>
                            Selecciona un tipo de documento
                        </option>
                        @foreach ($tdocumentos as $tdocumento)
                            <option value="{{ $tdocumento->id }}"
                                {{ old('id_tipoDocumento') == $tdocumento->id ? 'selected' : '' }}>
                                {{ $tdocumento->tipoDocumento }}
                            </option>
                        @endforeach
                    </select>
                    <!-- Tooltip -->
                    <div class="absolute hidden group-hover:block group-focus:block bg-gray-800 text-white text-sm rounded-lg px-4 py-2 w-64 shadow-lg left-0 z-10"
                        style="top:-7.5rem">
                        Selecciona el tipo de documento que corresponde a tu identificación oficial. Este campo es
                        obligatorio.
                    </div>
                </div>
                @error('id_tipoDocumento')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            {{-- numeroIdentificacion --}}
            <div class="relative mt-4">
                <div class="flex items-center">
                    <x-label for="numeroIdentificacion" value="{{ __('Numero de Identificacion*') }}" />
                </div>
                <div class="relative group">
                    <x-input id="numeroIdentificacion" class="block mt-1 w-full focus:ring focus:ring-indigo-300"
                        type="number" min="10" max="999999999999" name="numeroIdentificacion"
                        :value="old('numeroIdentificacion')" required autofocus autocomplete="numeroIdentificacion" />
                    <!-- Tooltip -->
                    <div class="absolute hidden group-hover:block group-focus:block bg-gray-800 text-white text-sm rounded-lg px-4 py-2 w-64 shadow-lg left-0 z-10"
                        style="top:-7.5rem">
                        Introduce tu número de identificación. Este campo es obligatorio y debe contener numeros.
                    </div>
                </div>
                @error('numeroIdentificacion')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div x-data="locationForm()" class="p-4 bg-gray-100 mt-4"> <x-label
                    value="{{ __('Lugar de expedición del documento') }}" class="block text-center" />
                <!-- Select País -->
                <div class="mb-4 relative"> <label for="country"
                        class="block text-sm font-medium text-gray-700">País*</label>
                    <div class="relative group">
                        <select name="country" id="country"
                            class="block mt-1 w-full focus:ring focus:ring-indigo-300" x-model="selectedCountry"
                            @change="loadDepartments()">
                            <option value="" selected>Selecciona un país</option>
                            <template x-for="pais in countries" :key="pais.id">
                                <option :value="pais.id" x-text="pais.nombre"></option>
                            </template>
                        </select>
                        <!-- Tooltip -->
                        <div class="absolute hidden group-hover:block group-focus:block bg-gray-800 text-white text-sm rounded-lg px-4 py-2 w-64 shadow-lg left-0 z-10"
                            style="top:-6rem">
                            Selecciona el país al que perteneces. Este campo es obligatorio.
                        </div>
                    </div>
                    @error('country')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                    @error('city')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                    @error('department')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Select Departamento -->
                <div class="mb-4 relative" x-show="selectedCountry === '1' && departments.length > 0">
                    <label for="department" class="block text-sm font-medium text-gray-700">Departamento*</label>
                    <div class="relative group">
                        <select name="department" id="department"
                            class="block mt-1 w-full focus:ring focus:ring-indigo-300" x-model="selectedDepartment"
                            @change="loadCities()">
                            <option value="" selected>Selecciona un departamento</option>
                            <template x-for="departamento in departments" :key="departamento.id">
                                <option :value="departamento.id" x-text="departamento.nombre"></option>
                            </template>
                        </select>
                        <!-- Tooltip -->
                        <div class="absolute hidden group-hover:block group-focus:block bg-gray-800 text-white text-sm rounded-lg px-4 py-2 w-64 shadow-lg left-0 z-10"
                            style="top:-9rem">
                            Selecciona el departamento o estado correspondiente a tu ubicación. Este campo es
                            obligatorio si has seleccionado un país.
                        </div>
                    </div>
                </div>

                <!-- Select Ciudad -->
                <div class="mb-4 relative" x-show="selectedCountry === '1' && cities.length > 0">
                    <label for="city" class="block text-sm font-medium text-gray-700">Ciudad*</label>
                    <div class="relative group">
                        <select name="city" id="city"
                            class="block mt-1 w-full focus:ring focus:ring-indigo-300" x-model="selectedCity">
                            <option value="" selected>Selecciona una ciudad</option>
                            <template x-for="ciudad in cities" :key="ciudad.id">
                                <option :value="ciudad.id" x-text="ciudad.nombre"></option>
                            </template>
                        </select>
                        <!-- Tooltip -->
                        <div class="absolute hidden group-hover:block group-focus:block bg-gray-800 text-white text-sm rounded-lg px-4 py-2 w-64 shadow-lg left-0 z-10"
                            style="top:-8rem">
                            Selecciona la ciudad correspondiente a tu ubicación. Este campo es obligatorio si has
                            seleccionado un departamento.
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function locationForm() {
                    const departamentos = Array.isArray(@json($departamentos)) ? @json($departamentos) : [];
                    const ciudades = Array.isArray(@json($ciudades)) ? @json($ciudades) : [];
                    const countries = Array.isArray(@json($paises)) ? @json($paises) : [];
                    return {
                        countries: countries,
                        allDepartments: departamentos,
                        allCities: ciudades,
                        selectedCountry: '',
                        selectedDepartment: '',
                        selectedCity: '',
                        departments: [],
                        cities: [],
                        loadDepartments() {
                            if (this.selectedCountry === '1') { // ID del país Colombia
                                this.departments = this.allDepartments.filter(dep => dep.pais_id == this.selectedCountry);
                            } else {
                                this.departments = [];
                                this.cities = [];
                            }
                            this.selectedDepartment = '';
                            this.selectedCity = '';
                        },
                        loadCities() {
                            this.cities = this.allCities.filter(city => city.departamento_id == this.selectedDepartment);
                            this.selectedCity = '';
                        }
                    };
                }
            </script>

            {{-- id_nivelEstudio de la tabla nestudios --}}
            <div class="relative mt-4">
                <div class="flex items-center">
                    <x-label for="id_nivelEstudio" value="{{ __('Nivel de Estudio*') }}" />
                </div>
                <div class="relative group">
                    <select name="id_nivelEstudio" id="id_nivelEstudio"
                        class="block mt-1 w-full focus:ring focus:ring-indigo-300" required>
                        <option value="" disabled {{ old('id_nivelEstudio') == '' ? 'selected' : '' }}>
                            Selecciona un nivel de estudio
                        </option>
                        @foreach ($nestudios as $nestudio)
                            <option value="{{ $nestudio->id }}"
                                {{ old('id_nivelEstudio') == $nestudio->id ? 'selected' : '' }}>
                                {{ $nestudio->nivelEstudio }}
                            </option>
                        @endforeach
                    </select>
                    <!-- Tooltip -->
                    <div class="absolute hidden group-hover:block group-focus:block bg-gray-800 text-white text-sm rounded-lg px-4 py-2 w-64 shadow-lg left-0 z-10"
                        style="top:-6rem">
                        Selecciona el nivel de estudios más alto que hayas completado. Este campo es obligatorio.
                    </div>
                </div>
                @error('id_nivelEstudio')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

            </div>
            {{-- id_genero de la tabla generos --}}
            <div class="relative mt-4">
                <div class="flex items-center">
                    <x-label for="id_genero" value="{{ __('Género*') }}" />
                </div>
                <div class="relative group">
                    <select name="id_genero" id="id_genero"
                        class="block mt-1 w-full focus:ring focus:ring-indigo-300" required>
                        <option value="" disabled {{ old('id_genero') == '' ? 'selected' : '' }}>
                            Selecciona un género
                        </option>
                        @foreach ($generos as $genero)
                            <option value="{{ $genero->id }}"
                                {{ old('id_genero') == $genero->id ? 'selected' : '' }}>
                                {{ $genero->nombreGenero }}
                            </option>
                        @endforeach
                    </select>
                    <!-- Tooltip -->
                    <div class="absolute hidden group-hover:block group-focus:block bg-gray-800 text-white text-sm rounded-lg px-4 py-2 w-64 shadow-lg left-0 z-10"
                        style="top:-6rem">
                        Selecciona el género con el que te identificas. Este campo es obligatorio.
                    </div>
                </div>
                @error('id_genero')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            {{-- id_ocupacion de la tabla ocupacion --}}
            <div class="relative mt-4">
                <div class="flex items-center">
                    <x-label for="id_ocupacion" value="{{ __('Ocupación*') }}" />
                </div>
                <div class="relative group">
                    <select name="id_ocupacion" id="id_ocupacion"
                        class="block mt-1 w-full border border-gray-300 rounded-lg focus:ring focus:ring-indigo-300 select2"
                        required>
                        <option value="" disabled {{ old('id_ocupacion') == '' ? 'selected' : '' }}>
                            Selecciona una ocupación
                        </option>
                        @foreach ($ocupaciones as $ocupacion)
                            <option value="{{ $ocupacion->id }}"
                                {{ old('id_ocupacion') == $ocupacion->id ? 'selected' : '' }}>
                                {{ $ocupacion->nombreOcupacion }}
                            </option>
                        @endforeach
                    </select>
                    <!-- Tooltip -->
                    <div class="absolute hidden group-hover:block group-focus:block bg-gray-800 text-white text-sm rounded-lg px-4 py-2 w-64 shadow-lg left-0 z-10"
                        style="top:-6rem">
                        Selecciona tu ocupación actual o la más cercana a tu profesión. Este campo es obligatorio.
                    </div>
                </div>
                @error('id_ocupacion')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

            <script>
                $(document).ready(function() {
                    $('.select2').select2();
                });
            </script>

            {{-- id_poblacion de la tabla poblacion --}}

            <div class="relative mt-4">
                <div class="flex items-center">
                    <x-label for="id_poblacion" value="{{ __('Población*') }}" />
                </div>
                <div class="relative group">
                    <select name="id_poblacion" id="id_poblacion"
                        class="block mt-1 w-full focus:ring focus:ring-indigo-300" required>
                        <option value="" disabled {{ old('id_poblacion') == '' ? 'selected' : '' }}>
                            Selecciona una población
                        </option>
                        @foreach ($poblaciones as $poblacion)
                            <option value="{{ $poblacion->id }}"
                                {{ old('id_poblacion') == $poblacion->id ? 'selected' : '' }}>
                                {{ $poblacion->nombrePoblacion }}
                            </option>
                        @endforeach
                    </select>
                    <!-- Tooltip -->
                    <div class="absolute hidden group-hover:block group-focus:block bg-gray-800 text-white text-sm rounded-lg px-4 py-2 w-64 shadow-lg left-0 z-10"
                        style="top:-7rem">
                        Selecciona la población a la que perteneces o con la que te identificas. Este campo es
                        obligatorio.
                    </div>
                </div>
                @error('id_poblacion')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>



            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />
                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Terms of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Privacy Policy') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-green-custom hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('Ya estas registrado?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Registrar') }}
                </x-button>
            </div>
        </form>

    </x-authentication-card>
</x-guest-layout>
