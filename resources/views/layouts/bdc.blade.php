<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Certificado de Residencia')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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


        .inicio-sesion-govco .container-login-opcion-govco {
            height: auto;
        }

        .container-example-linea-avance-govco {
            margin: 1.5rem auto;
        }

        .barra-accesibilidad-govco {
            z-index: 999;
        }


        @media (min-width: 1280px) {

            .govco-data-front {
                margin: 30px auto !important;
                width: 60%;
                -webkit-box-shadow: 300px 40px 0px -40px #e6effd, -300px 40px 0px -40px #e6effd, 0px 25px 0px 0px #e6effd, 120px 70px 0px -40px #e6effd, -120px 70px 0px -40px #e6effd;
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
                        <p class="govco-text-header-1">Nombre completo de la Sede electrónica</p>
                    </div>
                    <div class="col-xs-12 col-lg-4 govco-logo-div-a">
                        <span class="govco-logo-entidad"></span>
                    </div>
                </div>

                <div class="row col-xs-12 col-lg-7 govco-texto-sedes">
                    <p class="govco-text-header-2">Sede principal</p>
                    Dirección: xxxxxx xxx xxx <br class="govco-mostrar">
                    Departamento y municipio. <br>
                    Código Postal: xxxx <br>
                    Horario de atención: Lunes a viernes xx:xx a.m. - xx:xx p.m. <br>
                    Teléfono conmutador: +57(xx) xxx xx xx <br>
                    Línea gratuita: +57(xx) xxx xx xx <br>
                    Línea anticorrupción: +57(xx) xxx xx xx <br>
                    Correo institucional: <br class="govco-mostrar">
                    ministerio@ministerio.gov.co <br>
                    Correo de notificaciones judiciales: <br class="govco-mostrar">
                    judiciales@gov.co
                </div>

                <div class="row col-xs-12 col-lg-7 govco-network">
                    <div class="govco-iconContainer">
                        <span class="icon govco-twitter-square"></span>
                        <span class="govco-link-modal">@Entidad</span>
                    </div>
                    <div class="govco-iconContainer">
                        <span class="icon govco-instagram-square"></span>
                        <span class="govco-link-modal">@Entidad</span>
                    </div>
                    <div class="govco-iconContainer">
                        <span class="icon govco-facebook-square"></span>
                        <span class="govco-link-modal">@Entidad</span>
                    </div>
                </div>

                <div class="row govco-links-directorio">
                    <a class="govco-link-modal" href="#">Directorio Institucional</a>
                </div>

                <div class="row govco-links-container">
                    <div class="govco-link-container mt-2">
                        <a class="govco-link-modal govco-link-modal-bold" href="#">Políticas</a>
                        <a class="govco-link-modal govco-link-modal-bold" href="#">Mapa del sitio</a>
                    </div>
                    <div class="govco-link-container mt-2">
                        <a class="govco-link-modal govco-link-modal-bold" href="#">Términos y condiciones</a> <br>
                    </div>
                    <div class="govco-link-container mt-2">
                        <a class="govco-link-modal govco-link-modal-bold" href="#">Accesibilidad</a>
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
    {{-- Area de login --}}
    <script>
        /**
         * Gov.co (https://www.gov.co) - Gobierno de Colombia
         *  - Componente: Login Simplificado
         *  - Version: 4.0.0 - Modificado
         */
        window.addEventListener("load", function(event) {
            initLogin();
        });

        function initLogin() {
            // Inicializar validación de correo
            const inputCorreo = document.querySelector('input[typeData="mail"]');
            if (inputCorreo) {
                inputCorreo.addEventListener("keyup", activeInputCorreo);
            }

            // Inicializar funcionalidad de contraseña (mostrar/ocultar)
            initPasswordToggle();

            // Inicializar validación del botón continuar
            initButtonValidation();
        }

        /* -------------------------------- Validación de Correo --------------------------------------- */
        function activeInputCorreo() {
            const expresionRegularE = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            const textExito = "Correo electrónico válido";
            const textError = "Correo electrónico no válido";
            let countWord = this.value.length;

            if (countWord == 0) {
                this.classList.remove('success');
                this.classList.remove('error');
                removeAlertMessage(this);
            } else {
                if (expresionRegularE.test(this.value)) {
                    this.classList.remove('error');
                    this.classList.add('success');
                    crearMensaje(this, textExito, 'success');
                } else {
                    this.classList.remove('success');
                    this.classList.add('error');
                    crearMensaje(this, textError, 'error');
                }
            }

            // Validar estado del botón
            validateButtonState();
        }

        /* -------------------------------- Funcionalidad Contraseña --------------------------------------- */
        function initPasswordToggle() {
            const btnShowPassword = document.querySelector('.eye-slash-entradas-de-texto-govco');
            const btnHidePassword = document.querySelector('.eye-entradas-de-texto-govco');
            const inputPassword = document.querySelector('input[typeData="password"]');

            if (btnShowPassword && btnHidePassword && inputPassword) {
                // Mostrar contraseña
                btnShowPassword.addEventListener('click', function(e) {
                    e.preventDefault();
                    inputPassword.type = 'text';
                    this.classList.add('none');
                    btnHidePassword.classList.remove('none');
                });

                // Ocultar contraseña
                btnHidePassword.addEventListener('click', function(e) {
                    e.preventDefault();
                    inputPassword.type = 'password';
                    this.classList.add('none');
                    btnShowPassword.classList.remove('none');
                });

                // Validar al escribir (opcional - validación básica de longitud)
                inputPassword.addEventListener('keyup', function() {
                    validateButtonState();
                });
            }
        }

        /* -------------------------------- Validación del Botón Continuar --------------------------------------- */
        function initButtonValidation() {
            const btnContinuar = document.querySelector('button[name="continuar"]');
            if (btnContinuar) {
                // Deshabilitar inicialmente
                btnContinuar.disabled = true;
            }
        }

        function validateButtonState() {
            const inputCorreo = document.querySelector('input[typeData="mail"]');
            const inputPassword = document.querySelector('input[typeData="password"]');
            const btnContinuar = document.querySelector('button[name="continuar"]');

            if (inputCorreo && inputPassword && btnContinuar) {
                // Habilitar solo si el correo es válido y la contraseña tiene al menos 8 caracteres
                const correoValido = inputCorreo.classList.contains('success');
                const passwordValida = inputPassword.value.length >= 8;

                btnContinuar.disabled = !(correoValido && passwordValida);
            }
        }

        /* -------------------------------- Mensajes de Validación --------------------------------------- */
        function crearMensaje(input, text, type) {
            const dataMensajes = {
                'success': {
                    'id': 'campoSuccess-correo',
                    'aria-invalid': 'false',
                    'class': 'success-texto-govco',
                    'role': 'status',
                    'aria-live': 'polite',
                },
                'error': {
                    'id': 'campoWarning-correo',
                    'aria-invalid': 'true',
                    'class': 'error-texto-govco',
                    'role': 'alert',
                    'aria-live': 'assertive',
                }
            };

            const parentInput = input.closest('.entradas-de-texto-govco');

            // Remover mensaje anterior si existe
            const spanOld = parentInput.querySelector('.alert-entradas-de-texto-govco');
            if (spanOld) {
                parentInput.removeChild(spanOld);
            }

            // Crear nuevo mensaje
            const newSpan = document.createElement('span');
            const span = parentInput.appendChild(newSpan);

            input.setAttribute('aria-describedby', dataMensajes[type]['id']);
            input.setAttribute('aria-invalid', dataMensajes[type]['aria-invalid']);

            span.textContent = text;
            span.classList.add(dataMensajes[type]['class'], 'alert-entradas-de-texto-govco');
            span.id = dataMensajes[type]['id'];
            span.setAttribute('role', dataMensajes[type]['role']);
            span.setAttribute('aria-live', dataMensajes[type]['aria-live']);
        }

        function removeAlertMessage(input) {
            const parentInput = input.closest('.entradas-de-texto-govco');
            const spanOld = parentInput.querySelector('.alert-entradas-de-texto-govco');
            if (spanOld) {
                parentInput.removeChild(spanOld);
            }
        }
    </script>
    @livewireScripts
</body>

</html>
