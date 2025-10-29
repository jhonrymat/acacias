<div class="card">
    <div class="card-body d-flex justify-content-center" style="background-color: #F6F8F9;">
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
            <form method="POST" action="{{ route('login') }}" id="login-form">
                @csrf

                <div class="container-login-opcion-govco" data-container-persona="natural">

                    <!-- Input de Correo Electrónico -->
                    <div class="mt-4">
                        <div class="entradas-de-texto-govco">
                            <label for="email">Correo electrónico<span aria-required="true">*</span></label>
                            <div class="container-input-texto-govco">
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
                                    placeholder="Ej: correo@email.com"
                                    typeData="mail"
                                    aria-required="true"
                                    required
                                    autofocus
                                    autocomplete="username"
                                />
                                <div class="icon-entradas-de-texto-govco success-icon-entradas-de-texto-govco" aria-label="success" aria-hidden="true"></div>
                                <div class="icon-entradas-de-texto-govco error-icon-entradas-de-texto-govco" aria-label="error" aria-hidden="true"></div>
                            </div>
                            @error('email')
                                <span class="error-texto-govco alert-entradas-de-texto-govco" role="alert" aria-live="assertive">
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
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    aria-describedby="nota-contrasenia"
                                    aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}"
                                    placeholder="Ingrese su contraseña"
                                    minlength="8"
                                    typeData="password"
                                    aria-required="true"
                                    required
                                    autocomplete="current-password"
                                />
                                <button type="button" class="icon-entradas-de-texto-govco eye-entradas-de-texto-govco none" aria-label="Ocultar contraseña"></button>
                                <button type="button" class="icon-entradas-de-texto-govco eye-slash-entradas-de-texto-govco" aria-label="Mostrar contraseña"></button>
                            </div>
                            <span class="info-entradas-de-texto-govco alert-entradas-de-texto-govco" id="nota-contrasenia">
                                Mínimo ocho (8) caracteres, un número, una letra minúscula, una letra mayúscula, un carácter especial.
                            </span>
                            @error('password')
                                <span class="error-texto-govco alert-entradas-de-texto-govco" role="alert" aria-live="assertive">
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
                        <span class="error-texto-govco alert-entradas-de-texto-govco" role="alert" aria-live="assertive">
                            {{ session('error') }}
                        </span>
                    </div>
                @endif

                @if (session('status'))
                    <div class="mt-3">
                        <span class="success-texto-govco alert-entradas-de-texto-govco" role="status" aria-live="polite">
                            {{ session('status') }}
                        </span>
                    </div>
                @endif

                <!-- Botón continuar -->
                <div class="mt-4">
                    <button type="submit" class="btn-govco fill-btn-govco" name="continuar"
                        style="width: 165px; height: 42px;" id="btn-login">
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
 * Login con validación y manejo de paso 2
 */
window.addEventListener("load", function() {
    initLoginForm();
});

function initLoginForm() {
    const form = document.getElementById('login-form');
    const inputCorreo = document.querySelector('input[name="email"]');
    const inputPassword = document.querySelector('input[name="password"]');
    const btnContinuar = document.getElementById('btn-login');

    // Inicializar validación de correo
    if (inputCorreo) {
        inputCorreo.addEventListener("keyup", function() {
            validateEmail(this);
            validateButtonState();
        });

        // Validar errores del servidor
        if (inputCorreo.getAttribute('aria-invalid') === 'true') {
            inputCorreo.classList.add('error');
        }
    }

    // Inicializar funcionalidad de contraseña
    initPasswordToggle();

    if (inputPassword) {
        inputPassword.addEventListener('keyup', validateButtonState);

        // Validar errores del servidor
        if (inputPassword.getAttribute('aria-invalid') === 'true') {
            inputPassword.closest('.entradas-de-texto-govco').classList.add('error');
        }
    }

    // Interceptar envío del formulario
    if (form) {
        form.addEventListener('submit', handleFormSubmit);
    }

    // Validación inicial
    validateButtonState();
}

function handleFormSubmit(e) {
    e.preventDefault();

    const form = this;
    const btnContinuar = document.getElementById('btn-login');
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
            // ✅ Login exitoso - avanzar al paso 2
            btnContinuar.textContent = '¡Ingresando!';

            // Simular clic en el evento de avance
            if (typeof nextItemAdvanceLineHorizontal === 'function') {
                // Crear evento simulado
                const event = new Event('click');
                nextItemAdvanceLineHorizontal(event);
            }

            // Opcional: redirigir después de un momento
            setTimeout(() => {
                window.location.href = data.redirect || '/dashboard';
            }, 1000);

        } else {
            // ❌ Error en el login
            mostrarErrores(data.errors || { general: ['Credenciales incorrectas'] });
            btnContinuar.disabled = false;
            btnContinuar.textContent = 'Continuar';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        mostrarErrores({ general: ['Ocurrió un error. Inténtalo nuevamente.'] });
        btnContinuar.disabled = false;
        btnContinuar.textContent = 'Continuar';
    });
}

function mostrarErrores(errors) {
    // Limpiar errores anteriores
    document.querySelectorAll('.error-texto-govco').forEach(el => {
        if (!el.id === 'nota-contrasenia') {
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

function validateEmail(input) {
    const expresionRegularE = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (input.value.length == 0) {
        input.classList.remove('success', 'error');
    } else if (expresionRegularE.test(input.value)) {
        input.classList.remove('error');
        input.classList.add('success');
    } else {
        input.classList.remove('success');
        input.classList.add('error');
    }
}

function validateButtonState() {
    const inputCorreo = document.querySelector('input[name="email"]');
    const inputPassword = document.querySelector('input[name="password"]');
    const btnContinuar = document.getElementById('btn-login');

    if (inputCorreo && inputPassword && btnContinuar) {
        const correoValido = inputCorreo.classList.contains('success') || inputCorreo.value.length > 0;
        const passwordValida = inputPassword.value.length >= 8;

        btnContinuar.disabled = !(correoValido && passwordValida);
    }
}

function initPasswordToggle() {
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
</script>
