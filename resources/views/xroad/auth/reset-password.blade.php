<x-layouts.bdc>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg p-4">
                    <h2 class="mb-3 text-center">Restablecer contraseña</h2>
                    <p class="text-center">Crea una nueva contraseña para tu cuenta.</p>

                    <form method="POST" action="{{ route('certificado.password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="hidden" name="email" value="{{ request()->query('email') }}">

                        {{-- Nueva contraseña --}}
                        <div class="entradas-de-texto-govco mt-3">
                            <label for="password">Nueva contraseña<span aria-required="true">*</span></label>
                            <div class="container-input-texto-govco">
                                <input type="password" id="password" name="password"
                                    aria-describedby="nota-contrasenia" placeholder="Ingrese su nueva contraseña"
                                    minlength="8" typeData="password" required>
                                {{-- botones GOVCO --}}
                                <button type="button"
                                    class="icon-entradas-de-texto-govco eye-entradas-de-texto-govco none"
                                    aria-label="Ocultar contraseña"></button>
                                <button type="button"
                                    class="icon-entradas-de-texto-govco eye-slash-entradas-de-texto-govco"
                                    aria-label="Mostrar contraseña"></button>
                            </div>
                            <span class="info-entradas-de-texto-govco alert-entradas-de-texto-govco"
                                id="nota-contrasenia">
                                Mínimo ocho (8) caracteres, un número, una letra minúscula, una letra mayúscula y un
                                carácter especial.
                            </span>
                        </div>

                        {{-- Confirmar contraseña --}}
                        <div class="entradas-de-texto-govco mt-3">
                            <label for="password_confirmation">Confirmar contraseña<span
                                    aria-required="true">*</span></label>
                            <div class="container-input-texto-govco">
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    placeholder="Confirme su nueva contraseña" minlength="8" typeData="password"
                                    required>
                                <button type="button"
                                    class="icon-entradas-de-texto-govco eye-entradas-de-texto-govco none"
                                    aria-label="Ocultar contraseña"></button>
                                <button type="button"
                                    class="icon-entradas-de-texto-govco eye-slash-entradas-de-texto-govco"
                                    aria-label="Mostrar contraseña"></button>
                            </div>
                        </div>

                        <div class="mt-4 text-center">
                            <button type="submit" class="btn-govco fill-btn-govco" style="width: auto; height: 42px;">
                                Actualizar contraseña
                            </button>
                        </div>
                    </form>

                    {{-- mensajes --}}
                    @if (session('status'))
                        <div class="alert alert-success mt-3">{{ session('status') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- === SCRIPT GOBIERNO DIGITAL - Validación y visibilidad de contraseña === --}}
    <script>
        function methodAssign(e, f, a) {
            for (let i of a) i.addEventListener(e, f, false);
        }

        window.addEventListener("load", function() {
            initInput();
        });

        function initInput() {
            var iconInputPassword = document.querySelectorAll('.icon-entradas-de-texto-govco');
            methodAssign("click", activeIconInputPassword, iconInputPassword);

            var inputContrasenia = document.querySelectorAll('input[typeData="password"]');
            methodAssign("keyup", activeInputContrasenia, inputContrasenia);
        }

        function activeIconInputPassword() {
            var parentPassword = this.parentNode;
            var inputPassword = parentPassword.querySelector('input[typeData="password"]');
            var visiblePassword = parentPassword.querySelector('.eye-entradas-de-texto-govco');
            var hidePassword = parentPassword.querySelector('.eye-slash-entradas-de-texto-govco');

            if (inputPassword.type === 'password') {
                inputPassword.type = 'text';
                visiblePassword.classList.remove('none');
                hidePassword.classList.add('none');
            } else {
                inputPassword.type = 'password';
                hidePassword.classList.remove('none');
                visiblePassword.classList.add('none');
            }
        }

        function activeInputContrasenia() {
            var expresionRegularP = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*\-_/.,|{}<>()[\]=?+¿¡])(?=.{8,})/;
            var textExito = "Contraseña correcta";
            var textError =
                "Contraseña incorrecta: debe contener mínimo ocho (8) caracteres, un número, una letra minúscula, una letra mayúscula y un carácter especial.";

            if (expresionRegularP.test(this.value)) {
                this.classList.remove('error');
                this.classList.add('success');
                crearMensaje(this, textExito, 'success', 'nota-contrasenia');
            } else {
                this.classList.remove('success');
                this.classList.add('error');
                crearMensaje(this, textError, 'error', 'nota-contrasenia');
            }
        }

        function crearMensaje(e, text, type, describedby) {
            var dataMensajes = {
                'success': {
                    id: 'campoSuccess-id',
                    'aria-invalid': 'false',
                    class: 'success-texto-govco',
                    role: 'status',
                    'aria-live': 'polite'
                },
                'error': {
                    id: 'campoWarning-id',
                    'aria-invalid': 'true',
                    class: 'error-texto-govco',
                    role: 'alert',
                    'aria-live': 'assertive'
                }
            };
            var parentInput = e.closest('.entradas-de-texto-govco');
            var spanOld = parentInput.querySelector('.alert-entradas-de-texto-govco');
            if (spanOld) parentInput.removeChild(spanOld);
            var span = document.createElement('span');
            e.setAttribute('aria-describedby', describedby + ' ' + dataMensajes[type]['id']);
            e.setAttribute('aria-invalid', dataMensajes[type]['aria-invalid']);
            span.textContent = text;
            span.classList.add(dataMensajes[type]['class'], 'alert-entradas-de-texto-govco');
            span.id = dataMensajes[type]['id'];
            span.setAttribute('role', dataMensajes[type]['role']);
            span.setAttribute('aria-live', dataMensajes[type]['aria-live']);
            parentInput.appendChild(span);
        }
    </script>
</x-layouts.bdc>
