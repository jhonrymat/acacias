{{-- components/login.blade.php --}}
<div >
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-10">
            <h2 class="mb-3 mt-3">Certificado de Residencia</h2>
            <p class="lh-base mb-4" style="text-align: justify;">
                Nos alegra que estés aquí. En esta plataforma podrás gestionar y obtener tus certificados de forma
                rápida, sencilla y sin complicaciones. Nuestro objetivo es hacer el proceso lo más eficiente posible,
                para que puedas dedicar tu tiempo a lo que realmente importa.
            </p>
        </div>
    </div>


    <div class="card-body d-flex justify-content-center">
        <div class="inicio-sesion-govco" data-content="natural">
            <h2>Inicio de sesión</h2>

            <!-- Radio (mantener solo por aspecto visual) -->
            <div class="container-radio-login-govco row mt-4">
                <div class="radio-seleccion-govco radio-login-govco col-6 col-md-6 col-lg-6 text-center">
                    <input type="radio" id="radio12" name="radioButtonLogin2" value="1" checked>
                    <label for="radio12">Persona natural</label>
                </div>
            </div>

            <!-- Indicaciones -->
            <div class="login-label-govco mt-3">
                <p><strong>Los campos marcados con <span aria-required="true">*</span> son obligatorios</strong></p>
            </div>

            <!-- Formulario de Login -->
            <form method="POST" action="{{ route('certificado.auth.login') }}" id="login-form-govco">
                @csrf

                <div class="container-login-opcion-govco" data-container-persona="natural">

                    <!-- Input de Correo Electrónico -->
                    <div class="mt-4">
                        <div class="entradas-de-texto-govco">
                            <label for="email">Correo electrónico<span aria-required="true">*</span></label>
                            <div class="container-input-texto-govco">
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
                                    placeholder="Ej: correo@email.com" typeData="mail" aria-required="true" required
                                    autofocus autocomplete="username" />
                                <div class="icon-entradas-de-texto-govco success-icon-entradas-de-texto-govco"
                                    aria-label="success" aria-hidden="true"></div>
                                <div class="icon-entradas-de-texto-govco error-icon-entradas-de-texto-govco"
                                    aria-label="error" aria-hidden="true"></div>
                            </div>
                            @error('email')
                                <span class="error-texto-govco alert-entradas-de-texto-govco" role="alert"
                                    aria-live="assertive">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Input de Contraseña -->
                    <div class="mt-4">
                        <div class="entradas-de-texto-govco">
                            <label for="password">Contraseña<span aria-required="true">*</span></label>
                            <div class="container-input-texto-govco">
                                <input type="password" id="password" name="password"
                                    aria-describedby="nota-contrasenia"
                                    aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}"
                                    placeholder="Ingrese su contraseña" minlength="8" typeData="password"
                                    aria-required="true" required autocomplete="current-password" />
                                <button type="button"
                                    class="icon-entradas-de-texto-govco eye-entradas-de-texto-govco none"
                                    aria-label="Ocultar contraseña"></button>
                                <button type="button"
                                    class="icon-entradas-de-texto-govco eye-slash-entradas-de-texto-govco"
                                    aria-label="Mostrar contraseña"></button>
                            </div>
                            <span class="info-entradas-de-texto-govco alert-entradas-de-texto-govco"
                                id="nota-contrasenia">
                                Mínimo ocho (8) caracteres, un número, una letra minúscula, una letra mayúscula, un
                                carácter especial.
                            </span>
                            @error('password')
                                <span class="error-texto-govco alert-entradas-de-texto-govco" role="alert"
                                    aria-live="assertive">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Recordar sesión (opcional) -->
                    <div class="mt-3">
                        <div class="checkbox-seleccion-govco">
                            <input type="checkbox" id="remember_me" name="remember">
                            <label for="remember_me">Recordar mi sesión</label>
                        </div>
                    </div>

                </div>

                <!-- Mensajes de error generales -->
                @if (session('error'))
                    <div class="mt-3">
                        <span class="error-texto-govco alert-entradas-de-texto-govco" role="alert"
                            aria-live="assertive">
                            {{ session('error') }}
                        </span>
                    </div>
                @endif

                @if (session('status'))
                    <div class="mt-3">
                        <span class="success-texto-govco alert-entradas-de-texto-govco" role="status"
                            aria-live="polite">
                            {{ session('status') }}
                        </span>
                    </div>
                @endif

                <!-- Botón continuar -->
                <div class="mt-4">
                    <button type="submit" class="btn-govco fill-btn-govco" name="continuar"
                        style="width: 165px; height: 42px;" id="btn-login-continuar">
                        Continuar
                    </button>
                </div>
            </form>

            <!-- Enlaces auxiliares -->
            <div class="container-options-login-govco">
                @if (Route::has('password.request'))
                    <div class="mt-3">
                        <a href="{{ route('password.request') }}">Olvidé mi contraseña</a>
                    </div>
                @endif

                @if (Route::has('register'))
                    <p class="mt-3">¿No tienes cuenta? &nbsp;
                        <a class="mt-3" href="{{ route('register') }}">Regístrate aquí</a>
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    /**
     * Login GOV.CO con integración a línea de avance horizontal
     */
    window.addEventListener("load", function(event) {
        initLoginGovco();
    });

    function initLoginGovco() {
        const form = document.getElementById('login-form-govco');
        const inputCorreo = document.querySelector('input[name="email"]');
        const inputPassword = document.querySelector('input[name="password"]');
        const btnContinuar = document.getElementById('btn-login-continuar');

        // Inicializar validación de correo
        if (inputCorreo) {
            inputCorreo.addEventListener("keyup", function() {
                validateEmailGovco(this);
                validateButtonLoginState();
            });

            // Validar errores del servidor
            if (inputCorreo.getAttribute('aria-invalid') === 'true') {
                inputCorreo.classList.add('error');
            }
        }

        // Inicializar funcionalidad de contraseña
        initPasswordToggleGovco();

        if (inputPassword) {
            inputPassword.addEventListener('keyup', validateButtonLoginState);

            // Validar errores del servidor
            if (inputPassword.getAttribute('aria-invalid') === 'true') {
                inputPassword.closest('.entradas-de-texto-govco').classList.add('error');
            }
        }

        // Interceptar envío del formulario
        if (form) {
            form.addEventListener('submit', handleLoginSubmit);
        }

        // Validación inicial
        validateButtonLoginState();
    }

    function handleLoginSubmit(e) {
        e.preventDefault();

        const form = this;
        const btnContinuar = document.getElementById('btn-login-continuar');
        const formData = new FormData(form);

        // Deshabilitar botón durante el proceso
        btnContinuar.disabled = true;
        btnContinuar.textContent = 'Verificando...';

        // Realizar petición AJAX
        fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // ✅ Login exitoso
                    btnContinuar.textContent = '¡Ingresando!';
                    limpiarErroresVisuales();

                    // 🔁 Recargar toda la página para reflejar el estado logueado
                    setTimeout(() => {
                        window.location.reload();
                    }, 800);

                } else {
                    // ❌ Error en el login
                    mostrarErroresLogin(data.errors || {
                        email: ['Credenciales incorrectas']
                    });
                    btnContinuar.disabled = false;
                    btnContinuar.textContent = 'Continuar';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                mostrarErroresLogin({
                    email: ['Ocurrió un error. Inténtalo nuevamente.']
                });
                btnContinuar.disabled = false;
                btnContinuar.textContent = 'Continuar';
            });
    }


    function limpiarErroresVisuales() {
        // Limpiar clases de error
        document.querySelectorAll('.entradas-de-texto-govco input').forEach(input => {
            input.classList.remove('error');
        });

        // Remover mensajes de error (excepto el informativo de contraseña)
        document.querySelectorAll('.error-texto-govco').forEach(span => {
            if (span.id !== 'nota-contrasenia') {
                span.remove();
            }
        });
    }

    function mostrarErroresLogin(errors) {
        // Limpiar errores anteriores
        document.querySelectorAll('.error-texto-govco').forEach(el => {
            if (el.id !== 'nota-contrasenia') {
                el.remove();
            }
        });

        // Mostrar nuevos errores
        for (const [field, messages] of Object.entries(errors)) {
            let input;

            if (field === 'email') {
                input = document.querySelector('input[name="email"]');
            } else if (field === 'password') {
                input = document.querySelector('input[name="password"]');
            }

            if (input) {
                input.classList.add('error');
                input.classList.remove('success');

                const parent = input.closest('.entradas-de-texto-govco');
                const span = document.createElement('span');
                span.className = 'error-texto-govco alert-entradas-de-texto-govco';
                span.setAttribute('role', 'alert');
                span.setAttribute('aria-live', 'assertive');
                span.textContent = messages[0];
                parent.appendChild(span);
            }
        }
    }

    function validateEmailGovco(input) {
        const expresionRegularE = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        const textExito = "Correo electrónico válido";
        const textError = "Correo electrónico no válido";

        if (input.value.length == 0) {
            input.classList.remove('success', 'error');
            removeAlertMessageGovco(input);
        } else if (expresionRegularE.test(input.value)) {
            input.classList.remove('error');
            input.classList.add('success');
            crearMensajeGovco(input, textExito, 'success');
        } else {
            input.classList.remove('success');
            input.classList.add('error');
            crearMensajeGovco(input, textError, 'error');
        }
    }

    function validateButtonLoginState() {
        const inputCorreo = document.querySelector('input[name="email"]');
        const inputPassword = document.querySelector('input[name="password"]');
        const btnContinuar = document.getElementById('btn-login-continuar');

        if (inputCorreo && inputPassword && btnContinuar) {
            const correoValido = inputCorreo.classList.contains('success');
            const passwordValida = inputPassword.value.length >= 8;

            btnContinuar.disabled = !(correoValido && passwordValida);
        }
    }

    function initPasswordToggleGovco() {
        const btnShowPassword = document.querySelector('.eye-slash-entradas-de-texto-govco');
        const btnHidePassword = document.querySelector('.eye-entradas-de-texto-govco');
        const inputPassword = document.querySelector('input[name="password"]');

        if (btnShowPassword && btnHidePassword && inputPassword) {
            btnShowPassword.addEventListener('click', function(e) {
                e.preventDefault();
                inputPassword.type = 'text';
                this.classList.add('none');
                btnHidePassword.classList.remove('none');
            });

            btnHidePassword.addEventListener('click', function(e) {
                e.preventDefault();
                inputPassword.type = 'password';
                this.classList.add('none');
                btnShowPassword.classList.remove('none');
            });
        }
    }

    function crearMensajeGovco(input, text, type) {
        const dataMensajes = {
            'success': {
                'id': 'campoSuccess-correo-login',
                'aria-invalid': 'false',
                'class': 'success-texto-govco',
                'role': 'status',
                'aria-live': 'polite',
            },
            'error': {
                'id': 'campoWarning-correo-login',
                'aria-invalid': 'true',
                'class': 'error-texto-govco',
                'role': 'alert',
                'aria-live': 'assertive',
            }
        };

        const parentInput = input.closest('.entradas-de-texto-govco');

        // Remover mensaje anterior si existe (excepto nota de contraseña)
        const spanOld = parentInput.querySelector('.alert-entradas-de-texto-govco:not(#nota-contrasenia)');
        if (spanOld && spanOld.id !== 'nota-contrasenia') {
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

    function removeAlertMessageGovco(input) {
        const parentInput = input.closest('.entradas-de-texto-govco');
        const spanOld = parentInput.querySelector('.alert-entradas-de-texto-govco:not(#nota-contrasenia)');
        if (spanOld && spanOld.id !== 'nota-contrasenia') {
            parentInput.removeChild(spanOld);
        }
    }
</script>

{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Escucha el evento de login exitoso (puede venir de tu formulario o API)
        document.addEventListener('usuarioLogueado', function() {
            actualizarEstadoLogin();
        });

        function actualizarEstadoLogin() {
            fetch('/estado-login')
                .then(response => response.text())
                .then(html => {
                    document.querySelector('#itemLineaAvance11').innerHTML = html;
                });
        }
    });
</script> --}}
