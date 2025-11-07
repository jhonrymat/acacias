{{-- Paso 2: Contenido condicional según autenticación --}}
<div>
    @guest
        <div class="container my-4">
            <p>Por favor inicie sesión para continuar con su solicitud.</p>
            {{-- de clic aqui para iniciar sesión --}}
            <a href="{{ route('certificado.auth.login') }}" class="btn btn-primary">Iniciar sesión</a>
        </div>
    @endguest

    @auth
        @include('components.xroad.logout')
        <div class="container my-4">
            {{-- Usuario autenticado: verificar si puede crear solicitud --}}
            {{-- Usuario autenticado: verificar si puede crear solicitud --}}
            @php
                $userId = auth()->id();
                $canCreateRequest = \App\Models\Solicitud::canCreateRequest($userId);

                // Obtener solicitud que está bloqueando (estados 1, 2, 4)
                $solicitudBloqueante = null;
                $solicitudEmitida = null;
                $mensajeBloqueo = '';

                if (!$canCreateRequest) {
                    // Buscar solicitud en estados bloqueantes
                    $solicitudBloqueante = \App\Models\Solicitud::where('user_id', $userId)
                        ->whereIn('estado_id', [1, 2, 4]) // Pendiente, En Revisión, Aprobada
                        ->latest()
                        ->first();

                    // Si no hay bloqueante, entonces es por la emitida (5) que aún no está en ventana
                    if (!$solicitudBloqueante) {
                        $solicitudEmitida = \App\Models\Solicitud::where('user_id', $userId)
                            ->where('estado_id', 5) // Emitida
                            ->latest('fecha_emision')
                            ->first();

                        if ($solicitudEmitida) {
                            $fechaEmision = \Carbon\Carbon::parse($solicitudEmitida->fecha_emision);
                            $fechaVencimiento = $fechaEmision->copy()->addMonths(6);
                            $ventanaDesde = $fechaVencimiento->copy()->subDays(15);
                            $diasRestantes = now()->diffInDays($ventanaDesde, false);

                            $mensajeBloqueo =
                                'Tu certificado actual vence el ' .
                                $fechaVencimiento->format('d/m/Y') .
                                '. Podrás solicitar uno nuevo a partir del ' .
                                $ventanaDesde->format('d/m/Y') .
                                ' (faltan ' .
                                abs($diasRestantes) .
                                ' días).';
                        }
                    }
                }
            @endphp
            @if (!$canCreateRequest)
                {{-- ⚠️ MENSAJE: No puede crear solicitud --}}
                @if ($solicitudBloqueante)
                    {{-- Caso 1: Tiene solicitud en proceso (1, 2, 4) - Alerta Negativa --}}
                    <div class="container-alerta-govco mb-4">
                        <div class="alert alerta-govco alerta-error-govco aerror" role="alert">
                            <span class="alerta-icon-govco alerta-icon-error-govco aerror"></span>
                            <p class="alerta-content-text">
                                <strong>Ya tienes una solicitud en proceso.</strong><br>
                                Actualmente tienes una solicitud activa (N° #{{ $solicitudBloqueante->id }})
                                en estado: <strong>{{ $solicitudBloqueante->estado->nombre ?? 'Pendiente' }}</strong>,
                                creada el {{ $solicitudBloqueante->created_at->format('d/m/Y') }}.
                                No puedes crear una nueva hasta que esta sea resuelta.
                                <a type="button" class="alert-link alerta-link aerror"
                                onclick="pasosPermitidos = [1,2,4]; irAlPaso(4);">Ver solicitudes</a>
                                <button type="button" class="btn-govco fill-btn-govco" style="width: 165px; height: 42px;"
                                    onclick="pasosPermitidos = [1,2,4]; irAlPaso(4);">Ver solicitudes</button>
                            </p>
                        </div>
                    </div>
                @elseif($solicitudEmitida)
                    {{-- Caso 2: Tiene certificado emitido pero aún no está en ventana - Alerta Informativa --}}
                    <div class="container-alerta-govco mb-4">
                        <div class="alert alerta-govco anotificacion" role="alert">
                            <span class="alerta-icon-govco alerta-icon-notificacion-govco anotificacion"></span>
                            <p class="alerta-content-text">
                                <strong>Tu certificado de residencia está vigente.</strong><br>
                                {{ $mensajeBloqueo }}
                                Tu certificado fue emitido el
                                {{ \Carbon\Carbon::parse($solicitudEmitida->fecha_emision)->format('d/m/Y') }}.
                                <a href="{{ route('versolicitudesresidencia') }}"
                                    class="alert-link alerta-link anotificacion">Ver mis certificados</a>
                            </p>
                        </div>
                    </div>
                @else
                    {{-- Caso genérico - Alerta Negativa --}}
                    <div class="container-alerta-govco mb-4">
                        <div class="alert alerta-govco alerta-error-govco aerror" role="alert">
                            <span class="alerta-icon-govco alerta-icon-error-govco aerror"></span>
                            <p class="alerta-content-text">
                                <strong>No puedes crear una nueva solicitud en este momento.</strong><br>
                                Por favor verifica el estado de tus solicitudes existentes.
                                <a href="{{ route('versolicitudesresidencia') }}" class="alert-link alerta-link aerror">Ver
                                    mis solicitudes</a>
                            </p>
                        </div>
                    </div>
                @endif
            @else
                <p class="text-muted mb-4 small">
                    Todos los campos marcados con el símbolo asterisco (<span aria-required="true">*</span>) son
                    obligatorios.
                </p>

                <form id="solicitudForm" action="{{ route('solicitud.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- Número de Documento -->
                        <div class="col-md-6">
                            <div class="entradas-de-texto-govco">
                                <label for="numero_documento" class="form-label">Número de Documento<span
                                        aria-required="true"></span></label>
                                <div class="container-input-texto-govco">
                                    <input type="text" id="numero_documento" name="numero_documento" class="form-control"
                                        value="{{ auth()->user()->documento ?? '17357997' }}" disabled>
                                    <span id="campo-nota-general" class="info-entradas-de-texto-govco">
                                        Este campo se completa automáticamente.
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Nombre del Contribuyente -->
                        <div class="col-md-6">
                            <div class="entradas-de-texto-govco">
                                <label for="nombre_contribuyente" class="form-label">Nombre del Contribuyente <span
                                        aria-required="true"></span></label>
                                <div class="container-input-texto-govco">
                                    <input type="text" id="nombre_contribuyente" name="nombre_contribuyente"
                                        class="form-control" value="{{ auth()->user()->name ?? 'PARRA GUEVARA FREDY' }}"
                                        disabled>
                                    <span id="campo-nota-general" class="info-entradas-de-texto-govco">
                                        Este campo se completa automáticamente.
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Teléfo -->
                        <div class="col-md-6">
                            <div class="entradas-de-texto-govco">
                                <label for="telefono" class="form-label">Telefono <span aria-required="true"></span></label>
                                <div class="container-input-texto-govco">
                                    <input type="text" id="telefono" name="telefono" class="form-control"
                                        value="{{ auth()->user()->telefonoContacto ?? '1234567890' }}" disabled>
                                    <span id="campo-nota-general" class="info-entradas-de-texto-govco">
                                        Este campo se completa automáticamente.
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Correo electrónico -->
                        <div class="col-md-6">
                            <div class="entradas-de-texto-govco">
                                <label for="email" class="form-label">E-Mail <span aria-required="true">*</span></label>
                                <div class="container-input-texto-govco">
                                    <input type="email" id="email" name="email" class="form-control"
                                        value="{{ auth()->user()->email ?? 'FREDYPARRAGUEVARA@GMAIL.COM' }}" disabled>
                                    <span id="campo-nota-general" class="info-entradas-de-texto-govco">
                                        Este campo se completa automáticamente.
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Departamento de residencia -->
                        <div class="col-md-6">
                            <div class="entradas-de-texto-govco">
                                <label for="departamento_residencia" class="form-label" style="color: #BABABA;">Departamento
                                    de
                                    Residencia <span aria-required="true"></span></label>
                                <div class="container-input-texto-govco">
                                    <select id="departamento_residencia" name="departamento_residencia" class="form-select"
                                        disabled>
                                        <option value="META" selected>META</option>
                                        <option value="CUNDINAMARCA">CUNDINAMARCA</option>
                                        <option value="ANTIOQUIA">ANTIOQUIA</option>
                                    </select>
                                    <span id="campo-nota-general" class="info-entradas-de-texto-govco"
                                        style="color: #BABABA;">
                                        Este campo se completa automáticamente.
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Municipio de residencia -->
                        <div class="col-md-6">
                            <div class="entradas-de-texto-govco">
                                <label for="municipio_residencia" class="form-label" style="color: #BABABA;">Municipio de
                                    Residencia
                                    <span aria-required="true"></span></label>
                                <div class="container-input-texto-govco">
                                    <select id="municipio_residencia" name="municipio_residencia" class="form-select"
                                        disabled>
                                        <option value="ACACIAS" selected>ACACÍAS</option>
                                        <option value="VILLAVICENCIO">VILLAVICENCIO</option>
                                        <option value="GRANADA">GRANADA</option>
                                    </select>
                                    <span id="campo-nota-general" class="info-entradas-de-texto-govco"
                                        style="color: #BABABA;">
                                        Este campo se completa automáticamente.
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Dirección -->
                        <div class="col-md-6">
                            <label for="direccion" class="form-label">Dirección*</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="direccion" id="direccion" readonly
                                    placeholder="Seleccione su dirección" required>
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                    data-bs-target="#modalDireccion">
                                    +
                                </button>
                            </div>
                            <span id="campo-nota" class="info-entradas-de-texto-govco">
                                No se puede escribir directamente la dirección. Para ingresarla, haz clic en el botón azul
                                con
                                el
                                signo (+) y completa la información desde allí.
                            </span>
                        </div>

                        <!-- Barrio o Vereda -->
                        <div class="col-md-6">
                            <label for="id_barrio" class="block text-sm font-medium form-label">Barrio o Vereda*</label>
                            <select name="id_barrio" id="id_barrio" class="form-select select2" required>
                                <option value="">Selecciona un barrio o vereda</option>
                                @foreach ($barrios as $barrio)
                                    <option value="{{ $barrio->id }}"
                                        {{ old('id_barrio') == $barrio->id ? 'selected' : '' }}>
                                        {{ $barrio->nombreBarrio }} - {{ $barrio->zona }} - {{ $barrio->tipoUnidad }}
                                        {{ $barrio->codigoNumero }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="alert-desplegable-govco" id="alert-barrio-id">
                                Selecciona el barrio o vereda correspondiente a tu ubicación
                            </span>
                        </div>

                        <!-- Fotocopia de la Cédula -->
                        <div class="col-md-6 mt-4">
                            <div class="container-carga-de-archivo-govco">
                                <div class="loader-carga-de-archivo-govco">
                                    <div class="all-input-carga-de-archivo-govco">
                                        <input type="file" name="cedula" id="fotocopia_cedula"
                                            class="input-carga-de-archivo-govco active" accept=".pdf,.jpg,.jpeg,.png"
                                            data-error="0" data-action="uploadFile" data-action-delete="deleteFile" />
                                        <label for="fotocopia_cedula" class="label-carga-de-archivo-govco">
                                            Subir Fotocopia de la Cédula
                                        </label>
                                        <label for="fotocopia_cedula" class="container-input-carga-de-archivo-govco">
                                            <span class="button-file-carga-de-archivo-govco">Seleccionar archivo</span>
                                            <span class="file-name-carga-de-archivo-govco">Ningún archivo
                                                seleccionado</span>
                                        </label>
                                        <span class="text-validation-carga-de-archivo-govco">
                                            Por favor adjunte una <b>FOTO NÍTIDA Y A COLOR</b>
                                            de su respectivo documento de identidad.<br>
                                            PDF, JPG (MAX. 10 MB)
                                        </span>
                                    </div>
                                    <div class="load-button-carga-de-archivo-govco">
                                        <div class="load-carga-de-archivo-govco">
                                            <div class="spinner-indicador-de-carga-govco"
                                                style="width:32px;height:32px;border-width:6px;" role="status">
                                                <span class="visually-hidden">Cargando...</span>
                                            </div>
                                        </div>
                                        <button class="button-loader-carga-de-archivo-govco" disabled>
                                            Cargar archivo
                                        </button>
                                    </div>
                                </div>
                                <div class="container-detail-carga-de-archivo-govco">
                                    <span class="alert-carga-de-archivo-govco visually-hidden"></span>
                                    <div class="attached-files-carga-de-archivo-govco"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Recibo de servicios públicos (sin label superior) -->
                        <div class="col-md-6 mt-4">
                            <div class="container-carga-de-archivo-govco">
                                <div class="loader-carga-de-archivo-govco">
                                    <div class="all-input-carga-de-archivo-govco">
                                        <input type="file" name="recibo" id="recibo_servicios"
                                            class="input-carga-de-archivo-govco active" accept=".pdf,.jpg,.jpeg,.png"
                                            data-error="0" data-action="uploadFile" data-action-delete="deleteFile" />
                                        <label for="fotocopia_cedula" class="label-carga-de-archivo-govco">
                                            Subir Recibo de servicios públicos
                                        </label>
                                        <label for="recibo_servicios" class="container-input-carga-de-archivo-govco">
                                            <span class="button-file-carga-de-archivo-govco">Seleccionar archivo</span>
                                            <span class="file-name-carga-de-archivo-govco">Ningún archivo
                                                seleccionado</span>
                                        </label>
                                        <span class="text-validation-carga-de-archivo-govco">
                                            Por favor adjunte una <b>FOTO NÍTIDA Y A COLOR</b>
                                            de su domicilio (únicamente agua, energía, gas o aseo).<br>
                                            PDF, JPG (MAX. 10 MB)
                                        </span>
                                    </div>
                                    <div class="load-button-carga-de-archivo-govco">
                                        <div class="load-carga-de-archivo-govco">
                                            <div class="spinner-indicador-de-carga-govco"
                                                style="width:32px;height:32px;border-width:6px;" role="status">
                                                <span class="visually-hidden">Cargando...</span>
                                            </div>
                                        </div>
                                        <button class="button-loader-carga-de-archivo-govco" disabled>
                                            Cargar archivo
                                        </button>
                                    </div>
                                </div>
                                <div class="container-detail-carga-de-archivo-govco">
                                    <span class="alert-carga-de-archivo-govco visually-hidden"></span>
                                    <div class="attached-files-carga-de-archivo-govco"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Mapa -->
                        <div class="col-md-12 mt-4">
                            <label class="block text-sm font-medium mb-2">
                                📍 Selecciona la ubicación de tu casa (opcional)
                            </label>
                            <p class="text-sm text-gray-500 mb-3">
                                Haz clic en el mapa para marcar tu ubicación
                            </p>

                            <!-- Mapa -->
                            <div id="map"
                                style="height: 400px; width: 100%; border-radius: 8px; margin-bottom: 1rem;">
                            </div>

                            <!-- Campos ocultos -->
                            <input type="hidden" name="lat" id="lat" value="{{ old('lat') }}">
                            <input type="hidden" name="lng" id="lng" value="{{ old('lng') }}">

                            <!-- Coordenadas -->
                            <div class="mt-2">
                                <small class="text-muted">
                                    <strong>Lat:</strong> <span
                                        id="display-lat">{{ old('lat', 'No seleccionada') }}</span> |
                                    <strong>Lng:</strong> <span
                                        id="display-lng">{{ old('lng', 'No seleccionada') }}</span>
                                </small>
                            </div>
                        </div>

                        {{-- observaciones --}}
                        <div class="col-md-12 mt-4">
                            <div class="entradas-de-texto-govco">
                                <label for="observaciones" class="form-label">Observaciones <span
                                        aria-required="false"></span></label>
                                <div class="container-input-texto-govco">
                                    <textarea id="observaciones" name="observaciones" rows="4" class="form-control"
                                        placeholder="Escriba aquí sus observaciones..."></textarea>
                                    <span id="campo-nota-observaciones" class="info-entradas-de-texto-govco">
                                        Este campo es opcional. Use este espacio para agregar información adicional o
                                        aclaraciones.
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="container mt-4">
                            <h4 class="mb-3 text-govco">📎 Archivos Opcionales</h4>
                            <p class="text-muted">
                                Los siguientes anexos pueden ayudar a agilizar el proceso de su solicitud.
                                Si no tiene estos documentos, aún puede completar y enviar el formulario.
                            </p>

                            <div class="card shadow-sm p-3 rounded-4 border-0">
                                <div class="list-group list-group-flush">

                                    <!-- 1. Certificado Electoral -->
                                    <div
                                        class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <div>
                                            <strong>Certificado Electoral</strong>
                                            <div class="small text-muted">Antigüedad mínima de 12 meses</div>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <input type="file" id="fileElectoral" name="fileElectoral" class="d-none"
                                                accept=".pdf,.jpg,.jpeg,.png">
                                            <button type="button" class="btn btn-outline-primary btn-sm"
                                                onclick="document.getElementById('fileElectoral').click()">
                                                Seleccionar archivo
                                            </button>
                                            <span id="nameElectoral" class="small text-secondary">No seleccionado</span>
                                        </div>
                                    </div>

                                    <!-- 2. Constancia del Sisbén -->
                                    <div
                                        class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <div>
                                            <strong>Constancia del Sisbén</strong>
                                            <div class="small text-muted">Formato PDF o JPG (máx. 10MB)</div>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <input type="file" id="fileSisben" name="fileSisben" class="d-none"
                                                accept=".pdf,.jpg,.jpeg,.png">
                                            <button type="button" class="btn btn-outline-primary btn-sm"
                                                onclick="document.getElementById('fileSisben').click()">
                                                Seleccionar archivo
                                            </button>
                                            <span id="nameSisben" class="small text-secondary">No seleccionado</span>
                                        </div>
                                    </div>

                                    <!-- 3. Certificación de la Junta de Acción Comunal -->
                                    <div
                                        class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <div>
                                            <strong>Certificación de la Junta de Acción Comunal <span
                                                    class="text-danger">*</span></strong>
                                            <div class="small text-muted">Formato PDF o JPG (máx. 10MB)</div>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <input type="file" id="fileJAC" name="fileJAC" class="d-none"
                                                accept=".pdf,.jpg,.jpeg,.png">
                                            <button type="button" class="btn btn-outline-primary btn-sm"
                                                onclick="document.getElementById('fileJAC').click()">
                                                Seleccionar archivo
                                            </button>
                                            <span id="nameJAC" class="small text-secondary">No seleccionado</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Checkbox de términos -->
                        <!-- Consentimientos -->
                        <div class="container mt-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" name="tratamiento_datos"
                                            id="autorizo_datos" required>
                                        <label class="form-check-label" for="autorizo_datos">
                                            Autorizo el <a href="#" target="_blank"
                                                class="link-primary text-decoration-underline">
                                                tratamiento de datos personales
                                            </a>
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="terminos"
                                            id="acepto_terminos" required>
                                        <label class="form-check-label" for="acepto_terminos">
                                            Acepto los <a href="#" target="_blank"
                                                class="link-primary text-decoration-underline">
                                                términos y condiciones
                                            </a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Botón enviar -->
                    <div class="mt-4 text-end">
                        <button type="submit" class="btn btn-primary">
                            Enviar solicitud
                        </button>
                    </div>
                </form>
                @include('components.xroad.direccion')
            @endif
        </div>
    @endauth
</div>
