{{-- Paso 4: Contenido condicional según autenticación --}}
<div>
    @guest
        {{ redirect()->route('certificado.auth.login') }}
    @endguest

    @auth
        @include('components.xroad.logout')
        <div class="certificado-info-container">
            <div class="contents-example-linea-avance-govco">
                <button type="button" class="btn-govco fill-btn-govco" style="width: 165px; height: 42px;">Finalizar</button>
            </div>
        </div>
    @endauth
</div>
