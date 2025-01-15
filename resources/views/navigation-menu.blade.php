<nav x-data="{ open: false }" class="bg-white border-b-2 border-yellow-custom">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex ">
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Inicio') }}
                    </x-nav-link>
                </div>
                @role('admin')
                    <div class="hidden sm:flex sm:items-center sm:ml-6 mx-auto my-auto mr-6">
                        <x-dropdown width="48">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        config. formulario
                                        <svg class="ml-2 -mr-0.5 h-4 w-4 " xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>
                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Seleccionables') }}
                                </div>
                                <x-dropdown-link href="{{ route('documento') }}">
                                    {{ __('Documentos') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="{{ route('genero') }}">
                                    {{ __('Generos') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="{{ route('nestudio') }}">
                                    {{ __('Nivel de estudios') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="{{ route('tsolicitante') }}">
                                    {{ __('Tipo de solicitante') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="{{ route('barrio') }}">
                                    {{ __('Barrios') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="{{ route('ocupacion') }}">
                                    {{ __('Ocupacion') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="{{ route('poblacion') }}">
                                    {{ __('Poblacion') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>
                    <div class="hidden sm:flex sm:items-center sm:ml-6 mx-auto my-auto mr-6">
                        <x-dropdown width="48">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        Configuración
                                        <svg class="ml-2 -mr-0.5 h-4 w-4 " xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>
                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Datos') }}
                                </div>
                                <x-dropdown-link href="{{ route('roles') }}">
                                    {{ __('Permisos') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="{{ route('user-roles') }}">
                                    {{ __('Roles') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>
                    <x-nav-link class="hidden sm:flex mr-6" href="{{ route('ciudadanos') }}" :active="request()->routeIs('ciudadanos')">
                        {{ __('Ciudadanos') }}
                    </x-nav-link>
                    <x-nav-link class="hidden sm:flex mr-6" href="{{ route('validadores') }}" :active="request()->routeIs('validadores')">
                        {{ __('Validadores') }}

                    </x-nav-link>
                    <x-nav-link class="hidden sm:flex mr-6" href="{{ route('estadisticas1') }}" :active="request()->routeIs('estadisticas1')">
                        {{ __('Estadisticas') }}
                    </x-nav-link>
                @endrole
                @role('user')
                    <x-nav-link class="mx-6 hidden sm:flex" href="{{ route('formulario') }}" :active="request()->routeIs('formulario')">
                        {{ __('Solicitud') }}
                    </x-nav-link>
                    <x-nav-link class="hidden sm:flex mr-6" href="{{ route('versolicitudes') }}" :active="request()->routeIs('versolicitudes')">
                        {{ __('Solicitudes') }}
                    </x-nav-link>
                @endrole
                @hasanyrole('validador1|validador2')
                    <x-nav-link class="mx-6 hidden sm:flex" href="{{ route('solicitudes') }}" :active="request()->routeIs('solicitudes')">
                        {{ __('Solicitudes') }}
                    </x-nav-link>
                    <x-nav-link class="hidden sm:flex mr-6" href="{{ route('historial') }}" :active="request()->routeIs('historial')">
                        {{ __('Historial') }}
                    </x-nav-link>
                    <x-nav-link class="hidden sm:flex mr-6" href="{{ route('estadisticas1') }}" :active="request()->routeIs('estadisticas1')">
                        {{ __('Estadisticas') }}
                    </x-nav-link>
                @endrole
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ms-3 relative">
                        <x-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->currentTeam->name }}

                                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-dropdown-link>
                                    @endcan

                                    <!-- Team Switcher -->
                                    @if (Auth::user()->allTeams()->count() > 1)
                                        <div class="border-t border-gray-200"></div>

                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Switch Teams') }}
                                        </div>

                                        @foreach (Auth::user()->allTeams() as $team)
                                            <x-switchable-team :team="$team" />
                                        @endforeach
                                    @endif
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endif

                <!-- Settings Dropdown -->
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover"
                                        src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->name }}

                                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-gray-200"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Inicio') }}
            </x-responsive-nav-link>
        </div>

        @role('user')
            <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link href="{{ route('formulario') }}" :active="request()->routeIs('formulario')">
                        {{ __('Solicitud') }}
                    </x-responsive-nav-link>
                </div>

                <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <x-responsive-nav-link href="{{ route('versolicitudes') }}" :active="request()->routeIs('versolicitudes')">
                            {{ __('Solicitudes') }}
                        </x-responsive-nav-link>
                    </div>
                @endrole

                @role('admin')
                    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
                        <div class="pt-2 pb-3 space-y-1">

                            <!-- Enlace directo a "Historial" -->
                            <x-responsive-nav-link href="{{ route('historial') }}" :active="request()->routeIs('historial')">
                                {{ __('Historial') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link href="{{ route('ciudadanos') }}" :active="request()->routeIs('ciudadanos')">
                                {{ __('Ciudadanos') }}
                            </x-responsive-nav-link>

                            <x-responsive-nav-link href="{{ route('validadores') }}" :active="request()->routeIs('validadores')">
                                {{ __('Validadores') }}
                            </x-responsive-nav-link>

                            <x-responsive-nav-link href="{{ route('estadisticas1') }}" :active="request()->routeIs('estadisticas1')">
                                {{ __('Estadisticas') }}
                            </x-responsive-nav-link>


                            <!-- Botón desplegable para "Config. Formulario" -->
                            <div x-data="{ openConfigForm: false }">
                                <x-responsive-nav-link class="mb-1 flex items-center"
                                    @click="openConfigForm = !openConfigForm" :active="request()->routeIs('configForm.*')">
                                    <span>Config. Formulario</span>
                                    <svg :class="{ 'rotate-180': openConfigForm }" class="w-4 h-4 ml-1 transition-transform"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.23 7.21a.75.75 0 011.06 0L10 10.94l3.71-3.73a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 010-1.06z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </x-responsive-nav-link>

                                <!-- Subopciones de "Config. Formulario" -->
                                <div x-show="openConfigForm" class="space-y-1 pl-4">
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Seleccionables') }}
                                    </div>
                                    <x-responsive-nav-link href="{{ route('documento') }}" :active="request()->routeIs('documento')">
                                        Documentos
                                    </x-responsive-nav-link>
                                    <x-responsive-nav-link href="{{ route('genero') }}" :active="request()->routeIs('genero')">
                                        Generos
                                    </x-responsive-nav-link>
                                    <x-responsive-nav-link href="{{ route('nestudio') }}" :active="request()->routeIs('nestudio')">
                                        Nivel de estudios
                                    </x-responsive-nav-link>
                                    <x-responsive-nav-link href="{{ route('tsolicitante') }}" :active="request()->routeIs('tsolicitante')">
                                        Tipo de solicitante
                                    </x-responsive-nav-link>
                                    <x-responsive-nav-link href="{{ route('barrio') }}" :active="request()->routeIs('barrio')">
                                        Barrios
                                    </x-responsive-nav-link>
                                    <x-responsive-nav-link href="{{ route('ocupacion') }}" :active="request()->routeIs('ocupacion')">
                                        Ocupacion
                                    </x-responsive-nav-link>
                                    <x-responsive-nav-link href="{{ route('poblacion') }}" :active="request()->routeIs('poblacion')">
                                        Poblacion
                                    </x-responsive-nav-link>
                                </div>
                            </div>

                            <!-- Botón desplegable para "Configuracion" -->
                            <div x-data="{ openConfigForm: false }">
                                <x-responsive-nav-link class="mb-1 flex items-center"
                                    @click="openConfigForm = !openConfigForm" :active="request()->routeIs('configForm.*')">
                                    <span>Configuración</span>
                                    <svg :class="{ 'rotate-180': openConfigForm }" class="w-4 h-4 ml-1 transition-transform"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.23 7.21a.75.75 0 011.06 0L10 10.94l3.71-3.73a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 010-1.06z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </x-responsive-nav-link>

                                <!-- Subopciones de "Configuracion" -->
                                <div x-show="openConfigForm" class="space-y-1 pl-4">
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Datos') }}
                                    </div>
                                    <x-responsive-nav-link href="{{ route('roles') }}" :active="request()->routeIs('roles')">
                                        Permisos
                                    </x-responsive-nav-link>
                                    <x-responsive-nav-link href="{{ route('user-roles') }}" :active="request()->routeIs('user-roles')">
                                        Roles
                                    </x-responsive-nav-link>

                                </div>
                            </div>

                        </div>
                    </div>
                @endrole


                @hasanyrole('validador1|validador2')
                    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
                        <div class="pt-2 pb-3 space-y-1">
                            <x-responsive-nav-link href="{{ route('versolicitudes') }}" :active="request()->routeIs('versolicitudes')">
                                {{ __('Solicitudes') }}
                            </x-responsive-nav-link>
                        </div>
                        <div class="pt-2 pb-3 space-y-1">
                            <x-responsive-nav-link href="{{ route('historial') }}" :active="request()->routeIs('historial')">
                                {{ __('Historial') }}
                            </x-responsive-nav-link>
                        </div>
                        <x-responsive-nav-link href="{{ route('estadisticas1') }}" :active="request()->routeIs('estadisticas1')">
                            {{ __('Estadisticas') }}
                        </x-responsive-nav-link>
                        @endrole

                        <!-- Responsive Settings Options -->
                        <div class="pt-4 pb-1 border-t border-gray-200">
                            <div class="flex items-center px-4">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <div class="shrink-0 me-3">
                                        <img class="h-10 w-10 rounded-full object-cover"
                                            src="{{ Auth::user()->profile_photo_url }}"
                                            alt="{{ Auth::user()->name }}" />
                                    </div>
                                @endif

                                <div>
                                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                                </div>
                            </div>

                            <div class="mt-3 space-y-1">
                                <!-- Account Management -->
                                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                                    {{ __('Profile') }}
                                </x-responsive-nav-link>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                                        {{ __('API Tokens') }}
                                    </x-responsive-nav-link>
                                @endif

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-responsive-nav-link href="{{ route('logout') }}"
                                        @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-responsive-nav-link>
                                </form>

                                <!-- Team Management -->
                                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                    <div class="border-t border-gray-200"></div>

                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-responsive-nav-link
                                        href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                                        :active="request()->routeIs('teams.show')">
                                        {{ __('Team Settings') }}
                                    </x-responsive-nav-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                                            {{ __('Create New Team') }}
                                        </x-responsive-nav-link>
                                    @endcan

                                    <!-- Team Switcher -->
                                    @if (Auth::user()->allTeams()->count() > 1)
                                        <div class="border-t border-gray-200"></div>

                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Switch Teams') }}
                                        </div>

                                        @foreach (Auth::user()->allTeams() as $team)
                                            <x-switchable-team :team="$team" component="responsive-nav-link" />
                                        @endforeach
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
</nav>
