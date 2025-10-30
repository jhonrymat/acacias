{{-- Botón de Cerrar Sesión - Puedes colocarlo donde quieras --}}
@auth
    <style>
        /* Fondo atenuado personalizado para GOVCO modal */
        .modal-backdrop-govco {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1040;
        }

        /* Ajuste de modal centrado sobre el fondo */
        .container-modal-govco,
        #modal_advertencia {
            position: fixed !important;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1050;
        }
    </style>

    <div class="mt-3 d-flex justify-content-end">
        <button type="button" class="btn-govco fill-btn-govco symbol-btn-govco mixed-btn-govco left-arrow-btn-govco"
            icon-position="left" style="width: 165px; height: 42px;" id="btn-logout-govco"> Cerrar sesión
        </button>
    </div>

    <!-- Alerta Modal Warning -->
    <div class="modal fade show" id="modal_advertencia" tabindex="-1" aria-hidden="true" style="display:none;">
        <div class="modal-dialog modal-dialog-centered modal-dialog-govco">
            <div class="modal-content modal-content-govco">
                <div class="modal-header modal-header-govco modal-header-alerts-govco">
                    <button type="button" class="btn-close btn-close-white" id="btn-cerrar-modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body modal-body-govco center-elements-govco">
                    <div class="modal-icon">
                        <span class="modal-icon-govco modal-warning-icon"></span>
                    </div>
                    <h3 class="modal-title-govco warning-govco" id="modal_titulo">Confirmar acción</h3>
                    <p class="modal-text-govco modal-text-center-govco" id="modal_mensaje">
                        ¿Estás seguro de que deseas cerrar sesión?
                    </p>
                    <br>
                </div>
                <div class="modal-footer-govco modal-footer-alerts-govco">
                    <div class="modal-buttons-govco">
                        <button type="button" class="btn btn-primary btn-modal-govco" id="btn-confirmar-modal">Sí</button>
                        <button type="button" class="btn btn-primary btn-modal-govco btn-contorno"
                            id="btn-cancelar-modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btnLogout = document.getElementById('btn-logout-govco');
            const modal = document.getElementById('modal_advertencia');
            const btnConfirmar = document.getElementById('btn-confirmar-modal');
            const btnCancelar = document.getElementById('btn-cancelar-modal');
            const btnCerrar = document.getElementById('btn-cerrar-modal');

            function mostrarModal() {
                // Crear fondo atenuado
                const backdrop = document.createElement('div');
                backdrop.classList.add('modal-backdrop-govco');
                backdrop.id = 'modal_backdrop_govco';
                document.body.appendChild(backdrop);

                // Mostrar modal centrado
                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }

            function ocultarModal() {
                modal.style.display = 'none';
                document.body.style.overflow = '';
                const backdrop = document.getElementById('modal_backdrop_govco');
                if (backdrop) backdrop.remove();
            }

            if (btnLogout) {
                btnLogout.addEventListener('click', mostrarModal);
            }

            btnCancelar.addEventListener('click', ocultarModal);
            btnCerrar.addEventListener('click', ocultarModal);

            btnConfirmar.addEventListener('click', function() {
                ocultarModal();
                btnLogout.disabled = true;
                btnLogout.textContent = 'Cerrando sesión...';

                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

                fetch('{{ route('certificado.auth.logout') }}', {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        credentials: 'same-origin'
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            btnLogout.textContent = '¡Sesión cerrada!';
                            setTimeout(() => window.location.reload(), 1000);
                        } else {
                            btnLogout.disabled = false;
                            btnLogout.textContent = 'Cerrar sesión';
                            alert('Error al cerrar sesión. Intenta nuevamente.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        btnLogout.disabled = false;
                        btnLogout.textContent = 'Cerrar sesión';
                        alert('Ocurrió un error. Intenta nuevamente.');
                    });
            });
        });
    </script>

@endauth
