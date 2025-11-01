{{-- Paso 2: Contenido condicional según autenticación --}}
<div>
    <!-- Asegúrate de tener esta hoja de estilo en tu layout principal -->
    <div class="container my-4">
        <p class="text-muted mb-4 small">
            Todos los campos marcados con el símbolo asterisco (<span aria-required="true">*</span>) son obligatorios.
        </p>

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
                        <input type="text" id="nombre_contribuyente" name="nombre_contribuyente" class="form-control"
                            value="{{ auth()->user()->name ?? 'PARRA GUEVARA FREDY' }}" disabled>
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
                    <label for="departamento_residencia" class="form-label" style="color: #BABABA;">Departamento de
                        Residencia <span aria-required="true"></span></label>
                    <div class="container-input-texto-govco">
                        <select id="departamento_residencia" name="departamento_residencia" class="form-select"
                            disabled>
                            <option value="META" selected>META</option>
                            <option value="CUNDINAMARCA">CUNDINAMARCA</option>
                            <option value="ANTIOQUIA">ANTIOQUIA</option>
                        </select>
                        <span id="campo-nota-general" class="info-entradas-de-texto-govco" style="color: #BABABA;">
                            Este campo se completa automáticamente.
                        </span>
                    </div>
                </div>
            </div>

            <!-- Municipio de residencia -->
            <div class="col-md-6">
                <div class="entradas-de-texto-govco">
                    <label for="municipio_residencia" class="form-label" style="color: #BABABA;">Municipio de Residencia
                        <span aria-required="true"></span></label>
                    <div class="container-input-texto-govco">
                        <select id="municipio_residencia" name="municipio_residencia" class="form-select" disabled>
                            <option value="ACACIAS" selected>ACACÍAS</option>
                            <option value="VILLAVICENCIO">VILLAVICENCIO</option>
                            <option value="GRANADA">GRANADA</option>
                        </select>
                        <span id="campo-nota-general" class="info-entradas-de-texto-govco" style="color: #BABABA;">
                            Este campo se completa automáticamente.
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <label for="direccion" class="form-label">Dirección*</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="direccion" disabled
                        placeholder="Seleccione su dirección">
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                        data-bs-target="#modalDireccion">
                        +
                    </button>
                </div>
                <span id="campo-nota" class="info-entradas-de-texto-govco">
                    No se puede escribir directamente la dirección. Para ingresarla, haz clic en el botón azul con el
                    signo (+) y completa la información desde allí.
                </span>
            </div>

            <div class="col-md-6">
                <label for="id_barrio" class="block text-sm font-medium form-label">Barrio o Vereda*</label>
                <select name="id_barrio" id="id_barrio" class="form-select select2" required>
                    <option value="">Selecciona un barrio o vereda</option>
                    @foreach ($barrios as $barrio)
                        <option value="{{ $barrio->id }}" {{ old('id_barrio') == $barrio->id ? 'selected' : '' }}>
                            {{ $barrio->nombreBarrio }} - {{ $barrio->zona }} - {{ $barrio->tipoUnidad }}
                            {{ $barrio->codigoNumero }}
                        </option>
                    @endforeach
                </select>
                <span class="alert-desplegable-govco" id="alert-barrio-id">
                    Selecciona el barrio o vereda correspondiente a tu ubicación
                </span>
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
                <div id="map" style="height: 400px; width: 100%; border-radius: 8px; margin-bottom: 1rem;">
                </div>

                <!-- Campos ocultos -->
                <input type="hidden" name="lat" id="lat" value="{{ old('lat') }}">
                <input type="hidden" name="lng" id="lng" value="{{ old('lng') }}">

                <!-- Coordenadas -->
                <div class="mt-2">
                    <small class="text-muted">
                        <strong>Lat:</strong> <span id="display-lat">{{ old('lat', 'No seleccionada') }}</span> |
                        <strong>Lng:</strong> <span id="display-lng">{{ old('lng', 'No seleccionada') }}</span>
                    </small>
                </div>
            </div>


        </div>

    </div>

    @include('components.xroad.direccion')
</div>


{{-- <div class="contents-example-linea-avance-govco">
        <button type="button" class="btn-govco fill-btn-govco" style="width: 165px; height: 42px;"
            onclick="pasosPermitidos = [1,2,3]; irAlPaso(3);">Continuar</button>
    </div> --}}
