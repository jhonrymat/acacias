<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Certificado de Residencia')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- css bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" rel="stylesheet"
        crossorigin="anonymous">
    <!-- css BDC -->
    <link href="https://cdn.www.gov.co/layout/v4/all.css" rel="stylesheet">
    <style>
        .govco-co {
            content: url('https://cdn.www.gov.co/v4/logo-colombia.svg');
        }

        .govco-logo {
            content: url('https://cdn.www.gov.co/v4/logo.svg');
        }

        .govco-logo-entidad {
            content: url('images/logo-web.png');
        }

        .alerta-govco {
            height: auto;
            max-height: 240px;
            padding: 3px !important;
        }

        .alerta-icon-govco {
            margin-left: 1.5rem;
        }


        .inicio-sesion-govco .container-login-opcion-govco {
            height: auto;
        }

        .container-example-linea-avance-govco {
            margin: 1.5rem auto;
        }

        .barra-accesibilidad-govco {
            z-index: 999;
        }

        .inicio-sesion-govco {
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }

        .govco-data-front {
            box-shadow: 50px 41px 0px -20px #07892f, -50px 41px 0px -20px #07892f, 0px 20px 0px 0px #e6effd, 50px 50px 0px -30px #e6effd, -50px 50px 0px -30px #e6effd;
        }


        @media (min-width: 1280px) {

            .govco-data-front {
                margin: 30px auto !important;
                width: 60%;
                -webkit-box-shadow: 300px 60px 0px -30px #07892f, -300px 60px 0px -30px #07892f, 0px 25px 0px 0px #e6effd, 120px 70px 0px -40px #e6effd, -120px 70px 0px -40px #e6effd;
            }
        }
    </style>
    @livewireStyles
</head>

