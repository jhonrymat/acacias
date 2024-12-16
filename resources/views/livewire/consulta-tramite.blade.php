<div class="max-w-6xl mx-auto bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-end space-x-4 p-4 bg-white">
        <!-- Botón para consultar trámite -->
        <a href="{{ route('register') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition font-bold shadow-md w-full sm:w-auto text-center">
            Registrarse
        </a>
        <!-- Botón para registrarse -->
        <a href="{{ route('login') }}"
            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition font-bold shadow-md w-full sm:w-auto text-center">
            Iniciar Sesión
        </a>
    </div>

    <div>
        <a href="{{ route('login') }}">
            <img src="{{ asset('images/logo-web.png') }}" alt="Logo" class="max-md:mx-auto block mx-auto w-56 mt-2">
        </a>
    </div>
    <br>
    <h1 class="text-2xl font-bold text-gray-800 text-center mb-4">Consulta de Trámites</h1>
    <p class="text-center text-gray-600 mb-6">
        Ingresa tu número de identificación o número de solicitud para consultar el estado de tu trámite.
    </p>

    <!-- Formulario -->
    <div x-data="{ tipoConsulta: '' }" class="space-y-4">
        <!-- Select para elegir el tipo de consulta -->
        <div>
            <div class="relative group">
                <!-- Select con Tooltip -->
                <label for="tipoConsulta" class="block text-gray-700">¿Cómo quieres consultar el estado de la
                    solicitud?</label>
                <select x-model="tipoConsulta" wire:model="tipoConsulta" id="tipoConsulta" required
                    class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-3 py-2 focus:ring focus:ring-indigo-300">
                    <option value="" selected disabled>Seleccione una opción</option>
                    <option value="numeroIdentificacion">Número de Identificación</option>
                    <option value="numeroSolicitud">Número de Solicitud</option>
                </select>

                <!-- Tooltip -->
                <div class="absolute hidden group-hover:block bg-gray-800 text-white text-sm rounded-lg px-4 py-2 w-64 shadow-lg left-0 z-10"
                    style="top: -5rem">
                    Seleccione una opción: "Número de Identificación" o "Número de Solicitud" para realizar la consulta.
                </div>
            </div>
            @error('tipoConsulta')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Input dinámico para ingresar el dato -->
        <div class="relative group">
            <label for="datoConsulta" class="block text-gray-700">Ingrese el respectivo número:</label>
            <input wire:model="datoConsulta" type="text" id="datoConsulta" required
                class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-3 py-2 focus:ring focus:ring-indigo-300"
                placeholder="Ingrese el dato para consultar">
            @error('datoConsulta')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            <!-- Tooltip dinámico -->
            <div
                class="absolute hidden group-hover:block bg-gray-800 text-white text-sm rounded-lg px-4 py-2 w-64 shadow-lg -top-12 left-0 z-10">
                <span
                    x-text="tipoConsulta === 'numeroIdentificacion'
                    ? 'Ingrese su número de identificación para consultar.'
                    : 'Ingrese el número de solicitud para consultar.'"></span>
            </div>
        </div>

        <!-- Botón de envío -->
        <div class="relative group">
            <!-- Botón con Tooltip -->
            <button wire:click="buscar"
                class="mt-4 w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition disabled:opacity-50">
                Consultar
            </button>

            <!-- Tooltip -->
            <div
                class="absolute hidden group-hover:block bg-gray-800 text-white text-sm rounded-lg px-4 py-2 w-64 shadow-lg -top-12 left-1/2 transform -translate-x-1/2 z-10">
                Haz clic aquí para consultar el estado de tu trámite.
            </div>
        </div>
    </div>


    <!-- Resultados -->
    <div class="mt-6">
        @if (session()->has('error'))
            <!-- Mensaje de Error -->
            <div class="flex items-center bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-red-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01M12 12v2m0-2v-2m0 0a9 9 0 11-6.36-3.64M3.27 3.27l17.46 17.46" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @elseif($resultados)
            <!-- Detalles del Trámite -->
            <div class="p-6 bg-white shadow-lg rounded-lg border border-gray-200">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 16l4-4-4-4m4 4H4m16 0a8 8 0 11-16 0 8 8 0 0116 0z" />
                    </svg>
                    Detalles del Trámite
                </h2>
                <div class="space-y-4">
                    <!-- Número de Trámite -->
                    <p class="text-gray-600 flex items-center">
                        <span class="font-semibold text-gray-800 w-48">Número de trámite:</span>
                        <span class="text-gray-700">{{ $resultados->id }}</span>
                    </p>

                    <!-- Documento -->
                    <p class="text-gray-600 flex items-center">
                        <span class="font-semibold text-gray-800 w-48">Documento:</span>
                        <span class="text-gray-700">{{ $resultados->numeroIdentificacionOculto }}</span>
                    </p>

                    <!-- Nombre Completo -->
                    <p class="text-gray-600 flex items-center">
                        <span class="font-semibold text-gray-800 w-48">Nombre:</span>
                        <span class="text-gray-700">
                            {{ $resultados->user->name }} {{ $resultados->user->nombre_2 }}
                            {{ $resultados->user->apellido_1 }} {{ $resultados->user->apellido_2 }}
                        </span>
                    </p>

                    <!-- Estado -->
                    <p class="text-gray-600 flex items-center">
                        <span class="font-semibold text-gray-800 w-48">Estado:</span>
                        <span class="px-3 py-1 rounded-lg text-sm font-medium text-white shadow"
                            style="background-color: {{ $resultados->estado->color }}; text-shadow: 1px 1px 2px black;">
                            {{ $resultados->estado->nombreEstado }}
                        </span>
                    </p>

                    <!-- Fecha de Creación -->
                    <p class="text-gray-600 flex items-center">
                        <span class="font-semibold text-gray-800 w-48">Fecha de Creación:</span>
                        <span class="text-gray-700">{{ $resultados->created_at->format('d/m/Y H:i:s') }}</span>
                    </p>

                    <!-- Última Actualización -->
                    <p class="text-gray-600 flex items-center">
                        <span class="font-semibold text-gray-800 w-48">Última Actualización:</span>
                        <span class="text-gray-700">{{ $resultados->updated_at->format('d/m/Y H:i:s') }}</span>
                    </p>
                </div>
            </div>
        @endif
    </div>

    <div class="mt-10 bg-gray-50 p-6 rounded-lg shadow-lg">
        <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Información sobre los estados:</h3>
        <ul class="space-y-3">
            <!-- Estados -->
            {{-- recorer estados con foreach --}}
            @foreach ($estados as $estado)
                <li class="flex items-center space-x-3">
                    <span class="inline-block w-4 h-4 rounded-full"
                        style="background-color: {{ $estado->color }};"></span>
                    <p class="text-gray-700">
                        <span
                            style="background-color: {{ $estado->color }}; color: white; padding: 4px 8px; text-align: center; border-radius: 5px; text-shadow: 1px 1px 2px black;">{{ $estado->nombreEstado }}:</span>
                        {{ $estado->descripcion }}
                    </p>
                </li>
            @endforeach
        </ul>
    </div>
</div>
