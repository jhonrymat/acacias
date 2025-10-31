{{-- Paso 2: Contenido condicional según autenticación --}}
<div>
    {{-- @include('components.xroad.logout')
    @guest
        {{ redirect()->route('certificado.auth.login') }}
    @endguest

    @auth
        <div class="certificado-info-container">
            <div class="contents-example-linea-avance-govco">
                <button type="button" class="btn-govco fill-btn-govco" style="width: 165px; height: 42px;" onclick="nextItemAdvanceLineHorizontal(event)">Continuar</button>
            </div>
        </div>
    @endauth --}}
    <div class="contents-example-linea-avance-govco">
			<button type="button" class="btn-govco fill-btn-govco" style="width: 165px; height: 42px;" onclick="pasosPermitidos = [1,2,3]; irAlPaso(3);">Continuar</button>
			</div>
</div>