<body>
    <!-- Barra Superior -->
    <nav class="navbar navbar-expand-lg barra-superior-govco" aria-label="Barra superior">
        <a href="https://www.gov.co/" target="_blank" aria-label="Portal del Estado Colombiano - GOV.CO"></a>
    </nav>

    <div class="content-example-barra ">
        <div class="barra-accesibilidad-govco">
            <button id="botoncontraste" class="icon-contraste" onclick="cambiarContexto()">
                <span id="titlecontraste">Contraste</span>
            </button>
            <button id="botondisminuir" class="icon-reducir" onclick="disminuirTamanio('disminuir')">
                <span id="titledisminuir">Reducir letra</span>
            </button>
            <button id="botonaumentar" class="icon-aumentar" onclick="aumentarTamanio('aumentar')">
                <span id="titleaumentar">Aumentar letra</span>
            </button>
        </div>
        <div class="row mx-3 mx-sm-4 mx-md-5 my-3 my-md-5">
            <div id="para-mirar" class="container">
                <br>
                {{ $slot }}
            </div>
        </div>
    </div>


    <button class="volver-arriba-govco position-fixed" style="bottom: 20px; right: 20px; z-index: 1200;"
        aria-describedby="descripcionId" aria-label="Volver arriba">
    </button>
    {{-- Footer GOV.CO --}}
    <div class="govco-footer">
        <div class="govco-data-front">
            <div class="govco-footer-text">
                <div class="row govco-nombre-entidad">
                    <div class="col-xs-12 col-lg-6">
                        <p class="govco-text-header-1">Sede electrónica Alcaldía de Acacías</p>
                    </div>
                    <div class="col-xs-12 col-lg-4 govco-logo-div-a">
                        <span class="govco-logo-entidad"></span>
                    </div>
                </div>

                <div class="row col-xs-12 col-lg-7 govco-texto-sedes">
                    <p class="govco-text-header-2">Sede principal</p>
                    Dirección: Calle 14 No. 21-32 Cooperativo - Acacías <br class="govco-mostrar">
                    Nit: 892.001.457-3 <br>
                    Meta - Acacías. <br>
                    Código Postal: 507001 <br>
                    Horario de atención: Lunes a Viernes de 7:00 a.m. - 12:00 m
                    y 2:00 p.m. - 5:00 p.m. <br>
                    Línea gratuita: 01 8000 112 996 <br>
                    Línea PBX: +57 (608) 3203509652 <br>
                    Línea anticorrupción: +57 (608) 3203509652
                    ext. 4106 <br>
                    Correo institucional: <br class="govco-mostrar">
                    contactenos@acacias.gov.co <br>
                </div>

                <div class="row govco-network" style="font-size: 13px">
                    <div class="col-md-3">
                        <span class="icon govco-twitter-square"></span>
                        <span class="govco-link-modal"><a class="section fa fa-twitter" target="_blank"
                                href="https://twitter.com/AlcaldiaAcacias" title="">
                                <strong class="list_enlace_text"> @alcaldiaacacias</strong>
                            </a>
                        </span>
                    </div>
                    <div class="col-md-3">
                        <span class="icon govco-instagram-square"></span>
                        <span class="govco-link-modal"><a class="section fa fa-instagram" target="_blank"
                                href="https://www.instagram.com/alcaldiaacacias" title="Instagram">
                                <strong class="list_enlace_text"> @alcaldiaacacias</strong>
                            </a>
                        </span>
                    </div>
                    <div class="col-md-3">
                        <span class="icon govco-facebook-square"></span>
                        <span class="govco-link-modal"><a class="section fa fa-facebook" target="_blank"
                                href="https://www.facebook.com/AlcaldiaAcaciasMeta/" title="">
                                <strong class="list_enlace_text"> @AlcaldiaAcaciasMeta</strong>
                            </a>
                        </span>
                    </div>
                </div>

                <div class="row govco-links-container">
                    <div class="govco-link-container mt-2">
                        <a class="govco-link-modal govco-link-modal-bold" href="https://acacias.gov.co/publicaciones/6412/certificado-de-residencia/9467">Políticas</a>
                        <a class="govco-link-modal govco-link-modal-bold" href="https://acacias.gov.co/mapa-del-sitio">Mapa del sitio</a>
                        <a class="govco-link-modal govco-link-modal-bold" href="https://acacias.gov.co/formularios/108">Califica nuestra sede electrónica</a> <br>
                    </div>
                </div>
            </div>
        </div>

        <div class="govco-footer-logo">
            <div class="govco-logo-container">
                <span class="govco-co"></span>
                <span class="govco-separator"></span>
                <span class="govco-logo"></span>
            </div>
        </div>
    </div>

    <!-- js bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- utils.js BDC -->
    <script src="https://cdn.www.gov.co/layout/v4/script.js"></script>

    {{-- Area de accesibilidad --}}
    <script>
        document.addEventListener("keyup", detectTabKey);

        function detectTabKey(e) {
            if (e.keyCode == 9) {
                if (document.getElementById("botoncontraste").classList.contains("active-barra-accesibilidad-govco")) {
                    document.getElementById("botoncontraste").classList.toggle("active-barra-accesibilidad-govco");
                }
                if (document.getElementById("botonaumentar").classList.contains("active-barra-accesibilidad-govco")) {
                    document.getElementById("botonaumentar").classList.toggle("active-barra-accesibilidad-govco");
                }
                if (document.getElementById("botondisminuir").classList.contains("active-barra-accesibilidad-govco")) {
                    document.getElementById("botondisminuir").classList.toggle("active-barra-accesibilidad-govco");
                }
            }
        }

        function cambiarContexto() {

            var botoncontraste = document.getElementById("botoncontraste");
            var botonaumentar = document.getElementById("botonaumentar");
            var botondisminuir = document.getElementById("botondisminuir");

            if (!botoncontraste.classList.contains("active-barra-accesibilidad-govco")) {
                botoncontraste.classList.toggle("active-barra-accesibilidad-govco");
                document.getElementById("titleaumentar").style.display = "";
                document.getElementById("titledisminuir").style.display = "";
                document.getElementById("titlecontraste").style.display = "none";
            }
            if (botondisminuir.classList.contains("active-barra-accesibilidad-govco")) {
                botondisminuir.classList.remove("active-barra-accesibilidad-govco");
            }
            if (botonaumentar.classList.contains("active-barra-accesibilidad-govco")) {
                botonaumentar.classList.remove("active-barra-accesibilidad-govco");
            }

            var element = document.getElementById('para-mirar');
            if (element.className == 'modo_oscuro-govco') {
                var element = document.getElementById('para-mirar');
                element.className = "modo_claro-govco";
            } else {
                var element = document.getElementById('para-mirar');
                element.className = "modo_oscuro-govco";
            }
        }

        function disminuirTamanio(operador) {

            var botoncontraste = document.getElementById("botoncontraste");
            var botonaumentar = document.getElementById("botonaumentar");
            var botondisminuir = document.getElementById("botondisminuir");

            if (!botondisminuir.classList.contains("active-barra-accesibilidad-govco")) {
                botondisminuir.classList.toggle("active-barra-accesibilidad-govco");
                document.getElementById("titleaumentar").style.display = "";
                document.getElementById("titledisminuir").style.display = "none";
                document.getElementById("titlecontraste").style.display = "";
            }
            if (botonaumentar.classList.contains("active-barra-accesibilidad-govco")) {
                botonaumentar.classList.remove("active-barra-accesibilidad-govco");
            }
            if (botoncontraste.classList.contains("active-barra-accesibilidad-govco")) {
                botoncontraste.classList.remove("active-barra-accesibilidad-govco");
            }

            var div1 = document.getElementById("para-mirar")
            var texto = div1.getElementsByTagName("p");
            for (let element of texto) {
                const total = tamanioElemento(element);
                const nuevoTamanio = (operador === 'aumentar' ? (total + 1) : (total - 1)) + 'px';
                element.style.fontSize = nuevoTamanio
            }
        }

        function aumentarTamanio(operador) {

            var botoncontraste = document.getElementById("botoncontraste");
            var botonaumentar = document.getElementById("botonaumentar");
            var botondisminuir = document.getElementById("botondisminuir");

            if (!botonaumentar.classList.contains("active-barra-accesibilidad-govco")) {
                botonaumentar.classList.toggle("active-barra-accesibilidad-govco");
                document.getElementById("titleaumentar").style.display = "none";
                document.getElementById("titledisminuir").style.display = "";
                document.getElementById("titlecontraste").style.display = "";
            }
            if (botondisminuir.classList.contains("active-barra-accesibilidad-govco")) {
                botondisminuir.classList.remove("active-barra-accesibilidad-govco");
            }
            if (botoncontraste.classList.contains("active-barra-accesibilidad-govco")) {
                botoncontraste.classList.remove("active-barra-accesibilidad-govco");
            }

            var div1 = document.getElementById("para-mirar")
            var texto = div1.getElementsByTagName("p");
            for (let element of texto) {
                const total = tamanioElemento(element);
                if (total <= 64) {
                    const nuevoTamanio = (operador === 'aumentar' ? (total + 1) : (total - 1)) + 'px';
                    element.style.fontSize = nuevoTamanio
                }
            }
        }

        function tamanioElemento(element) {
            const tamanioParrafo = window.getComputedStyle(element, null).getPropertyValue('font-size');
            return parseFloat(tamanioParrafo);
        }
    </script>
    {{-- Area de servicio --}}
    <script>
        function selectedOption(activeItem, disabledItem) {
            const options = document.querySelectorAll('.aservice-item-govco');
            options.forEach((element) => {
                element.classList.remove('selected');
                element.classList.remove('disabled');
            });
            document.getElementById(activeItem).classList.add('selected');
            document.getElementById(disabledItem).classList.add('disabled');
            document
                .getElementById('alerta-service')
                .setAttribute('style', 'display: block');
            document
                .getElementById('comentarios1-button')
                .setAttribute('style', 'display: block');
            options.forEach((element) => {
                element.setAttribute('tabindex', '-1');
            });
        }

        function verComentarios() {
            const options = document.querySelectorAll('.aservice-item-govco');
            options.forEach((element) => {
                element.classList.add('disabled');
            });
            document
                .getElementById('alerta-service')
                .setAttribute('style', 'display: none');
            document
                .getElementById('comentarios1-button')
                .setAttribute('style', 'display: none');
            document
                .getElementById('aservice-comentarios')
                .setAttribute('style', 'display: block');
            document
                .getElementById('comentarios2-button')
                .setAttribute('style', 'display: block');
            document.getElementById('aservice-comentarios-textarea').focus();
            document.getElementById('aservice-comentarios-textarea').value = '';
        }

        function contadorTextArea() {
            document.getElementById('aservice-comentarios-textarea').onkeyup = (e) => {
                if (e.target.value.length >= 10) {
                    document
                        .getElementById('aservice-comentarios-textarea')
                        .classList.remove('errorTextArea');
                    document
                        .getElementById('aservice-comentarios-textarea')
                        .classList.add('successTextArea');
                    document
                        .getElementById('aservice-comentarios-alert')
                        .setAttribute('style', 'display: none');
                    document
                        .getElementById('comentarios2-button-item')
                        .removeAttribute('disabled');
                } else if (e.target.value.length == 0) {
                    document
                        .getElementById('aservice-comentarios-textarea')
                        .classList.remove('errorTextArea');
                    document
                        .getElementById('aservice-comentarios-alert')
                        .setAttribute('style', 'display: none');
                    document
                        .getElementById('aservice-comentarios-textarea')
                        .classList.remove('successTextArea');
                    document
                        .getElementById('comentarios2-button-item')
                        .setAttribute('disabled', 'true');
                } else {
                    document
                        .getElementById('aservice-comentarios-textarea')
                        .classList.remove('successTextArea');
                    document
                        .getElementById('aservice-comentarios-textarea')
                        .classList.add('errorTextArea');
                    document
                        .getElementById('aservice-comentarios-alert')
                        .setAttribute('style', 'display: block');
                    document
                        .getElementById('comentarios2-button-item')
                        .setAttribute('disabled', 'true');
                }
            };
        }

        function enviarComentarios() {
            document
                .getElementById('aservice-comentarios')
                .setAttribute('style', 'display: none');
            document
                .getElementById('comentarios2-button')
                .setAttribute('style', 'display: none');
            document
                .getElementById('alerta-service')
                .setAttribute('style', 'display: block');
            document
                .getElementById('alerta-service')
                .setAttribute('style', 'margin-bottom: 0px !important;');
        }
    </script>
    {{-- saltar pasos --}}
    <script>
        function irAlPaso(numeroPaso) {
            const elementParent = document.querySelector('#lineaAvance1');
            const headers = elementParent.querySelectorAll('.header-linea-avance-govco');
            const bodys = elementParent.querySelectorAll('.body-linea-avance-govco');

            if (numeroPaso < 1 || numeroPaso > headers.length) return;

            headers.forEach(h => h.classList.remove('active-linea-avance-govco', 'inactive-linea-avance-govco'));
            bodys.forEach(b => b.classList.remove('active-linea-avance-govco'));

            headers[numeroPaso - 1].classList.add('active-linea-avance-govco');
            bodys[numeroPaso - 1].classList.add('active-linea-avance-govco');

            updateProgressAdvanceLine(headers, numeroPaso - 1, elementParent, 'width');
            actualizarMiga();
        }
    </script>
    {{-- Linea de avance --}}
    <script>
        // === CONFIGURACIÓN INICIAL ===
        document.addEventListener('DOMContentLoaded', function() {
            actualizarMiga();
        });

        // Guardamos la referencia original del CDN
        const originalNextItemAdvance = nextItemAdvanceLineHorizontal;

        // === SOBRESCRIBIMOS EL AVANCE NORMAL ===
        nextItemAdvanceLineHorizontal = function(e) {
            originalNextItemAdvance.call(this, e);
            setTimeout(() => actualizarMiga(), 100);
        };

        // === ACTUALIZAR MIGA DE PAN ===
        function actualizarMiga() {
            const pasoActivo = document.querySelector(
                '.header-linea-avance-govco.active-linea-avance-govco .title-linea-avance-govco');
            const textoPaso = pasoActivo ? pasoActivo.textContent.trim() : 'Inicio';
            const miga1 = document.getElementById('miga-dinamica-1');
            const migaActual = document.getElementById('miga-actual');

            let textoAnterior = '';
            let textoActual = '';
            let pasoNumero = 1;

            switch (textoPaso) {
                case 'Inicio':
                    textoAnterior = 'Inicio';
                    textoActual = 'Inicio del proceso';
                    pasoNumero = 1;
                    break;
                case 'Hago mi solicitud':
                    textoAnterior = 'Trámite';
                    textoActual = 'Hago mi solicitud';
                    pasoNumero = 2;
                    break;
                case 'Procesan mi solicitud':
                    textoAnterior = 'Proceso';
                    textoActual = 'Procesan mi solicitud';
                    pasoNumero = 3;
                    break;
                case 'Respuesta':
                    textoAnterior = 'Resultado';
                    textoActual = 'Respuesta final';
                    pasoNumero = 4;
                    break;
                default:
                    textoAnterior = 'Inicio';
                    textoActual = 'Sección actual';
            }

            // Actualiza contenido y agrega data-step para navegación
            miga1.innerHTML = `<a href="#" data-step="${pasoNumero - 1}">${textoAnterior}</a>`;
            migaActual.innerHTML = `<a href="#" data-step="${pasoNumero}">${textoActual}</a>`;

            // Asigna eventos de clic a ambas migas
            asignarEventosMiga();
        }
    </script>
    {{-- asignarEventosMiga --}}
    <script>
        function asignarEventosMiga() {
            document.querySelectorAll('#breadcrumb-govco a[data-step]').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const paso = parseInt(this.dataset.step);
                    if (!isNaN(paso) && paso >= 1) irAlPaso(paso);
                });
            });
        }
    </script>

    @livewireScripts
</body>

</html>
