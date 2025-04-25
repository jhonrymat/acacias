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
    <!-- Título -->
    <div>
        <a href="{{ route('login') }}">
            @php
                $siteSetting = App\Models\SiteSetting::first();
                $logoPath = $siteSetting ? 'storage/' . $siteSetting->logo_path : 'images/logo-web.png';
            @endphp
            <img class="max-md:mx-auto block mx-auto w-56 mt-2" src="{{ asset($logoPath) }}" alt="Logo">
        </a>
    </div>
    <h1 class="text-3xl font-extrabold text-gray-800 text-center mb-6">
        Validación del Certificado de Avecindamiento
    </h1>

    <!-- Mensaje de Validación -->
    <div class="text-center">
        <p class="text-lg font-semibold text-gray-700">
            {{ $mensaje }}
        </p>
    </div>

    @if ($solicitud)
        <!-- Información de la Solicitud -->
        <div class="mt-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b pb-2">
                Detalles del Documento
            </h2>
            <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-700">
                            <span class="font-semibold">ID de Solicitud:</span> {{ $solicitud->id }}
                        </p>
                        <p class="text-gray-700">
                            <span class="font-semibold">Número de Identificación:</span>
                            {{ $solicitud->numeroIdentificacion }}
                        </p>
                        {{-- nombre completo --}}
                        <p class="text-gray-700">
                            <span class="font-semibold">Nombre Completo:</span>
                            {{ $solicitud->nombre_completo }}
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-600 flex items-center">
                            <span class="font-semibold text-gray-800 w-48">Estado:</span>
                            <span class="px-3 py-1 rounded-lg text-sm font-medium text-white shadow"
                                style="background-color: {{ $solicitud->estado->color }}; text-shadow: 1px 1px 2px black;">
                                {{ $solicitud->estado->nombreEstado }}
                            </span>
                        </p>
                        <p class="text-gray-700">
                            <span class="font-semibold">Fecha de Emisión:</span>
                            {{ $solicitud->fecha_emision_formateada }}
                        </p>
                        <p class="text-gray-700">
                            <span class="font-semibold">Fecha de vencimiento:</span>
                            {{ $solicitud->vigencia }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Información de los Estados -->
    <div class="mt-10 bg-gray-50 p-6 rounded-lg shadow-lg">
        <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Información sobre los estados:</h3>
        <ul class="space-y-3">
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

    <!-- Footer -->
    <footer class="mt-8 text-gray-600 text-sm text-center">
        © {{ date('Y') }} Acacias. Todos los derechos reservados.
    </footer>
</div>
