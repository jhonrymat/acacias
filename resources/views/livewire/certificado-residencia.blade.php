<div>
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="Miga de pan predeterminada de tres niveles" class="breadcrumb-nav-govco">
                <ul class="breadcrumb-govco" id="breadcrumb-govco">
                    <li class="breadcrumb-item-govco"><a href="#" id="miga-inicio">Inicio</a></li>
                    <li class="breadcrumb-item-govco" id="miga-dinamica-1"></li>
                    <li class="breadcrumb-item-govco active" aria-current="page" id="miga-actual"></li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="row">
        {{-- dos columnas --}}
        <div class="col-md-9">
            <div class="container-example-linea-avance-govco">
                <div class="linea-avance-govco h-linea-avance-govco" id="lineaAvance1">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 15%" aria-valuenow="15"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    {{-- <!-- ENCABEZADO --> --}}
                    <div class="items-header-linea-avance-govco">
                        <div class="header-linea-avance-govco active-linea-avance-govco">
                            <div class="indicator-linea-avance-govco" data-la-target="#itemLineaAvance11"
                                percentage="15">1</div>
                            <span class="title-linea-avance-govco">Inicio</span>
                        </div>
                        <div class="header-linea-avance-govco">
                            <div class="indicator-linea-avance-govco" data-la-target="#itemLineaAvance12"
                                percentage="50">2</div>
                            <span class="title-linea-avance-govco">Hago mi solicitud</span>
                        </div>
                        <div class="header-linea-avance-govco">
                            <div class="indicator-linea-avance-govco" data-la-target="#itemLineaAvance13"
                                percentage="80">3</div>
                            <span class="title-linea-avance-govco">Procesan mi solicitud</span>
                        </div>
                        <div class="header-linea-avance-govco">
                            <div class="indicator-linea-avance-govco" data-la-target="#itemLineaAvance14"
                                percentage="100">4</div>
                            <span class="title-linea-avance-govco">Respuesta</span>
                        </div>
                    </div>

                    {{-- <!-- CONTENIDO PASOS --> --}}
                    <div id="itemLineaAvance11" class="body-linea-avance-govco active-linea-avance-govco"
                        data-la-parent="#lineaAvance1">
                        @include('components.xroad.paso1')
                    </div>

                    <div id="itemLineaAvance12" class="body-linea-avance-govco" data-la-parent="#lineaAvance1">
                        @include('components.xroad.paso2')
                    </div>

                    <div id="itemLineaAvance13" class="body-linea-avance-govco" data-la-parent="#lineaAvance1">
                        @include('components.xroad.paso3')
                    </div>

                    <div id="itemLineaAvance14" class="body-linea-avance-govco" data-la-parent="#lineaAvance1">
                        @include('components.xroad.paso4')
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="aservice-container">
                @include('components.xroad.logout')
                <br>
                <a href="javascript:void(0)" tabindex="-1" class="aservice-spacing" id="aserviceTutorial">
                    <div class="aservice" tabindex="0">
                        <div class="aservice-item link-card">
                            <p class="aservice-text-govco aservice-link-govco aservice-spacing-card">
                                Te explicamos con tutoriales
                            </p>
                        </div>
                    </div>
                </a>
                <div class="aservice aservice-spacing" id="aserviceConsulta">
                    <div class="aservice-item">
                        <h2 class="aservice-header-govco" id="headingOne">
                            <button class="button-aservice-govco collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne"
                                id="collapseOneButton">
                                <a class="aservice-text-govco">¿Tienes dudas sobre este trámite o consulta?</a>
                            </button>
                        </h2>
                        <div id="collapseOne" class="aservice-collapse" aria-labelledby="headingOne"
                            data-bs-parent="#aserviceExampleOne">
                            <div class="aservice-body">
                                <div class="row aservice-row-govco">
                                    <span class="mail-icon-govco"></span>
                                    <div class="aservice-mailto-container">
                                        <a href="mailto:contactenos@acacias.gov.co" class="aservice-mailto-govco">Enviar
                                            correo electrónico</a>
                                    </div>
                                </div>
                                <div class="row aservice-row-govco aservice-row-center-govco">
                                    <span class="headset-icon-govco"></span>
                                    <p class="aservice-number-govco">
                                        <a href="tel:+018000112996"> 01 8000 112 996</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="aservice" id="aserviceProceso">
                    <div class="aservice-item">
                        <h2 class="aservice-header-govco" id="headingTwo">
                            <button class="button-aservice-govco collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"
                                id="collapseTwoButton">
                                <a class="aservice-text-govco">¿Cómo fue tu experiencia durante el proceso?</a>
                            </button>
                        </h2>
                        <div id="collapseTwo" class="aservice-collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#aserviceExampleTwo">
                            <div class="aservice-body aservice-body-two">
                                <ul class="aservice-item-menu-ul">
                                    <li class="aservice-item-menu-li">
                                        <a class="dropdown-item aservice-item-govco" id="easy_item"
                                            href="javascript:void(0)"
                                            onclick="selectedOption('easy_item', 'hard_item')">
                                            <div class="aservice-item-icon-govco">
                                                <span class="easy-icon-govco"></span>
                                            </div>
                                            <span>fácil</span>
                                        </a>
                                    </li>
                                    <li class="aservice-item-menu-li">
                                        <a class="dropdown-item aservice-item-govco" id="hard_item"
                                            href="javascript:void(0)"
                                            onclick="selectedOption('hard_item', 'easy_item')">
                                            <div class="aservice-item-icon-govco">
                                                <span class="hard-icon-govco"></span>
                                            </div>
                                            <span>difícil</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="alert aservice-alerta-govco aservice-alerta-success-govco asuccess"
                                    id="alerta-service" style="display: none;" role="alert">
                                    <p class="aservice-alerta-content-text">
                                        <span>¡Gracias!</span><br>Tus comentarios nos ayudan a mejorar los servicios de
                                        nuestro país.
                                    </p>
                                </div>
                                <div class="container-button" id="comentarios1-button" style="display: none;">
                                    <button type="button" class="btn btn-primary btn-service-govco btn-contorno"
                                        onclick="verComentarios()">Envía tus comentarios</button>
                                </div>
                                <div class="aservice-comentarios" id="aservice-comentarios" style="display: none;">
                                    <p class="aservice-comentarios-fixed-text">Escribe tus comentarios:</p>
                                    <textarea class="aservice-comentarios-textarea" id="aservice-comentarios-textarea"
                                        placeholder="Queremos conocer tu experiencia, sugerencias y consejos..." onkeypress="contadorTextArea()"
                                        aria-label="area de comentarios"></textarea>
                                    <p class="aservice-comentarios-alert" id="aservice-comentarios-alert"
                                        style="display: none;">
                                        * Para poder enviar su comentario, este debe contener, al menos, 10 caracteres.
                                    </p>
                                </div>
                                <div class="container-button" id="comentarios2-button" style="display: none;">
                                    <button type="button" id="comentarios2-button-item" disabled="true"
                                        class="btn btn-primary btn-service-govco btn-contorno"
                                        onclick="enviarComentarios()">Envía tus comentarios</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
