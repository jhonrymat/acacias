<div>
    @guest
        <p>Por favor inicie sesión para continuar con su solicitud.</p>
        <a href="{{ route('certificado.auth.login') }}" class="btn btn-primary">Iniciar sesión</a>
    @endguest

    @auth
        @include('components.xroad.logout')
        <div class="container my-4">
            <link rel="stylesheet" href="https://cdn.www.gov.co/v4/general">
            <style>
                .table-responsive {
                    overflow-x: auto;
                }

                .estado-badge {
                    padding: 6px 12px;
                    border-radius: 4px;
                    font-size: 0.875rem;
                    font-weight: 500;
                    display: inline-block;
                    text-align: center;
                }

                .estado-warning {
                    background-color: #FFC107;
                    color: white;
                }

                .estado-success {
                    background-color: #28A745;
                    color: white;
                }

                .estado-danger {
                    background-color: #DC3545;
                    color: white;
                }

                .estado-info {
                    background-color: #17A2B8;
                    color: white;
                }

                .modal {
                    display: none;
                    position: fixed;
                    z-index: 1050;
                    left: 0;
                    top: 0;
                    width: 100%;
                    height: 100%;
                    overflow: auto;
                    background-color: rgba(0, 0, 0, 0.5);
                }

                .modal.show {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .modal-content {
                    background-color: #fff;
                    margin: auto;
                    padding: 20px;
                    border-radius: 8px;
                    max-width: 90%;
                    max-height: 90vh;
                    overflow-y: auto;
                }

                .close {
                    color: #aaa;
                    float: right;
                    font-size: 28px;
                    font-weight: bold;
                    cursor: pointer;
                }

                .close:hover,
                .close:focus {
                    color: #000;
                }

                .loading {
                    text-align: center;
                    padding: 20px;
                }

                .alert-success-custom {
                    background-color: #d4edda;
                    border: 1px solid #c3e6cb;
                    color: #155724;
                    padding: 15px;
                    border-radius: 8px;
                    margin-bottom: 20px;
                    display: flex;
                    align-items: center;
                    gap: 10px;
                }

                .btn-action {
                    margin: 2px;
                    padding: 8px 16px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                    font-size: 0.875rem;
                    transition: all 0.3s;
                }

                .btn-success {
                    background-color: #28a745;
                    color: white;
                }

                .btn-primary {
                    background-color: #007bff;
                    color: white;
                }

                .btn-danger {
                    background-color: #dc3545;
                    color: white;
                }

                .btn-action:hover {
                    opacity: 0.8;
                }

                @media (max-width: 768px) {
                    .modal-content {
                        max-width: 95%;
                        padding: 15px;
                    }

                    .table-responsive {
                        font-size: 0.85rem;
                    }

                    .btn-action {
                        font-size: 0.75rem;
                        padding: 6px 12px;
                    }
                }
            </style>

            <!-- Encabezado -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h2">Resultados de la Consulta</h1>
                <button id="btnMisDatos" class="btn btn-primary">
                    <i class="fas fa-user"></i> Mis Datos
                </button>
            </div>

            <!-- Mensaje de éxito -->
            <div class="alert-success-custom">
                <i class="fas fa-check-circle fa-2x"></i>
                <div>
                    <strong>Consulta realizada con éxito</strong>
                    <p class="mb-0">Bienvenido, <span id="nombreUsuario"></span></p>
                </div>
            </div>

            <!-- Estado y NIT -->
            <div class="mb-3">
                <p><strong>Estado:</strong> Solicitudes asociadas al número de identificación</p>
                <p><strong>NIT:</strong> <span id="userNit">{{ auth()->user()->numeroIdentificacion }}</span></p>
            </div>

            <!-- Loading -->
            <div id="loadingSolicitudes" class="loading">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only"></span>
                </div>
                <p>Cargando solicitudes...</p>
            </div>

            <!-- Tabla de solicitudes -->
            <div id="tablaSolicitudes" class="table-responsive" style="display: none;">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Radicado</th>
                            <th>Identificación</th>
                            <th>Dirección</th>
                            <th>Barrio/Vereda</th>
                            <th>Fecha </th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-solicitudes">
                        <!-- Datos cargados dinámicamente -->
                    </tbody>
                </table>
            </div>

            <!-- Botón finalizar -->
            <button type="button" class="btn-govco fill-btn-govco" style="width: 165px; height: 42px;"
                onclick="pasosPermitidos = [1,4]; irAlPaso(1);">Finalizar</button>


            <!-- Modal Datos Usuario -->
            <div id="modalDatosUsuario" class="modal">
                <div class="modal-content" style="max-width: 900px;">
                    <span class="close" onclick="cerrarModal('modalDatosUsuario')">&times;</span>
                    <h2 class="mb-4">Información de Usuario</h2>
                    <div id="loadingDatosUsuario" class="loading">
                        <div class="spinner-border text-primary" role="status"></div>
                    </div>
                    <div id="contenidoDatosUsuario" style="display: none;">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="border p-3 rounded">
                                    <h5 class="mb-3">Datos Personales</h5>
                                    <div class="mb-2">
                                        <label class="font-weight-bold">Nombre Completo:</label>
                                        <p id="datosNombreCompleto"></p>
                                    </div>
                                    <div class="mb-2">
                                        <label class="font-weight-bold">Email:</label>
                                        <p id="datosEmail"></p>
                                    </div>
                                    <div class="mb-2">
                                        <label class="font-weight-bold">Teléfono:</label>
                                        <p id="datosTelefono"></p>
                                    </div>
                                    <div class="mb-2">
                                        <label class="font-weight-bold">Género:</label>
                                        <p id="datosGenero"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="border p-3 rounded">
                                    <h5 class="mb-3">Información Adicional</h5>
                                    <div class="mb-2">
                                        <label class="font-weight-bold">Tipo Solicitante:</label>
                                        <p id="datosTipoSolicitante"></p>
                                    </div>
                                    <div class="mb-2">
                                        <label class="font-weight-bold">Tipo Documento:</label>
                                        <p id="datosTipoDocumento"></p>
                                    </div>
                                    <div class="mb-2">
                                        <label class="font-weight-bold">Identificación:</label>
                                        <p id="datosIdentificacion"></p>
                                    </div>
                                    <div class="mb-2">
                                        <label class="font-weight-bold">Ciudad Expedición:</label>
                                        <p id="datosCiudadExpedicion"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="border p-3 rounded">
                                    <h5 class="mb-3">Detalles Personales</h5>
                                    <div class="mb-2">
                                        <label class="font-weight-bold">Fecha Nacimiento:</label>
                                        <p id="datosFechaNacimiento"></p>
                                    </div>
                                    <div class="mb-2">
                                        <label class="font-weight-bold">Nivel Estudio:</label>
                                        <p id="datosNivelEstudio"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="border p-3 rounded">
                                    <h5 class="mb-3">Ocupación y Población</h5>
                                    <div class="mb-2">
                                        <label class="font-weight-bold">Ocupación:</label>
                                        <p id="datosOcupacion"></p>
                                    </div>
                                    <div class="mb-2">
                                        <label class="font-weight-bold">Población:</label>
                                        <p id="datosPoblacion"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Notas -->
            <div id="modalNotas" class="modal">
                <div class="modal-content" style="max-width: 600px;">
                    <span class="close" onclick="cerrarModal('modalNotas')">&times;</span>
                    <h2 class="mb-4">Detalles del Validador</h2>
                    <div id="loadingNotas" class="loading">
                        <div class="spinner-border text-primary" role="status"></div>
                    </div>
                    <div id="contenidoNotas" style="display: none;">
                        <p id="textoNotas"></p>
                    </div>
                    <div class="text-right mt-4">
                        <button onclick="cerrarModal('modalNotas')" class="btn btn-secondary">Cerrar</button>
                    </div>
                </div>
            </div>

            <!-- Modal Anulación -->
            <div id="modalAnulacion" class="modal">
                <div class="modal-content" style="max-width: 600px;">
                    <span class="close" onclick="cerrarModal('modalAnulacion')">&times;</span>
                    <h2 class="mb-4">Detalles de la Anulación</h2>
                    <div id="loadingAnulacion" class="loading">
                        <div class="spinner-border text-primary" role="status"></div>
                    </div>
                    <div id="contenidoAnulacion" style="display: none;">
                        <div class="mb-3">
                            <label class="font-weight-bold">Descripción:</label>
                            <p id="descripcionAnulacion"></p>
                        </div>
                        <div id="archivoAnulacionContainer" style="display: none;">
                            <label class="font-weight-bold">Archivo:</label>
                            <p><a id="linkArchivoAnulacion" href="#" target="_blank" class="btn btn-info">Ver
                                    Archivo</a></p>
                        </div>
                    </div>
                    <div class="text-right mt-4">
                        <button onclick="cerrarModal('modalAnulacion')" class="btn btn-secondary">Cerrar</button>
                    </div>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
            <script>
                // Variable para controlar si ya se cargaron las solicitudes
                let solicitudesCargadas = false;

                $(document).ready(function() {
                    // NO cargar automáticamente, esperar a que se llame la función

                    // Evento del botón Mis Datos
                    $('#btnMisDatos').click(function() {
                        abrirModalDatosUsuario();
                    });
                });

                // Función global para inicializar/recargar el paso 4
                window.inicializarPaso4 = function() {
                    // Resetear el estado
                    $('#loadingSolicitudes').show();
                    $('#tablaSolicitudes').hide();
                    solicitudesCargadas = false;

                    // Cargar solicitudes (siempre frescas)
                    cargarSolicitudes();
                };

                // Cargar solicitudes
                function cargarSolicitudes() {
                    $.ajax({
                        url: '{{ route('solicitudes.get') }}',
                        method: 'GET',
                        success: function(response) {
                            if (response.success) {
                                $('#nombreUsuario').text(response.usuario);
                                renderizarSolicitudes(response.solicitudes);
                                $('#loadingSolicitudes').hide();
                                $('#tablaSolicitudes').show();
                            }
                        },
                        error: function() {
                            $('#loadingSolicitudes').html(
                                '<div class="alert alert-danger">Error al cargar las solicitudes</div>'
                            );
                        }
                    });
                }

                // Renderizar tabla de solicitudes
                function renderizarSolicitudes(solicitudes) {
                    const tbody = $('#tbody-solicitudes');
                    tbody.empty();

                    if (solicitudes.length === 0) {
                        tbody.append('<tr><td colspan="7" class="text-center">No hay solicitudes registradas</td></tr>');
                        return;
                    }

                    solicitudes.forEach(function(sol) {
                        const acciones = generarAcciones(sol);
                        const row = `
                        <tr>
                            <td>${sol.id}</td>
                            <td>${sol.numeroIdentificacion}</td>
                            <td>${sol.direccion}</td>
                            <td>${sol.barrio}</td>
                            <td>${sol.created_at}</td>
                            <td><span class="estado-badge estado-${sol.estado_clase}">${sol.estado}</span></td>
                            <td>${acciones}</td>
                        </tr>
                    `;
                        tbody.append(row);
                    });
                }

                // Generar botones de acciones según el estado
                function generarAcciones(sol) {
                    if (sol.estado === 'Emitido' || sol.estado === 'Por vencer') {
                        return `
                        <button onclick="descargarPDF(${sol.id})" class="btn-action btn-success">
                            <i class="fas fa-file-arrow-down"></i> Descargar
                        </button>
                        <a href="{{ url('solicitud/pdf') }}/${sol.id}" target="_blank" class="btn-action btn-primary">
                            <i class="fas fa-eye"></i> Ver
                        </a>
                    `;
                    } else if (sol.estado === 'Anulado') {
                        if (sol.anulacion_visible === 1) {
                            return `
                            <button onclick="verAnulacion(${sol.id})" class="btn-action btn-danger">
                                <i class="fas fa-eye"></i> Ver Anulación
                            </button>
                        `;
                        } else {
                            return '<span class="text-muted">Anulación no disponible, deberá acercarse a la oficina.</span>';
                        }
                    } else if (sol.estado === 'No completado' && sol.validacion_visible === 1) {
                        return `
                        <button onclick="verNotas(${sol.validacion_id})" class="btn-action btn-primary">
                            <i class="fas fa-eye"></i> Ver detalles
                        </button>
                    `;
                    } else {
                        return '<span class="text-muted">El certificado no está disponible actualmente</span>';
                    }
                }

                // Descargar PDF
                function descargarPDF(id) {
                    window.location.href = `{{ url('solicitudes/pdf') }}/${id}`;
                }

                // Abrir modal de datos del usuario
                function abrirModalDatosUsuario() {
                    const modal = $('#modalDatosUsuario');
                    modal.addClass('show');
                    $('#loadingDatosUsuario').show();
                    $('#contenidoDatosUsuario').hide();

                    $.ajax({
                        url: '{{ route('solicitudes.datos-usuario') }}',
                        method: 'GET',
                        success: function(response) {
                            if (response.success) {
                                const datos = response.datos;
                                $('#datosNombreCompleto').text(datos.nombreCompleto);
                                $('#datosEmail').text(datos.email);
                                $('#datosTelefono').text(datos.telefonoContacto);
                                $('#datosGenero').text(datos.genero);
                                $('#datosTipoSolicitante').text(datos.tipoSolicitante);
                                $('#datosTipoDocumento').text(datos.tipoDocumento);
                                $('#datosIdentificacion').text(datos.numeroIdentificacion);
                                $('#datosCiudadExpedicion').text(datos.ciudadExpedicion);
                                $('#datosFechaNacimiento').text(datos.fechaNacimiento);
                                $('#datosNivelEstudio').text(datos.nivelEstudio);
                                $('#datosOcupacion').text(datos.ocupacion);
                                $('#datosPoblacion').text(datos.poblacion);

                                $('#loadingDatosUsuario').hide();
                                $('#contenidoDatosUsuario').show();
                            }
                        },
                        error: function() {
                            $('#loadingDatosUsuario').html(
                                '<div class="alert alert-danger">Error al cargar los datos</div>'
                            );
                        }
                    });
                }

                // Ver notas
                function verNotas(id) {
                    const modal = $('#modalNotas');
                    modal.addClass('show');
                    $('#loadingNotas').show();
                    $('#contenidoNotas').hide();

                    $.ajax({
                        url: `{{ url('solicitudes/notas') }}/${id}`,
                        method: 'GET',
                        success: function(response) {
                            if (response.success) {
                                $('#textoNotas').text(response.notas);
                                $('#loadingNotas').hide();
                                $('#contenidoNotas').show();
                            }
                        },
                        error: function() {
                            $('#loadingNotas').html(
                                '<div class="alert alert-danger">Error al cargar las notas</div>'
                            );
                        }
                    });
                }

                // Ver anulación
                function verAnulacion(id) {
                    const modal = $('#modalAnulacion');
                    modal.addClass('show');
                    $('#loadingAnulacion').show();
                    $('#contenidoAnulacion').hide();

                    $.ajax({
                        url: `{{ url('solicitudes/anulacion') }}/${id}`,
                        method: 'GET',
                        success: function(response) {
                            if (response.success) {
                                const anulacion = response.anulacion;
                                $('#descripcionAnulacion').text(anulacion.descripcion);

                                if (anulacion.archivo_url) {
                                    $('#linkArchivoAnulacion').attr('href', anulacion.archivo_url);
                                    $('#archivoAnulacionContainer').show();
                                } else {
                                    $('#archivoAnulacionContainer').hide();
                                }

                                $('#loadingAnulacion').hide();
                                $('#contenidoAnulacion').show();
                            }
                        },
                        error: function() {
                            $('#loadingAnulacion').html(
                                '<div class="alert alert-danger">Error al cargar la anulación</div>'
                            );
                        }
                    });
                }

                // Cerrar modal
                function cerrarModal(modalId) {
                    $('#' + modalId).removeClass('show');
                }

                // Cerrar modal al hacer clic fuera
                $(window).click(function(event) {
                    if ($(event.target).hasClass('modal')) {
                        $(event.target).removeClass('show');
                    }
                });
            </script>
        </div>
    @endauth
</div>
