{{-- Paso 3: Contenido condicional según autenticación --}}
<div>
    {{-- @include('components.xroad.logout')
    @guest
        {{ redirect()->route('certificado.auth.login') }}
    @endguest

    @auth
        <div class="certificado-info-container">
            <div class="contents-example-linea-avance-govco">
                <button type="button" class="btn-govco fill-btn-govco" style="width: 165px; height: 42px;"
                    onclick="nextItemAdvanceLineHorizontal(event)">Continuar</button>
            </div>
        </div>
    @endauth --}}
    <div class="contents-example-linea-avance-govco">
			<button type="button" class="btn-govco fill-btn-govco" style="width: 165px; height: 42px;" onclick="pasosPermitidos = [1,2,3,4]; irAlPaso(4);">Continuar</button>
			</div>
</div>
