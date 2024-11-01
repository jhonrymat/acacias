<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <a href="{{ route('login') }}">
            <x-authentication-card-logo />
        </a>
        </x-slot>

        <x-validation-errors class="mb-4" />
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="relative">
                <div class="flex items-center">
                    <x-label for="name" value="Primer Nombre" />

                    <!-- Ícono de pregunta -->
                    <div class="ml-1 tooltip" x-data="{ open: false }">
                        <a href="#" class="hover:text-gray-400" @mouseenter="open = true" @mouseleave="open = false">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                        </a>
                        <div x-show="open" class="absolute left-5 top-0 z-10 w-48 p-2 mt-2 text-sm text-gray-700 bg-white border border-gray-300 rounded shadow-lg"
                             x-transition.opacity
                             @mouseenter="open = true" @mouseleave="open = false">
                            Ingresa tu primer nombre.
                        </div>
                    </div>
                </div>
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                        autofocus autocomplete="name" />
            </div>
            {{-- nombre_2 --}}
            <div class="relative">
                <div class="flex items-center">
                <x-label for="nombre_2" value="Segundo Nombre" />

                    <!-- Ícono de pregunta -->
                    <div class="ml-1 tooltip" x-data="{ open: false }">
                        <a href="#" class="hover:text-gray-400" @mouseenter="open = true" @mouseleave="open = false">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                        </a>
                        <div x-show="open" class="absolute left-5 top-0 z-10 w-48 p-2 mt-2 text-sm text-gray-700 bg-white border border-gray-300 rounded shadow-lg"
                             x-transition.opacity
                             @mouseenter="open = true" @mouseleave="open = false">
                            Ingresa tu Segundo nombre.
                        </div>
                    </div>
                </div>
                <x-input id="nombre_2" class="block mt-1 w-full" type="text" name="nombre_2" :value="old('nombre_2')"
                    required autofocus autocomplete="nombre_2" />
            </div>
            {{-- apellido_1 --}}
            <div class="relative">
                <div class="flex items-center">
                <x-label for="apellido_1" value="Primer Apellido" />

                    <!-- Ícono de pregunta -->
                    <div class="ml-1 tooltip" x-data="{ open: false }">
                        <a href="#" class="hover:text-gray-400" @mouseenter="open = true" @mouseleave="open = false">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                        </a>
                        <div x-show="open" class="absolute left-5 top-0 z-10 w-48 p-2 mt-2 text-sm text-gray-700 bg-white border border-gray-300 rounded shadow-lg"
                             x-transition.opacity
                             @mouseenter="open = true" @mouseleave="open = false">
                            Ingresa tu primer apellido.
                        </div>
                    </div>
                </div>
                <x-input id="apellido_1" class="block mt-1 w-full" type="text" name="apellido_1" :value="old('apellido_1')"
                    required autofocus autocomplete="apellido_1" />
            </div>
            {{-- apellido_2 --}}
            <div class="relative">
                <div class="flex items-center">
                <x-label for="apellido_2" value="Segundo Apellido" />

                    <!-- Ícono de pregunta -->
                    <div class="ml-1 tooltip" x-data="{ open: false }">
                        <a href="#" class="hover:text-gray-400" @mouseenter="open = true" @mouseleave="open = false">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                        </a>
                        <div x-show="open" class="absolute left-5 top-0 z-10 w-48 p-2 mt-2 text-sm text-gray-700 bg-white border border-gray-300 rounded shadow-lg"
                             x-transition.opacity
                             @mouseenter="open = true" @mouseleave="open = false">
                            Ingresa tu segundo apellido.
                        </div>
                    </div>
                </div>
                <x-input id="apellido_2" class="block mt-1 w-full" type="text" name="apellido_2" :value="old('apellido_2')"
                    required autofocus autocomplete="apellido_2" />
            </div>

            <div class="mt-4 relative">
                <div class="flex items-center">
                <x-label for="email" value="Correo Electrónico" />

                    <!-- Ícono de pregunta -->
                    <div class="ml-1 tooltip" x-data="{ open: false }">
                        <a href="#" class="hover:text-gray-400" @mouseenter="open = true" @mouseleave="open = false">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                        </a>
                        <div x-show="open" class="absolute left-5 top-0 z-10 w-48 p-2 mt-2 text-sm text-gray-700 bg-white border border-gray-300 rounded shadow-lg"
                             x-transition.opacity
                             @mouseenter="open = true" @mouseleave="open = false">
                            Ingresa tu correo electrónico.
                        </div>
                    </div>
                </div>
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
            </div>

            <div class="mt-4 relative">
                <div class="flex items-center">
                <x-label for="password" value="Contraseña" />

                <!-- Ícono de pregunta -->
                    <div class="ml-1 tooltip" x-data="{ open: false }">
                        <a href="#" class="hover:text-gray-400" @mouseenter="open = true" @mouseleave="open = false">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                        </a>
                        <div x-show="open" class="absolute left-5 top-0 z-10 w-48 p-2 mt-2 text-sm text-gray-700 bg-white border border-gray-300 rounded shadow-lg"
                             x-transition.opacity
                             @mouseenter="open = true" @mouseleave="open = false">
                            Ingresa una contraseña difícil.
                        </div>
                    </div>
                </div>
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <div class="mt-4 relative">
                <div class="flex items-center">
                <x-label for="password_confirmation" value="Confirme la contraseña" />

                <!-- Ícono de pregunta -->
                    <div class="ml-1 tooltip" x-data="{ open: false }">
                        <a href="#" class="hover:text-gray-400" @mouseenter="open = true" @mouseleave="open = false">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                        </a>
                        <div x-show="open" class="absolute left-5 top-0 z-10 w-48 p-2 mt-2 text-sm text-gray-700 bg-white border border-gray-300 rounded shadow-lg"
                             x-transition.opacity
                             @mouseenter="open = true" @mouseleave="open = false">
                            Confirma tu contraseña.
                        </div>
                    </div>
                </div>
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
            </div>

            {{-- telefonoContacto --}}
            <div class="relative">
                <div class="flex items-center">
                <x-label for="telefonoContacto" value="{{ __('Telefono de Contacto') }}" />

                <!-- Ícono de pregunta -->
                    <div class="ml-1 tooltip" x-data="{ open: false }">
                        <a href="#" class="hover:text-gray-400" @mouseenter="open = true" @mouseleave="open = false">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                        </a>
                        <div x-show="open" class="absolute left-5 top-0 z-10 w-48 p-2 mt-2 text-sm text-gray-700 bg-white border border-gray-300 rounded shadow-lg"
                             x-transition.opacity
                             @mouseenter="open = true" @mouseleave="open = false">
                            Ingresa tu número de teléfono.
                        </div>
                    </div>
                </div>
                <x-input id="telefonoContacto" class="block mt-1 w-full" type="text" name="telefonoContacto"
                    :value="old('telefonoContacto')" required autofocus autocomplete="telefonoContacto" />
            </div>
            {{-- fechaNacimiento --}}
            <div class="relative">
                <div class="flex items-center">
                <x-label for="fechaNacimiento" value="{{ __('Fecha de Nacimiento') }}" />

                <!-- Ícono de pregunta -->
                    <div class="ml-1 tooltip" x-data="{ open: false }">
                        <a href="#" class="hover:text-gray-400" @mouseenter="open = true" @mouseleave="open = false">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                        </a>
                        <div x-show="open" class="absolute left-5 top-0 z-10 w-48 p-2 mt-2 text-sm text-gray-700 bg-white border border-gray-300 rounded shadow-lg"
                             x-transition.opacity
                             @mouseenter="open = true" @mouseleave="open = false">
                            Ingresas tu fecha de nacimiento.
                        </div>
                    </div>
                </div>
                <x-input id="fechaNacimiento" class="block mt-1 w-full" type="date" name="fechaNacimiento"
                    :value="old('fechaNacimiento')" required autofocus autocomplete="fechaNacimiento" />
            </div>

            {{-- id_tipoSolicitante select de la tabla tsolicitantes --}}
            <div class="relative">
                <div class="flex items-center">
                <x-label for="id_tipoSolicitante" value="{{ __('Tipo de Solicitante') }}" />

                <!-- Ícono de pregunta -->
                    <div class="ml-1 tooltip" x-data="{ open: false }">
                        <a href="#" class="hover:text-gray-400" @mouseenter="open = true" @mouseleave="open = false">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                        </a>
                        <div x-show="open" class="absolute left-5 top-0 z-10 w-48 p-2 mt-2 text-sm text-gray-700 bg-white border border-gray-300 rounded shadow-lg"
                             x-transition.opacity
                             @mouseenter="open = true" @mouseleave="open = false">
                            Selecciona un tipo de solicitante.
                        </div>
                    </div>
                </div>
                <select name="id_tipoSolicitante" id="id_tipoSolicitante" class="block mt-1 w-full" required>
                    <option value="" selected>Selecciona un tipo de solicitante</option>
                    @foreach ($tsolicitantes as $tsolicitante)
                        <option value="{{ $tsolicitante->id }}">{{ $tsolicitante->tipoSolicitante }}</option>
                    @endforeach
                </select>
            </div>

            {{-- id_tipoDocumento select de la tabla tdocumentos --}}
            <div class="relative">
                <div class="flex items-center">
                <x-label for="id_tipoDocumento" value="{{ __('Tipo de Documento') }}" />

                <!-- Ícono de pregunta -->
                    <div class="ml-1 tooltip" x-data="{ open: false }">
                        <a href="#" class="hover:text-gray-400" @mouseenter="open = true" @mouseleave="open = false">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                        </a>
                        <div x-show="open" class="absolute left-5 top-0 z-10 w-48 p-2 mt-2 text-sm text-gray-700 bg-white border border-gray-300 rounded shadow-lg"
                             x-transition.opacity
                             @mouseenter="open = true" @mouseleave="open = false">
                            Selecciona un tipo de documento.
                        </div>
                    </div>
                </div>
                <select name="id_tipoDocumento" id="id_tipoDocumento" class="block mt-1 w-full" required>
                    <option value="" selected>Selecciona un tipo de documento</option>
                    @foreach ($tdocumentos as $tdocumento)
                        <option value="{{ $tdocumento->id }}">{{ $tdocumento->tipoDocumento }}</option>
                    @endforeach
                </select>
            </div>
            {{-- numeroIdentificacion --}}
            <div class="relative">
                <div class="flex items-center">
                <x-label for="numeroIdentificacion" value="{{ __('Numero de Identificacion') }}" />

                <!-- Ícono de pregunta -->
                    <div class="ml-1 tooltip" x-data="{ open: false }">
                        <a href="#" class="hover:text-gray-400" @mouseenter="open = true" @mouseleave="open = false">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                        </a>
                        <div x-show="open" class="absolute left-5 top-0 z-10 w-48 p-2 mt-2 text-sm text-gray-700 bg-white border border-gray-300 rounded shadow-lg"
                             x-transition.opacity
                             @mouseenter="open = true" @mouseleave="open = false">
                            Ingresar tu número de identificación.
                        </div>
                    </div>
                </div>
                <x-input id="numeroIdentificacion" class="block mt-1 w-full" type="text" name="numeroIdentificacion"
                    :value="old('numeroIdentificacion')" required autofocus autocomplete="numeroIdentificacion" />
            </div>

            <div x-data="geoData()" class="p-4 bg-gray-100">
                <x-label value="{{ __('Ciudad de Expedicion') }}" class="block text-center" />

                <div class="mb-4 relative">
                <div class="flex items-center">
                    <label for="country" class="block text-sm font-medium text-gray-700">País</label>

                <!-- Ícono de pregunta -->
                    <div class="ml-1 tooltip" x-data="{ open: false }">
                        <a href="#" class="hover:text-gray-400" @mouseenter="open = true" @mouseleave="open = false">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                        </a>
                        <div x-show="open" class="absolute left-5 top-0 z-10 w-48 p-2 mt-2 text-sm text-gray-700 bg-white border border-gray-300 rounded shadow-lg"
                             x-transition.opacity
                             @mouseenter="open = true" @mouseleave="open = false">
                            Selecciona un país.
                        </div>
                    </div>
                </div>
                    <select id="country" name="country" x-model="selectedCountry" @change="fetchDepartments"
                        class="mt-1 block w-full p-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Seleccione un país</option>
                        <template x-for="country in countries" :key="country.geonameId">
                            <option :value="country.countryName" x-text="country.countryName"></option>
                        </template>
                    </select>
                </div>

                <div class="mb-4 relative" x-show="departments.length > 0">
                <div class="flex items-center">
                    <label for="department" class="block text-sm font-medium text-gray-700">Departamento</label>

                <!-- Ícono de pregunta -->
                    <div class="ml-1 tooltip" x-data="{ open: false }">
                        <a href="#" class="hover:text-gray-400" @mouseenter="open = true" @mouseleave="open = false">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                        </a>
                        <div x-show="open" class="absolute left-5 top-0 z-10 w-48 p-2 mt-2 text-sm text-gray-700 bg-white border border-gray-300 rounded shadow-lg"
                             x-transition.opacity
                             @mouseenter="open = true" @mouseleave="open = false">
                            Selecciona un departamento.
                        </div>
                    </div>
                </div>
                    <select id="department" name="department" x-model="selectedDepartment" @change="fetchCities"
                        class="mt-1 block w-full p-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Seleccione un departamento</option>
                        <template x-for="department in departments" :key="department.geonameId">
                            <option :value="department.name" x-text="department.name"></option>
                        </template>
                    </select>
                </div>

                <div class="mb-4 relative"  x-show="cities.length > 0">
                <div class="flex items-center">
                    <label for="city" class="block text-sm font-medium text-gray-700">Ciudad</label>

                <!-- Ícono de pregunta -->
                    <div class="ml-1 tooltip" x-data="{ open: false }">
                        <a href="#" class="hover:text-gray-400" @mouseenter="open = true" @mouseleave="open = false">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                        </a>
                        <div x-show="open" class="absolute left-5 top-0 z-10 w-48 p-2 mt-2 text-sm text-gray-700 bg-white border border-gray-300 rounded shadow-lg"
                             x-transition.opacity
                             @mouseenter="open = true" @mouseleave="open = false">
                            Selecciona una ciudad.
                        </div>
                    </div>
                </div>
                    <select id="city" name="city" x-model="selectedCity"
                        class="mt-1 block w-full p-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Seleccione una ciudad</option>
                        <template x-for="city in cities" :key="city.geonameId">
                            <option :value="city.name" x-text="city.name"></option>
                        </template>
                    </select>
                </div>
            </div>


            {{-- id_nivelEstudio de la tabla nestudios --}}
            <div class="relative">
                <div class="flex items-center">
                <x-label for="id_nivelEstudio" value="{{ __('Nivel de Estudio') }}" />
                <!-- Ícono de pregunta -->
                    <div class="ml-1 tooltip" x-data="{ open: false }">
                        <a href="#" class="hover:text-gray-400" @mouseenter="open = true" @mouseleave="open = false">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                        </a>
                        <div x-show="open" class="absolute left-5 top-0 z-10 w-48 p-2 mt-2 text-sm text-gray-700 bg-white border border-gray-300 rounded shadow-lg"
                             x-transition.opacity
                             @mouseenter="open = true" @mouseleave="open = false">
                            Seleccione un nivel de estudio.
                        </div>
                    </div>
                </div>
                <select name="id_nivelEstudio" id="id_nivelEstudio" class="block mt-1 w-full" required>
                    <option value="" selected>Selecciona un nivel de estudio</option>
                    @foreach ($nestudios as $nestudio)
                        <option value="{{ $nestudio->id }}">{{ $nestudio->nivelEstudio }}</option>
                    @endforeach
                </select>
            </div>
            {{-- id_genero de la tabla generos --}}
            <div class="relative">
                <div class="flex items-center">
                <x-label for="id_genero" value="{{ __('Género') }}" />
                <!-- Ícono de pregunta -->
                    <div class="ml-1 tooltip" x-data="{ open: false }">
                        <a href="#" class="hover:text-gray-400" @mouseenter="open = true" @mouseleave="open = false">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                        </a>
                        <div x-show="open" class="absolute left-5 top-0 z-10 w-48 p-2 mt-2 text-sm text-gray-700 bg-white border border-gray-300 rounded shadow-lg"
                             x-transition.opacity
                             @mouseenter="open = true" @mouseleave="open = false">
                            Seleccione su género.
                        </div>
                    </div>
                </div>
                <select name="id_genero" id="id_genero" class="block mt-1 w-full" required>
                    <option value="" selected>Selecciona un genero</option>
                    @foreach ($generos as $genero)
                        <option value="{{ $genero->id }}">{{ $genero->nombreGenero }}</option>
                    @endforeach
                </select>
            </div>
            {{-- id_ocupacion de la tabla ocupacion --}}
            <div class="relative">
                <div class="flex items-center">
                <x-label for="id_ocupacion" value="{{ __('Ocupación') }}" />
                <!-- Ícono de pregunta -->
                    <div class="ml-1 tooltip" x-data="{ open: false }">
                        <a href="#" class="hover:text-gray-400" @mouseenter="open = true" @mouseleave="open = false">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                        </a>
                        <div x-show="open" class="absolute left-5 top-0 z-10 w-48 p-2 mt-2 text-sm text-gray-700 bg-white border border-gray-300 rounded shadow-lg"
                             x-transition.opacity
                             @mouseenter="open = true" @mouseleave="open = false">
                            Seleccione una ocupación.
                        </div>
                    </div>
                </div>
                <select name="id_ocupacion" id="id_ocupacion" class="block mt-1 w-full" required>
                    <option value="" selected>Selecciona una ocupacion</option>
                    @foreach ($ocupaciones as $ocupacion)
                        <option value="{{ $ocupacion->id }}">{{ $ocupacion->nombreOcupacion }}</option>
                    @endforeach
                </select>
            </div>
            {{-- id_poblacion de la tabla poblacion --}}

            <div class="relative">
                <div class="flex items-center">
                <x-label for="id_poblacion" value="{{ __('Población') }}" />
                <!-- Ícono de pregunta -->

                    <div class="ml-1 tooltip" x-data="{ open: false }">
                        <a href="#" class="hover:text-gray-400" @mouseenter="open = true" @mouseleave="open = false">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                        </a>
                        <div x-show="open" class="absolute left-5 top-0 z-10 w-48 p-2 mt-2 text-sm text-gray-700 bg-white border border-gray-300 rounded shadow-lg" x-transition.opacity @mouseenter="open = true" @mouseleave="open = false">
                            Seleccione una población.
                        </div>
                    </div>
                </div>

                <x-forms.select
                    wire:model="id_poblacion"
                    name="id_poblacion"
                    id="id_poblacion"
                    class="block mt-1 w-full"
                    required
                    :placeholder="'Buscar o seleccionar población'"
                    :options="$poblaciones->pluck('nombrePoblacion', 'id')->toArray()"
                />
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
        <script>
            function geoData() {
                return {
                    countries: [],
                    departments: [],
                    cities: [],
                    selectedCountry: null,
                    selectedDepartment: null,
                    selectedCity: null,

                    async init() {
                        const response = await fetch('https://secure.geonames.org/countryInfoJSON?username=andres293&lang=es');
                        const data = await response.json();
                        this.countries = data.geonames.sort((a, b) => a.countryName.localeCompare(b.countryName));
                    },

                    async fetchDepartments() {
                        const country = this.countries.find(c => c.countryName === this.selectedCountry);
                        if (!country) return;

                        const response = await fetch(
                            `https://secure.geonames.org/childrenJSON?geonameId=${country.geonameId}&username=andres293&lang=es`
                        );
                        const data = await response.json();
                        this.departments = data.geonames.sort((a, b) => a.name.localeCompare(b.name));
                        this.selectedDepartment = null;
                        this.cities = [];
                    },

                    async fetchCities() {
                        // Busca el objeto del departamento utilizando el nombre almacenado en selectedDepartment
                        const department = this.departments.find(d => d.name === this.selectedDepartment);
                        if (!department) return;

                        // Usa el geonameId del departamento para realizar la solicitud a la API
                        const response = await fetch(
                            `https://secure.geonames.org/childrenJSON?geonameId=${department.geonameId}&username=andres293&lang=es`
                        );
                        const data = await response.json();

                        // Ordena las ciudades alfabéticamente y resetea la selección de ciudad
                        this.cities = data.geonames.sort((a, b) => a.name.localeCompare(b.name));
                        this.selectedCity = null;
                    }

                }
            }
        </script>
    </x-authentication-card>
</x-guest-layout>
