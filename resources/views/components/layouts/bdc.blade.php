<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Certificado de Residencia')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <!-- css bootstrap --> --}}

    {{-- <!-- jQuery (requerido para Select2) --> --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" rel="stylesheet"
        crossorigin="anonymous">

    {{-- <!-- css BDC --> --}}
    <link href="https://cdn.www.gov.co/layout/v4/all.css" rel="stylesheet">

    {{-- <!-- Select2 CSS --> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    {{-- <!-- Select2 JS --> --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- <!-- Select2 Español (opcional pero recomendado) --> --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/i18n/es.js"></script>

    {{-- Leaflet --}}
    <!-- Leaflet CSS (si no lo tienes en el layout) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <!-- Leaflet JS (si no lo tienes en el layout) -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

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

        .select2-container--default .select2-selection--single {
            height: 38px;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 36px;
            color: #495057;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }



        /* Fix para que Leaflet cargue correctamente */
        .leaflet-container {
            height: 100%;
            width: 100%;
        }



        @media (min-width: 1280px) {

            /* .govco-data-front {
    margin: 30px auto !important;
    width: 60%;
    -webkit-box-shadow: 300px 60px 0px -30px #07892f, -300px 60px 0px -30px #07892f, 0px 25px 0px 0px #e6effd, 120px
    70px 0px -40px #e6effd, -120px 70px 0px -40px #e6effd;
    } */
        }
    </style>
    @livewireStyles
</head>

<body>
    {{-- <!-- Barra Superior --> --}}
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

            // hacer scroll al inicio de la línea de avance
            elementParent.scrollIntoView({
                behavior: 'smooth'
            });

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
    {{-- select --}}
    <script>
        $(document).ready(function() {
            $('#id_barrio').select2({
                allowClear: true,
                language: 'es',
                width: '100%'
            });
        });
    </script>
    {{-- mapa --}}
    <script>
        var map;
        var marker;
        var mapInitialized = false;

        function initMap() {
            if (mapInitialized) {
                map.invalidateSize();
                return;
            }

            map = L.map('map').setView([3.988604, -73.767509], 13);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.nomaddi.com">Nomaddi</a> 2025'
            }).addTo(map);

            setTimeout(function() {
                map.invalidateSize();
            }, 100);

            // Cargar coordenadas previas si existen
            var oldLat = document.getElementById('lat').value;
            var oldLng = document.getElementById('lng').value;

            if (oldLat && oldLng) {
                marker = L.marker([oldLat, oldLng])
                    .addTo(map)
                    .bindPopup('📍 Ubicación seleccionada')
                    .openPopup();
                map.setView([oldLat, oldLng], 15);
            }

            map.on('click', function(e) {
                const lat = e.latlng.lat.toFixed(6);
                const lng = e.latlng.lng.toFixed(6);

                if (marker) {
                    marker.setLatLng(e.latlng);
                } else {
                    marker = L.marker(e.latlng)
                        .addTo(map)
                        .bindPopup('📍 Ubicación seleccionada')
                        .openPopup();
                }

                document.getElementById('lat').value = lat;
                document.getElementById('lng').value = lng;
                document.getElementById('display-lat').textContent = lat;
                document.getElementById('display-lng').textContent = lng;
            });

            mapInitialized = true;
        }
    </script>

    {{-- formulario del paso 2 --}}
    {{-- inputs files --}}
    <script>
        // Mostrar nombre del archivo seleccionado
        const inputs = ['Electoral', 'Sisben', 'JAC'];
        inputs.forEach(id => {
            const input = document.getElementById('file' + id);
            const label = document.getElementById('name' + id);
            input.addEventListener('change', function() {
                if (this.files && this.files.length > 0) {
                    label.textContent = this.files[0].name;
                    label.classList.remove('text-secondary');
                    label.classList.add('text-success');
                } else {
                    label.textContent = 'No seleccionado';
                    label.classList.remove('text-success');
                    label.classList.add('text-secondary');
                }
            });
        });
    </script>
    <script>
        // Configurar validaciones GOVCO para los inputs file
        window.addEventListener('load', function() {
            // Configurar para cédula: PDF/JPG hasta 10MB
            setValidationParameters('fotocopia_cedula', ['pdf', 'jpg', 'jpeg', 'png'], 10485760, 1);

            // Configurar para recibo: PDF/JPG hasta 10MB
            setValidationParameters('recibo_servicios', ['pdf', 'jpg', 'jpeg', 'png'], 10485760, 1);
        });

        // 🔧 FUNCIONES AUXILIARES (agregar al final del script)

        /**
         * Limpia completamente un input file de GOVCO
         */
        function limpiarInputGovco(inputId) {
            const input = document.getElementById(inputId);
            if (!input) return;

            // Limpiar el input file
            input.value = '';

            // Limpiar attachmentList
            if (window.attachmentList && window.attachmentList[inputId]) {
                window.attachmentList[inputId] = [];
            }

            // Limpiar selectedFiles
            if (window.selectedFiles && window.selectedFiles[inputId]) {
                window.selectedFiles[inputId] = [];
            }

            // Limpiar el nombre del archivo mostrado
            const parent = input.parentNode;
            const fileNameSpan = parent.querySelector('.file-name-carga-de-archivo-govco');
            if (fileNameSpan) {
                fileNameSpan.textContent = 'Ningún archivo seleccionado';
            }

            // Limpiar archivos adjuntos visibles
            const containerParent = input.closest('.container-carga-de-archivo-govco');
            if (containerParent) {
                const attachedContainer = containerParent.querySelector('.attached-files-carga-de-archivo-govco');
                if (attachedContainer) {
                    attachedContainer.innerHTML = '';
                }

                const detailContainer = containerParent.querySelector('.container-detail-carga-de-archivo-govco');
                if (detailContainer) {
                    detailContainer.style.display = 'none';
                }
            }

            // Deshabilitar botón de carga
            const button = containerParent?.querySelector('.button-loader-carga-de-archivo-govco');
            if (button) {
                button.disabled = true;
            }

            // Limpiar errores
            input.setAttribute('data-error', '0');
            const alertSpan = containerParent?.querySelector('.alert-carga-de-archivo-govco');
            if (alertSpan) {
                alertSpan.classList.add('visually-hidden');
                alertSpan.textContent = '';
            }
        }

        /**
         * Limpia archivos opcionales (que no usan GOVCO)
         */
        function limpiarArchivoOpcional(inputId, spanId) {
            const input = document.getElementById(inputId);
            const span = document.getElementById(spanId);

            if (input) {
                input.value = '';
            }

            if (span) {
                span.textContent = 'No seleccionado';
                span.classList.remove('text-success');
                span.classList.add('text-secondary');
            }
        }
        // Script completo con manejo de archivos GOVCO
        document.getElementById('solicitudForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);

            // Limpiar alertas y errores previos
            document.querySelectorAll('.container-alerta-govco').forEach(a => a.remove());
            document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            document.querySelectorAll('.invalid-feedback').forEach(el => el.remove());

            // ✅ SOLUCIÓN: Agregar archivos desde attachmentList de GOVCO
            const govInputs = [{
                    id: 'fotocopia_cedula',
                    name: 'cedula'
                },
                {
                    id: 'recibo_servicios',
                    name: 'recibo'
                }
            ];

            govInputs.forEach(({
                id,
                name
            }) => {
                // Acceder a los archivos almacenados por el componente GOVCO
                if (window.attachmentList && window.attachmentList[id] && window.attachmentList[id]
                    .length > 0) {
                    // Agregar el primer archivo de la lista
                    formData.append(name, window.attachmentList[id][0]);
                    console.log(`✅ Archivo ${name} agregado:`, window.attachmentList[id][0].name);
                } else {
                    console.warn(`⚠️ No hay archivos en attachmentList para ${id}`);
                }
            });

            // 🔍 DEBUG: Ver contenido del FormData
            console.log('=== Contenido del FormData ===');
            for (let [key, value] of formData.entries()) {
                if (value instanceof File) {
                    console.log(`${key}: ${value.name} (${value.size} bytes)`);
                } else {
                    console.log(`${key}: ${value}`);
                }
            }

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    if (response.status === 422) {
                        const errorData = await response.json();

                        // Mostrar errores específicos en cada campo
                        Object.keys(errorData.errors).forEach(field => {
                            const messages = errorData.errors[field];
                            highlightFieldError(field, messages[0]);
                        });

                        // Alerta general
                        showGovcoAlert('error', 'Por favor corrige los errores marcados en el formulario.');

                        // Scroll al primer error
                        const firstError = document.querySelector('.is-invalid');
                        if (firstError) {
                            firstError.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });
                        }
                        return;
                    } else {
                        throw new Error('Error inesperado (' + response.status + ')');
                    }
                }

                const result = await response.json();

                if (result.status === 'success') {
                    showGovcoAlert('success', result.message, result.link);

                    // 1️⃣ Reset básico del formulario
                    form.reset();

                    // 2️⃣ Limpiar archivos GOVCO (obligatorios)
                    limpiarInputGovco('fotocopia_cedula');
                    limpiarInputGovco('recibo_servicios');

                    // 3️⃣ Limpiar archivos opcionales
                    limpiarArchivoOpcional('fileElectoral', 'nameElectoral');
                    limpiarArchivoOpcional('fileSisben', 'nameSisben');
                    limpiarArchivoOpcional('fileJAC', 'nameJAC');

                    // 4️⃣ Limpiar coordenadas del mapa
                    document.getElementById('lat').value = '';
                    document.getElementById('lng').value = '';
                    document.getElementById('display-lat').textContent = 'No seleccionada';
                    document.getElementById('display-lng').textContent = 'No seleccionada';

                    // 5️⃣ Limpiar select2 (si lo usas para barrio)
                    const selectBarrio = document.getElementById('id_barrio');
                    if (selectBarrio) {
                        selectBarrio.value = '';
                        // Si usas Select2, también debes limpiarlo así:
                        if (typeof $(selectBarrio).select2 !== 'undefined') {
                            $(selectBarrio).val('').trigger('change');
                        }
                    }


                    // 🎯 PASAR AUTOMÁTICAMENTE AL PASO 3
                    // 2️⃣ Ir al paso 3
                    if (typeof pasosPermitidos !== 'undefined' && typeof irAlPaso !== 'undefined') {
                        pasosPermitidos = [1, 2, 3];
                        irAlPaso(3);
                    }

                } else if (result.status === 'info') {
                    showGovcoAlert('info', result.message, result.link);
                } else {
                    showGovcoAlert('error', result.message);
                }

            } catch (error) {
                console.error(error);
                showGovcoAlert('error', 'Ocurrió un error inesperado al enviar la solicitud.');
            }
        });

        // Función para resaltar campos con error
        function highlightFieldError(fieldName, errorMessage) {
            const fieldMap = {
                'cedula': 'fotocopia_cedula',
                'recibo': 'recibo_servicios',
                'id_barrio': 'id_barrio',
                'direccion': 'direccion',
                'terminos': 'acepto_terminos'
            };

            const fieldId = fieldMap[fieldName] || fieldName;
            const input = document.getElementById(fieldId) || document.querySelector(`[name="${fieldName}"]`);

            if (!input) return;

            input.classList.add('is-invalid');

            if (input.type === 'file') {
                const container = input.closest('.container-carga-de-archivo-govco');
                if (container) {
                    container.style.borderLeft = '4px solid #dc3545';
                    container.style.backgroundColor = '#fff5f5';
                }
            }

            const errorDiv = document.createElement('div');
            errorDiv.classList.add('invalid-feedback', 'd-block');
            errorDiv.innerHTML = `<strong>⚠️ ${errorMessage}</strong>`;

            if (input.type === 'file') {
                const container = input.closest('.container-carga-de-archivo-govco');
                if (container) {
                    container.appendChild(errorDiv);
                }
            } else if (input.type === 'checkbox') {
                input.parentElement.appendChild(errorDiv);
            } else {
                const parent = input.closest('.container-input-texto-govco') || input.parentElement;
                parent.appendChild(errorDiv);
            }
        }

        // Función para mostrar alertas GOVCO
        function showGovcoAlert(type, message, link = null) {
            const icons = {
                success: 'alerta-icon-success-govco asuccess',
                error: 'alerta-icon-error-govco aerror',
                info: 'alerta-icon-notificacion-govco anotificacion'
            };

            const classes = {
                success: 'alerta-success-govco asuccess',
                error: 'alerta-error-govco aerror',
                info: 'anotificacion'
            };

            const alertDiv = document.createElement('div');
            alertDiv.classList.add('container-alerta-govco');
            alertDiv.style.position = 'fixed';
            alertDiv.style.top = '20px';
            alertDiv.style.right = '20px';
            alertDiv.style.zIndex = '9999';
            alertDiv.style.maxWidth = '500px';

            alertDiv.innerHTML = `
        <div class="alert alerta-govco ${classes[type]}" role="alert">
            <span class="alerta-icon-govco ${icons[type]}"></span>
            <p class="alerta-content-text">
                ${message}
                ${link ? `<br><a href="${link}" class="alert-link alerta-link ${classes[type]}">Ver mis solicitudes</a>` : ''}
            </p>
            <button type="button" class="btn-close" onclick="this.closest('.container-alerta-govco').remove()"></button>
        </div>
    `;

            document.body.prepend(alertDiv);

            setTimeout(() => {
                if (alertDiv.parentElement) {
                    alertDiv.remove();
                }
            }, 8000);
        }

        // Limpiar errores al interactuar con los campos
        document.querySelectorAll('input, select, textarea').forEach(input => {
            input.addEventListener('change', function() {
                this.classList.remove('is-invalid');
                const feedback = this.parentElement.querySelector('.invalid-feedback');
                if (feedback) feedback.remove();

                const container = this.closest('.container-carga-de-archivo-govco');
                if (container) {
                    container.style.borderLeft = '';
                    container.style.backgroundColor = '';
                }
            });
        });
    </script>
    @yield('scripts')
    @livewireScripts
</body>

</html>
