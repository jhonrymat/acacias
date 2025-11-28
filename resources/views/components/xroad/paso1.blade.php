{{-- Paso 1: Contenido condicional según autenticación --}}
<div>
    @guest
        {{-- Usuario NO autenticado: Mostrar formulario de login --}}
        @include('components.xroad.login')
    @endguest

    @auth
        {{-- Usuario autenticado: Mostrar información del certificado --}}
        <div class="certificado-info-container">
            <h3>Certificado de Residencia</h3>

            <div class="alert alert-success mb-4" role="alert">
                <strong>¡Bienvenido, {{ auth()->user()->name }}!</strong><br>
                Ahora puedes crear tu solicitud de certificado de residencia.
            </div>


            <div class="row mb-4">
                <div class="col-md-12" style="text-align: justify;">
                    El <strong>Certificado de Residencia</strong> es un documento oficial que acredita el lugar donde una
                    persona vive de forma habitual.
                    Este certificado es expedido por la autoridad competente del municipio o distrito y se utiliza para
                    diversos fines, como
                    trámites administrativos, educativos, laborales o judiciales.
                    A través de esta plataforma podrás realizar el proceso en línea, de manera segura y rápida, sin
                    necesidad de desplazarte.
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <h5><strong>Tipo de trámite</strong></h5>
                    <p>Trámite en línea para la expedición de certificados y constancias de residencia.</p>
                </div>
                <div class="col-md-6 mb-4">
                    <h5><strong>¿Cuánto tarda el proceso?</strong></h5>
                    <p>El certificado se genera en un plazo máximo de <strong>15 días hábiles</strong> una vez verificada
                        la información.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <h5><strong>¿Tiene costo?</strong></h5>
                    <p>No. Este trámite <strong>no tiene costo</strong> y puede realizarse completamente en línea.</p>
                </div>
                <div class="col-md-6 mb-4">
                    <h5><strong>¿A dónde ir?</strong></h5>
                    <p>No es necesario desplazarse. Todo el proceso se realiza de forma virtual desde esta plataforma.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <h5><strong>¿Cuándo puedo realizarlo?</strong></h5>
                    <p>En cualquier momento, los <strong>7 días de la semana</strong>, durante las 24 horas del día.</p>
                </div>
                <div class="col-md-6 mb-4">
                    <h5><strong>¿Es obligatorio?</strong></h5>
                    <p>No. Este documento se solicita únicamente cuando alguna entidad pública o privada requiere acreditar
                        su lugar de residencia.</p>
                </div>
            </div>

            <div class="container my-3">
                <div class="alert alert-light border shadow-sm p-4 d-flex flex-column flex-md-row align-items-start gap-3"
                    style="box-shadow: 0px 0rem .25rem rgb(0 88 255) !important; background-color: #ffffff;">
                    <div class="flex-shrink-0">
                        <span class="alerta-icon-govco alerta-icon-notificacion-govco anotificacion"></span>
                    </div>
                    <div class="flex-grow-1">
                        <p class="mb-0 text-primary lh-base" style="text-align: justify;">
                            <strong class="text-uppercase text-primary">Importante:</strong> Veracidad de la información.
                            Al completar esta solicitud para obtener un certificado de residencia, usted declara que la
                            información
                            proporcionada es fiel y verdadera.
                            La presentación de datos falsos, como una dirección incorrecta o un documento adulterado, no
                            solo invalida su
                            solicitud, sino que también constituye una falta grave de acuerdo con la normativa legal
                            vigente.
                            <strong>Advertencia:</strong> Según el Artículo 289 del Código Penal Colombiano, la falsedad en
                            documento público es un delito que puede conllevar sanciones penales, incluyendo penas de
                            prisión.
                            Asegúrese de que todos los datos ingresados sean correctos y verificables para evitar sanciones
                            y garantizar un
                            proceso ágil.
                            <strong>¡Su honestidad es esencial para mantener la integridad de este proceso!</strong>
                        </p>
                    </div>
                </div>
            </div>


            <div class="row mt-4">
                {{-- centrar el contenido del div --}}
                <div class="col-md-6 mb-3" style="text-align: center;">
                    <a type="button" class="module-tarjeta-govco" title="descripción donde redirige el enlace"
                        onclick="pasosPermitidos = [1,2]; irAlPaso(2); setTimeout(initMap, 300); setTimeout(() => inicializarPaso2?.(), 150);">
                        <div class="header-tarjeta-govco">
                            <h5>Crear Solicitud</h5>
                        </div>
                        <hr>
                        <div class="body-tarjeta-govco">
                            <p>Diligencia tus datos y genera tu certificado de residencia en línea, de forma rápida y
                                segura.</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 mb-3" style="text-align: center;">
                    <a type="button" class="module-tarjeta-govco"
                        onclick="pasosPermitidos = [1,4]; irAlPaso(4); setTimeout(() => inicializarPaso4?.(), 150);">
                        <div class="header-tarjeta-govco">
                            <h5>Consultar Solicitud</h5>
                        </div>
                        <hr>
                        <div class="body-tarjeta-govco">
                            <p>Verifica el estado de tu trámite y descarga tu certificado.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    @endauth
</div>
