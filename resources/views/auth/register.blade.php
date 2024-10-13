<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="Primer nombre" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus autocomplete="name" />
            </div>
            {{-- nombre_2 --}}
            <div>
                <x-label for="nombre_2" value="Segundo nombre" />
                <x-input id="nombre_2" class="block mt-1 w-full" type="text" name="nombre_2" :value="old('nombre_2')"
                    required autofocus autocomplete="nombre_2" />
            </div>
            {{-- apellido_1 --}}
            <div>
                <x-label for="apellido_1" value="Primer apellido" />
                <x-input id="apellido_1" class="block mt-1 w-full" type="text" name="apellido_1" :value="old('apellido_1')"
                    required autofocus autocomplete="apellido_1" />
            </div>
            {{-- apellido_2 --}}
            <div>
                <x-label for="apellido_2" value="Según apellido" />
                <x-input id="apellido_2" class="block mt-1 w-full" type="text" name="apellido_2" :value="old('apellido_2')"
                    required autofocus autocomplete="apellido_2" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="Correo electrónico" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="Contraseña" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="Confirme la contraseña" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
            </div>

            {{-- telefonoContacto --}}
            <div>
                <x-label for="telefonoContacto" value="{{ __('Telefono de Contacto') }}" />
                <x-input id="telefonoContacto" class="block mt-1 w-full" type="text" name="telefonoContacto"
                    :value="old('telefonoContacto')" required autofocus autocomplete="telefonoContacto" />
            </div>
            {{-- fechaNacimiento --}}
            <div>
                <x-label for="fechaNacimiento" value="{{ __('Fecha de Nacimiento') }}" />
                <x-input id="fechaNacimiento" class="block mt-1 w-full" type="date" name="fechaNacimiento"
                    :value="old('fechaNacimiento')" required autofocus autocomplete="fechaNacimiento" />
            </div>
            {{-- id_tipoSolicitante select de la tabla tsolicitantes --}}
            <div>
                <x-label for="id_tipoSolicitante" value="{{ __('Tipo de Solicitante') }}" />
                <select name="id_tipoSolicitante" id="id_tipoSolicitante" class="block mt-1 w-full" required>
                    <option value="" selected>Selecciona un tipo de solicitante</option>
                    @foreach ($tsolicitantes as $tsolicitante)
                        <option value="{{ $tsolicitante->id }}">{{ $tsolicitante->tipoSolicitante }}</option>
                    @endforeach
                </select>
            </div>
            {{-- id_tipoDocumento select de la tabla tdocumentos --}}
            <div>
                <x-label for="id_tipoDocumento" value="{{ __('Tipo de Documento') }}" />
                <select name="id_tipoDocumento" id="id_tipoDocumento" class="block mt-1 w-full" required>
                    <option value="" selected>Selecciona un tipo de documento</option>
                    @foreach ($tdocumentos as $tdocumento)
                        <option value="{{ $tdocumento->id }}">{{ $tdocumento->tipoDocumento }}</option>
                    @endforeach
                </select>
            </div>
            {{-- numeroIdentificacion --}}
            <div>
                <x-label for="numeroIdentificacion" value="{{ __('Numero de Identificacion') }}" />
                <x-input id="numeroIdentificacion" class="block mt-1 w-full" type="text" name="numeroIdentificacion"
                    :value="old('numeroIdentificacion')" required autofocus autocomplete="numeroIdentificacion" />
            </div>

            <div x-data="geoData()" class="p-4 bg-gray-100">
                <x-label value="{{ __('Ciudad de Expedicion') }}" class="block text-center" />
                <div class="mb-4">
                    <label for="country" class="block text-sm font-medium text-gray-700">País</label>
                    <select id="country" name="country" x-model="selectedCountry" @change="fetchDepartments"
                        class="mt-1 block w-full p-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Seleccione un país</option>
                        <template x-for="country in countries" :key="country.geonameId">
                            <option :value="country.countryName" x-text="country.countryName"></option>
                        </template>
                    </select>
                </div>

                <div class="mb-4" x-show="departments.length > 0">
                    <label for="department" class="block text-sm font-medium text-gray-700">Departamento</label>
                    <select id="department" name="department" x-model="selectedDepartment" @change="fetchCities"
                        class="mt-1 block w-full p-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Seleccione un departamento</option>
                        <template x-for="department in departments" :key="department.geonameId">
                            <option :value="department.name" x-text="department.name"></option>
                        </template>
                    </select>
                </div>

                <div x-show="cities.length > 0">
                    <label for="city" class="block text-sm font-medium text-gray-700">Ciudad</label>
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
            <div>
                <x-label for="id_nivelEstudio" value="{{ __('Nivel de Estudio') }}" />
                <select name="id_nivelEstudio" id="id_nivelEstudio" class="block mt-1 w-full" required>
                    <option value="" selected>Selecciona un nivel de estudio</option>
                    @foreach ($nestudios as $nestudio)
                        <option value="{{ $nestudio->id }}">{{ $nestudio->nivelEstudio }}</option>
                    @endforeach
                </select>
            </div>
            {{-- id_genero de la tabla generos --}}
            <div>
                <x-label for="id_genero" value="{{ __('Genero') }}" />
                <select name="id_genero" id="id_genero" class="block mt-1 w-full" required>
                    <option value="" selected>Selecciona un genero</option>
                    @foreach ($generos as $genero)
                        <option value="{{ $genero->id }}">{{ $genero->nombreGenero }}</option>
                    @endforeach
                </select>
            </div>
            {{-- id_ocupacion de la tabla ocupacion --}}
            <div>
                <x-label for="id_ocupacion" value="{{ __('Ocupacion') }}" />
                <select name="id_ocupacion" id="id_ocupacion" class="block mt-1 w-full" required>
                    <option value="" selected>Selecciona una ocupacion</option>
                    @foreach ($ocupaciones as $ocupacion)
                        <option value="{{ $ocupacion->id }}">{{ $ocupacion->nombreOcupacion }}</option>
                    @endforeach
                </select>
            </div>
            {{-- id_poblacion de la tabla poblacion --}}
            <div>
                <x-label for="id_poblacion" value="{{ __('Poblacion') }}" />
                <select name="id_poblacion" id="id_poblacion" class="block mt-1 w-full" required>
                    <option value="" selected>Selecciona una poblacion</option>
                    @foreach ($poblaciones as $poblacion)
                        <option value="{{ $poblacion->id }}">{{ $poblacion->nombrePoblacion }}</option>
                    @endforeach
                </select>
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
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
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
                        const response = await fetch('http://api.geonames.org/countryInfoJSON?username=andres293&lang=es');
                        const data = await response.json();
                        this.countries = data.geonames.sort((a, b) => a.countryName.localeCompare(b.countryName));
                    },

                    async fetchDepartments() {
                        const country = this.countries.find(c => c.countryName === this.selectedCountry);
                        if (!country) return;

                        const response = await fetch(
                            `http://api.geonames.org/childrenJSON?geonameId=${country.geonameId}&username=andres293&lang=es`
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
                            `http://api.geonames.org/childrenJSON?geonameId=${department.geonameId}&username=andres293&lang=es`
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
