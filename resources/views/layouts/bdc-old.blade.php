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

        .btn-modal-govco {
            width: auto;
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
                    <div class="col-md-4">
                        <span class="icon govco-twitter-square"></span>
                        <span class="govco-link-modal"><a class="section fa fa-twitter" target="_blank"
                                href="https://twitter.com/AlcaldiaAcacias" title="">
                                <strong class="list_enlace_text"> @alcaldiaacacias</strong>
                            </a>
                        </span>
                    </div>
                    <div class="col-md-4">
                        <span class="icon govco-instagram-square"></span>
                        <span class="govco-link-modal"><a class="section fa fa-instagram" target="_blank"
                                href="https://www.instagram.com/alcaldiaacacias" title="Instagram">
                                <strong class="list_enlace_text"> @alcaldiaacacias</strong>
                            </a>
                        </span>
                    </div>
                    <div class="col-md-4">
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
                        <a class="govco-link-modal govco-link-modal-bold"
                            href="https://acacias.gov.co/publicaciones/6412/certificado-de-residencia/9467">Políticas</a>
                        <a class="govco-link-modal govco-link-modal-bold"
                            href="https://acacias.gov.co/mapa-del-sitio">Mapa del sitio</a>
                        <a class="govco-link-modal govco-link-modal-bold"
                            href="https://acacias.gov.co/formularios/108">Califica nuestra sede electrónica</a> <br>
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
        /* ================================
                           VARIABLES DE CONTROL
                        ================================ */
        let pasosPermitidos = [1];
        let pasosVisitados = [1];

        /* ================================
           NAVEGACIÓN ENTRE PASOS
        ================================ */
        function irAlPaso(numeroPaso) {
            if (!pasosPermitidos.includes(numeroPaso)) {
                console.warn(`Intento de acceso no permitido al paso ${numeroPaso}`);
                return;
            }

            const elementParent = document.querySelector('#lineaAvance1');
            const headers = elementParent.querySelectorAll('.header-linea-avance-govco');
            const bodys = elementParent.querySelectorAll('.body-linea-avance-govco');

            const backdrop = document.getElementById('modal_backdrop_govco');
            if (backdrop) backdrop.remove();
            document.body.style.overflow = '';

            headers.forEach(h => h.classList.remove('active-linea-avance-govco'));
            bodys.forEach(b => b.classList.remove('active-linea-avance-govco'));
            headers[numeroPaso - 1].classList.add('active-linea-avance-govco');
            bodys[numeroPaso - 1].classList.add('active-linea-avance-govco');

            updateProgressAdvanceLine(headers, numeroPaso - 1, elementParent, 'width');

            // Si retrocede, cortamos pasosVisitados a ese punto
            const indexPaso = pasosVisitados.indexOf(numeroPaso);
            if (indexPaso !== -1) {
                pasosVisitados = pasosVisitados.slice(0, indexPaso + 1);
            }

            // 🔹 NUEVO: aseguramos que el paso esté marcado como visitado
            if (!pasosVisitados.includes(numeroPaso)) pasosVisitados.push(numeroPaso);

            console.log(`✅ Cambiado al paso ${numeroPaso}`);

            actualizarMiga();
        }


        /* ================================
           MIGA DE PAN DINÁMICA
        ================================ */
        function actualizarMiga() {
            const migaContainer = document.getElementById('breadcrumb-govco');
            if (!migaContainer) return;
            migaContainer.innerHTML = '';

            // 🟦 1. Siempre agregar "Inicio"
            const liInicio = document.createElement('li');
            liInicio.className = 'breadcrumb-item-govco';
            liInicio.innerHTML = `<a href="#" data-step="1">Inicio</a>`;
            migaContainer.appendChild(liInicio);

            // 🟦 2. Determinar paso actual y anterior
            const pasoActual = pasosVisitados[pasosVisitados.length - 1];
            const pasoAnterior = pasosVisitados.length > 1 ?
                pasosVisitados[pasosVisitados.length - 2] :
                1;

            // 🟦 3. Agregar paso anterior (si existe y no es igual al actual)
            if (pasoAnterior && pasoAnterior !== pasoActual) {
                const liPrevio = document.createElement('li');
                liPrevio.className = 'breadcrumb-item-govco';
                liPrevio.innerHTML = `<a href="#" data-step="${pasoAnterior}">${obtenerTituloPaso(pasoAnterior)}</a>`;
                migaContainer.appendChild(liPrevio);
            }

            // 🟦 4. Agregar paso actual
            if (pasoActual) {
                const liActual = document.createElement('li');
                liActual.className = 'breadcrumb-item-govco active';
                liActual.setAttribute('aria-current', 'page');
                liActual.textContent = obtenerTituloPaso(pasoActual);
                migaContainer.appendChild(liActual);
            }

            asignarEventosMiga();
        }



        /* ================================
           REASIGNAR EVENTOS DE CLIC
        ================================ */
        function asignarEventosMiga() {
            // Limpiar eventos previos
            const oldLinks = document.querySelectorAll('#breadcrumb-govco a[data-step]');
            oldLinks.forEach(link => {
                const newLink = link.cloneNode(true);
                link.parentNode.replaceChild(newLink, link);
            });

            // Reasignar eventos de clic
            document.querySelectorAll('#breadcrumb-govco a[data-step]').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const paso = parseInt(this.dataset.step);
                    if (pasosPermitidos.includes(paso)) {
                        irAlPaso(paso);
                    } else {
                        console.warn(`Intento de acceso no permitido al paso ${paso}`);
                    }
                });
            });
        }

        /* ================================
           OBTENER TÍTULO DEL PASO
        ================================ */
        function obtenerTituloPaso(paso) {
            switch (paso) {
                case 1:
                    return 'Inicio';
                case 2:
                    return 'Hago mi solicitud';
                case 3:
                    return 'Procesan mi solicitud';
                case 4:
                    return 'Respuesta';
                default:
                    return 'Paso';
            }
        }

        /* ================================
           VALIDAR PASO 2 (lógica principal)
        ================================ */
        async function validarYAvanzar(e) {
            try {
                const response = await fetch('/verificar-permiso-paso2', {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                const data = await response.json();

                if (data.permitido) {
                    pasosPermitidos = [1, 2, 3, 4];
                    pasosVisitados = [1, 2];
                    irAlPaso(2);
                } else {
                    pasosPermitidos = [1, 4];
                    pasosVisitados = [1, 4];
                    irAlPaso(4);
                }

            } catch (error) {
                console.error('Error al verificar permiso:', error);
            }
        }

        /* ================================
           EVENTO DE INICIO
        ================================ */
        document.addEventListener('DOMContentLoaded', function() {
            actualizarMiga();
        });
    </script>
    @livewireScripts
</body>

</html>
