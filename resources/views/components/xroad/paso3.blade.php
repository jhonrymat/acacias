{{-- Paso 1: Contenido condicional según autenticación --}}
<div>
    @include('components.xroad.logout')
    @guest
        {{-- redireccion a login con ruta /login --}}
        {{ redirect()->route('certificado.auth.login') }}
    @endguest

    @auth
        {{-- Usuario autenticado: Mostrar información del certificado --}}
        <div class="certificado-info-container">
            <div class="contents-example-linea-avance-govco">
                <button type="button" class="btn-govco fill-btn-govco" style="width: 165px; height: 42px;"
                    onclick="nextItemAdvanceLineHorizontal(event)">Continuar</button>
            </div>
        </div>
    @endauth
</div>
