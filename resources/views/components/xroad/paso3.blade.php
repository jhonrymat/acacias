{{-- Paso 3: Contenido condicional según autenticación --}}
<div>
    @guest
        <p>Por favor inicie sesión para continuar con su solicitud.</p>
        {{-- de clic aqui para iniciar sesión --}}
        <a href="{{ route('certificado.auth.login') }}" class="btn btn-primary">Iniciar sesión</a>
    @endguest

    @auth
        @include('components.xroad.logout')
        <div class="container my-4">
            <!-- Spinner de carga personalizado -->
            <div id="spinnerPaso3" style="display: none; padding: 60px 0; text-align: center;">
                <div style="display: inline-block;">
                    <!-- Spinner personalizado estilo GOV.CO -->
                    <div class="custom-spinner-govco" role="status" aria-hidden="true">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                    <p style="margin-top: 20px; color: #3366CC; font-size: 16px; font-weight: 500;">Procesando tu
                        solicitud...</p>
                </div>
            </div>

            <!-- Contenido del Paso 3 -->
            <div id="contenidoPaso3" style="display: none;">
                <!-- Mensaje de éxito estilo GOV.CO -->
                <div class="alert alert-success d-flex align-items-center" role="alert"
                    style="background-color: #d4edda; border: 1px solid #c3e6cb; border-radius: 4px; padding: 15px 20px;">
                    <svg style="width: 24px; height: 24px; margin-right: 12px; flex-shrink: 0;" viewBox="0 0 24 24"
                        fill="none">
                        <circle cx="12" cy="12" r="10" fill="#28a745" />
                        <path d="M9 12l2 2 4-4" stroke="white" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <div style="flex: 1;">
                        <strong style="display: block; margin-bottom: 8px;">Su solicitud se ha registrado
                            exitosamente</strong>
                        <p style="margin: 0; font-size: 14px;">Por favor verifique su mensaje de confirmación en su correo
                            electrónico, para hacerle seguimiento a este trámite no olvide anotar el ID del radicado
                            descrito a continuación. Muchas Gracias por utilizar nuestros servicios</p>
                    </div>
                </div>

                <!-- Número de radicado y Tiempo estimado -->
                <div style="margin: 30px 0;">
                    <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 8px;">Número de radicado</h3>
                    <p id="numeroRadicado" style="font-size: 16px; color: #666; margin-bottom: 30px;">—</p>

                    <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 8px;">Tiempo estimado de respuesta</h3>
                    <p style="font-size: 14px; color: #666; margin-bottom: 40px;">7 días hábiles, una vez se emita una
                        respuesta recibirá una copia al correo registrado</p>
                </div>

                <!-- Título de Anidamiento -->
                <h4 style="color: #3366CC; font-size: 20px; font-weight: 600; margin-bottom: 20px;">Anidamiento</h4>

                <!-- Tabla anidada con información de la solicitud -->
                <div class="contenedor-tabla">
                    <h4 class="modal-title-tables" id="tableDescSolicitud">Resumen de Solicitud</h4>
                    <table class="table-externa" aria-describedby="tableDescSolicitud">
                        <thead class="encabezado-tabla-externa">
                            <tr>
                                <th scope="col">Campo</th>
                                <th scope="col">Información</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Detalles</th>
                            </tr>
                        </thead>
                        <tbody class="contenido-tablas">
                            <!-- Fila de Información General -->
                            <tr>
                                <td><strong>Información General</strong></td>
                                <td>
                                    <span>Radicado N° <strong id="numeroRadicado">—</strong></span>
                                </td>
                                <td>
                                    <span id="estadoSolicitud" class="badge bg-warning text-dark">Pendiente</span>
                                </td>
                                <td>Solicitud registrada exitosamente</td>
                            </tr>

                            <!-- Tabla interna con detalles de la solicitud -->
                            <tr class="contenedor-tabla-interna">
                                <td colspan="4">
                                    <table class="table-interna">
                                        <caption class="caption-top">
                                            <span class="caption-1">Detalles de la Solicitud</span>
                                            <span class="caption-2">Información completa de tu solicitud de
                                                residencia</span>
                                        </caption>
                                        <thead class="encabezado-tabla-interna">
                                            <tr>
                                                <th scope="col">Tipo de Dato</th>
                                                <th scope="col">Valor</th>
                                                <th scope="col">Observaciones</th>
                                            </tr>
                                        </thead>
                                        <tbody class="contenido-tablas-interno">
                                            <tr>
                                                <td><strong>Dirección</strong></td>
                                                <td id="direccionSolicitud">—</td>
                                                <td>Dirección de residencia</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Barrio</strong></td>
                                                <td id="barrioSolicitud">—</td>
                                                <td>Barrio seleccionado</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Coordenadas</strong></td>
                                                <td>
                                                    Lat: <span id="latitudSolicitud">—</span> /
                                                    Lng: <span id="longitudSolicitud">—</span>
                                                </td>
                                                <td>Ubicación en mapa</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Observaciones</strong></td>
                                                <td id="observacionesSolicitud">—</td>
                                                <td>Comentarios adicionales</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                            <!-- Fila de Documentos Adjuntos -->
                            <tr>
                                <td><strong>Documentos</strong></td>
                                <td>
                                    <span id="contadorDocumentos">5 documentos</span>
                                </td>
                                <td>
                                    <span class="badge bg-success">Completo</span>
                                </td>
                                <td>Archivos cargados</td>
                            </tr>

                            <!-- Tabla interna con documentos -->
                            <tr class="contenedor-tabla-interna">
                                <td colspan="4">
                                    <table class="table-interna">
                                        <caption class="caption-top">
                                            <span class="caption-1">Documentos Adjuntos</span>
                                            <span class="caption-2">Lista de archivos cargados en tu solicitud</span>
                                        </caption>
                                        <thead class="encabezado-tabla-interna">
                                            <tr>
                                                <th scope="col">Tipo de Documento</th>
                                                <th scope="col">Estado</th>
                                                <th scope="col">Tipo</th>
                                                <th scope="col">Observaciones</th>
                                            </tr>
                                        </thead>
                                        <tbody class="contenido-tablas-interno">
                                            <!-- Documentos obligatorios -->
                                            <tr>
                                                <td><strong>Fotocopia de Cédula</strong></td>
                                                <td>
                                                    <span class="badge bg-success">✓ Adjunto</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-danger">Obligatorio</span>
                                                </td>
                                                <td id="docCedula">Archivo cargado correctamente</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Recibo de Servicios</strong></td>
                                                <td>
                                                    <span class="badge bg-success">✓ Adjunto</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-danger">Obligatorio</span>
                                                </td>
                                                <td id="docRecibo">Archivo cargado correctamente</td>
                                            </tr>

                                            <!-- Documentos opcionales (se muestran dinámicamente) -->
                                            <tr id="rowElectoral" style="display: none;">
                                                <td><strong>Certificado Electoral</strong></td>
                                                <td>
                                                    <span class="badge bg-success">✓ Adjunto</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info">Opcional</span>
                                                </td>
                                                <td id="docElectoral">Archivo cargado correctamente</td>
                                            </tr>
                                            <tr id="rowSisben" style="display: none;">
                                                <td><strong>Certificado SISBEN</strong></td>
                                                <td>
                                                    <span class="badge bg-success">✓ Adjunto</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info">Opcional</span>
                                                </td>
                                                <td id="docSisben">Archivo cargado correctamente</td>
                                            </tr>
                                            <tr id="rowJAC" style="display: none;">
                                                <td><strong>Carta Acción Comunal</strong></td>
                                                <td>
                                                    <span class="badge bg-success">✓ Adjunto</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info">Opcional</span>
                                                </td>
                                                <td id="docJAC">Archivo cargado correctamente</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Botones de acción -->
                <div class="mt-4 d-flex gap-3 justify-content-center flex-wrap">
                    <button type="button"
                        class="btn-govco fill-btn-govco symbol-btn-govco mixed-btn-govco left-arrow-btn-govco"
                        onclick="window.print()" icon-position="left" style="width: 165px; height: 42px;">
                        <span>Imprimir Resumen</span>
                    </button>
                    <button type="button"
                        class="btn-govco no-fill-btn-govco symbol-btn-govco mixed-btn-govco left-arrow-btn-govco"
                        icon-position="left" style="width: 123px; height: 32px;"
                        onclick="pasosPermitidos = [1,3,4]; irAlPaso(4);">
                        <span class="sub-btn-govco">Ver todas mis solicitudes</span>
                    </button>
                </div>
            </div>
        </div>

        <style>
            /* Spinner personalizado estilo GOV.CO */
            .custom-spinner-govco {
                width: 60px;
                height: 60px;
                border: 8px solid #e0e0e0;
                border-top: 8px solid #3366CC;
                border-radius: 50%;
                animation: spin-govco 1s linear infinite;
                margin: 0 auto;
            }

            @keyframes spin-govco {
                0% {
                    transform: rotate(0deg);
                }

                100% {
                    transform: rotate(360deg);
                }
            }

            .visually-hidden {
                position: absolute;
                width: 1px;
                height: 1px;
                padding: 0;
                margin: -1px;
                overflow: hidden;
                clip: rect(0, 0, 0, 0);
                white-space: nowrap;
                border-width: 0;
            }

            /* Estilos para la tabla anidada si no están definidos */
            .contenedor-tabla {
                margin: 20px 0;
                width: 100%;
            }

            .table-externa {
                width: 100%;
                border-collapse: collapse;
            }

            .table-interna {
                width: 100%;
                margin: 10px 0;
                background: #f8f9fa;
            }

            .caption-top {
                caption-side: top;
                padding: 10px;
                background: #e9ecef;
            }

            .caption-1 {
                display: block;
                font-weight: bold;
                font-size: 1.1em;
            }

            .caption-2 {
                display: block;
                font-size: 0.9em;
                color: #666;
            }
        </style>

        <script>
            // Función para mostrar el paso 3 con spinner y datos dinámicos
            function mostrarPaso3(solicitud) {
                console.log('📋 Mostrando paso 3 con datos:', solicitud);

                // 1️⃣ PRIMERO: Ocultar pasos anteriores y mostrar SOLO el spinner
                const spinner = document.getElementById('spinnerPaso3');
                const contenido = document.getElementById('contenidoPaso3');
                const paso1 = document.getElementById('paso1');
                const paso2 = document.getElementById('paso2');

                // Ocultar todos los pasos anteriores
                if (paso1) paso1.style.display = 'none';
                if (paso2) paso2.style.display = 'none';
                contenido.style.display = 'none';

                // Mostrar SOLO el spinner (sin modal, solo el contenido)
                spinner.style.display = 'block';

                // 2️⃣ DESPUÉS DE 2 SEGUNDOS: Ocultar spinner y mostrar contenido
                setTimeout(() => {
                    // Ocultar spinner
                    spinner.style.display = 'none';

                    // Mostrar contenido del paso 3
                    contenido.style.display = 'block';

                    // 📋 Insertar datos básicos
                    // Número de radicado en la sección superior
                    const numeroRadicadoElements = document.querySelectorAll('#numeroRadicado');
                    numeroRadicadoElements.forEach(el => {
                        el.textContent = solicitud.id || '—';
                    });

                    document.getElementById('direccionSolicitud').textContent = solicitud.direccion || '—';
                    document.getElementById('barrioSolicitud').textContent = solicitud.id_barrio ?? '—';
                    document.getElementById('latitudSolicitud').textContent = solicitud.lat || '—';
                    document.getElementById('longitudSolicitud').textContent = solicitud.lng || '—';
                    document.getElementById('observacionesSolicitud').textContent = solicitud.observaciones ||
                        'Sin observaciones';

                    // Estado dinámico según estado_id
                    const estadoEl = document.getElementById('estadoSolicitud');
                    switch (solicitud.estado_id) {
                        case 1:
                            estadoEl.textContent = 'Pendiente';
                            estadoEl.className = 'badge bg-warning text-dark';
                            break;
                        case 2:
                            estadoEl.textContent = 'En Proceso';
                            estadoEl.className = 'badge bg-info';
                            break;
                        case 3:
                            estadoEl.textContent = 'Aprobada';
                            estadoEl.className = 'badge bg-success';
                            break;
                        default:
                            estadoEl.textContent = 'Pendiente';
                            estadoEl.className = 'badge bg-warning text-dark';
                    }

                    // 📄 Contar documentos
                    let totalDocs = 2; // Cédula y recibo siempre
                    if (solicitud.electoral) totalDocs++;
                    if (solicitud.sisben) totalDocs++;
                    if (solicitud.accion_comunal) totalDocs++;
                    document.getElementById('contadorDocumentos').textContent = totalDocs + ' documento(s)';

                    // Mostrar documentos opcionales solo si existen
                    if (solicitud.electoral) {
                        document.getElementById('rowElectoral').style.display = 'table-row';
                    }

                    if (solicitud.sisben) {
                        document.getElementById('rowSisben').style.display = 'table-row';
                    }

                    if (solicitud.accion_comunal) {
                        document.getElementById('rowJAC').style.display = 'table-row';
                    }

                    // Scroll al inicio del paso 3
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });

                    console.log('✅ Paso 3 cargado exitosamente');
                }, 2000);
            }

            // Función para volver al inicio
            function volverAlInicio() {
                console.log('🔄 Volviendo al inicio');

                // Ocultar paso 3
                document.getElementById('contenidoPaso3').style.display = 'none';

                // Resetear documentos opcionales
                ['rowElectoral', 'rowSisben', 'rowJAC'].forEach(id => {
                    const el = document.getElementById(id);
                    if (el) el.style.display = 'none';
                });

                // Volver al paso 1
                if (typeof irAlPaso !== 'undefined') {
                    const paso1 = document.getElementById('paso1');
                    if (paso1) paso1.style.display = 'block';

                    pasosPermitidos = [1];
                    irAlPaso(1);
                } else {
                    window.location.reload();
                }
            }
        </script>
    @endauth
</div>
