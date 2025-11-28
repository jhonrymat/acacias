<!-- Modal -->
<div class="modal fade" id="modalDireccion" tabindex="-1" aria-labelledby="modalDireccionLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDireccionLabel">Agregar dirección dirección</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-2"><strong>Ingrese la dirección (según el ejemplo) y de clic sobre el botón
                        Aceptar</strong></p>
                <p class="help-text">(Diligencia los campos requeridos que identifiquen la dirección actual; los campos
                    que no requiera los puede dejar en blanco. Vaya verificando en el recuadro inferior "Dirección
                    Generada" su dirección)</p>

                <!-- Vía Principal -->
                <div class="section-row">
                    <label class="form-label">Vía Principal:</label>
                    <div class="row g-2">
                        <div class="col-md-2">
                            <select class="form-select" id="tipovia">
                                <option value="">Tipo de vía</option>
                                <option value="AC">Avenida calle</option>
                                <option value="AK">Avenida carrera</option>
                                <option value="CL">Calle</option>
                                <option value="CR">Carrera</option>
                                <option value="DG">Diagonal</option>
                                <option value="TV">Transversal</option>
                                <option value="CQ">Callejón</option>
                                <option value="CRA">Circunvalar</option>
                                <option value="AV">Avenida</option>
                                <option value="TR">Tramo</option>
                                <option value="MZ">Manzana</option>
                                <option value="BL">Bloque</option>
                                <option value="LT">Lote</option>
                                <option value="CS">Casa</option>
                                <option value="ED">Edificio</option>
                                <option value="ET">Etapa</option>
                                <option value="IN">Interior</option>
                                <option value="LO">Local</option>
                                <option value="OF">Oficina</option>
                                <option value="PA">Parcela</option>
                                <option value="PI">Piso</option>
                                <option value="SA">Salón</option>
                                <option value="SE">Sector</option>
                                <option value="SU">Suite</option>
                                <option value="TZ">Torre</option>
                                <option value="UN">Unidad</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="number" min="0" max="999" class="form-control" id="numero1"
                                placeholder="Número">
                        </div>
                        <div class="col-md-2">
                            <select class="form-select" id="letra1">
                                <option value="">Letra</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                                <option value="F">F</option>
                                <option value="G">G</option>
                                <option value="H">H</option>
                                <option value="I">I</option>
                                <option value="J">J</option>
                                <option value="K">K</option>
                                <option value="L">L</option>
                                <option value="M">M</option>
                                <option value="N">N</option>
                                <option value="O">O</option>
                                <option value="P">P</option>
                                <option value="Q">Q</option>
                                <option value="R">R</option>
                                <option value="S">S</option>
                                <option value="T">T</option>
                                <option value="U">U</option>
                                <option value="V">V</option>
                                <option value="W">W</option>
                                <option value="X">X</option>
                                <option value="Y">Y</option>
                                <option value="Z">Z</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="prefijo1">
                                <option value="">Seleccione</option>
                                <option value="BIS">BIS</option>
                                <option value="BIS A">BIS A</option>
                                <option value="BIS B">BIS B</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="sector1">
                                <option value="">Sector</option>
                                <option value="SUR">SUR</option>
                                <option value="NORTE">NORTE</option>
                                <option value="OESTE">OESTE</option>
                                <option value="ESTE">ESTE</option>
                                <option value="URB">URBANA</option>
                                <option value="RUR">RURAL</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Vía Secundaria y Complemento -->
                <div class="section-row">
                    <div class="row g-2">
                        <div class="col-md-6">
                            <label class="form-label">Vía Secundaria:</label>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="number" min="0" max="999" class="form-control"
                                        id="numSecundaria" placeholder="No.">
                                </div>
                                <div class="col-6">
                                    <select class="form-select" id="letraSecundaria">
                                        <option value="">Letra</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                        <option value="F">F</option>
                                        <option value="G">G</option>
                                        <option value="H">H</option>
                                        <option value="I">I</option>
                                        <option value="J">J</option>
                                        <option value="K">K</option>
                                        <option value="L">L</option>
                                        <option value="M">M</option>
                                        <option value="N">N</option>
                                        <option value="O">O</option>
                                        <option value="P">P</option>
                                        <option value="Q">Q</option>
                                        <option value="R">R</option>
                                        <option value="S">S</option>
                                        <option value="T">T</option>
                                        <option value="U">U</option>
                                        <option value="V">V</option>
                                        <option value="W">W</option>
                                        <option value="X">X</option>
                                        <option value="Y">Y</option>
                                        <option value="Z">Z</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Vía Complemento:</label>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="number" min="0" max="999" class="form-control"
                                        id="numPlaca" placeholder="Número placa">
                                </div>
                                <div class="col-6">
                                    <select class="form-select" id="sectorComplemento">
                                        <option value="">Sector</option>
                                        <option value="SUR">SUR</option>
                                        <option value="NORTE">NORTE</option>
                                        <option value="OESTE">OESTE</option>
                                        <option value="ESTE">ESTE</option>
                                        <option value="URB">URBANA</option>
                                        <option value="RUR">RURAL</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Adicionar otro complemento -->
                <div class="section-row">
                    <label class="form-label">Adicionar otro complemento:</label>
                    <div class="row g-2">
                        <div class="col-md-4">
                            <select class="form-select" id="otroComplementoTipo" name="otroComplementoTipo">
                                <option value="">Selecciona el tipo de complemento</option>

                                <!-- URBANO - Complementos de vivienda/edificio -->
                                <optgroup label="Complementos urbanos (edificios, conjuntos, etc.)">
                                    <option value="AP">Apartamento</option>
                                    <option value="CS">Casa</option>
                                    <option value="BL">Bloque</option>
                                    <option value="TZ">Torre</option>
                                    <option value="ED">Edificio</option>
                                    <option value="IN">Interior</option>
                                    <option value="PI">Piso</option>
                                    <option value="UN">Unidad</option>
                                    <option value="SU">Suite</option>
                                    <option value="OF">Oficina</option>
                                    <option value="LO">Local</option>
                                    <option value="SA">Salón</option>
                                    <option value="BG">Bodega</option>
                                    <option value="DE">Depósito</option>
                                    <option value="CO">Conjunto</option>
                                    <option value="ET">Etapa</option>
                                    <option value="AG">Agrupación</option>
                                </optgroup>

                                <!-- URBANO - Vías y nomenclatura -->
                                <optgroup label="Tipo de vía">
                                    <option value="AV">Avenida</option>
                                    <option value="AC">Avenida Calle</option>
                                    <option value="AK">Avenida Carrera</option>
                                    <option value="CL">Calle</option>
                                    <option value="CR">Carrera</option>
                                    <option value="DG">Diagonal</option>
                                    <option value="TV">Transversal</option>
                                    <option value="CQ">Callejón</option>
                                    <option value="CRA">Circunvalar</option>
                                    <option value="TR">Tramo</option>
                                </optgroup>

                                <!-- URBANO/RURAL - Manzana, lote, parcela -->
                                <optgroup label="Manzana / Lote / Parcela">
                                    <option value="MZ">Manzana</option>
                                    <option value="LT">Lote</option>
                                    <option value="PA">Parcela</option>
                                    <option value="PD">Predio</option>
                                </optgroup>

                                <!-- RURAL - Muy útiles para fincas, veredas, corregimientos -->
                                <optgroup label="Complementos rurales (fincas, veredas, etc.)">
                                    <option value="FIN">Finca</option>
                                    <option value="HJ">Hacienda</option>
                                    <option value="PD">Predio</option>
                                    <option value="VR">Vereda</option>
                                    <option value="COR">Corregimiento</option>
                                    <option value="KM">Kilómetro</option>
                                    <option value="CA">Casas de Campo</option>
                                    <option value="GL">Globo de Terreno</option>
                                    <option value="PAR">Parcelación</option>
                                    <option value="ZN">Zona</option>
                                    <option value="SEC">Sector Rural</option>
                                </optgroup>

                                <!-- OTROS / GENÉRICOS -->
                                <optgroup label="Otros">
                                    <option value="SE">Sector</option>
                                    <option value="BAR">Barrio</option>
                                    <option value="URB">Urbanización</option>
                                    <option value="CJ">Conjunto Cerrado</option>
                                    <option value="MF">Manzana Fiscal</option>
                                    <option value="OT">Otro</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="otroComplementoValor"
                                placeholder="Escriba lo faltante">
                        </div>
                    </div>
                </div>

                <!-- Dirección Generada -->
                <div class="section-row">
                    <label class="form-label">Dirección Generada:</label>
                    <div class="generated-address" id="direccionGenerada">
                        <span class="text-muted">La dirección aparecerá aquí...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-limpiar" id="btnLimpiar">Limpiar</button>
                <button type="button" class="btn btn-primary" id="btnAceptar">Aceptar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Función para generar la dirección
    function generarDireccion() {
        let direccion = [];

        // Vía Principal
        const tipoVia = document.getElementById('tipovia').value;
        const numero1 = document.getElementById('numero1').value.trim();
        const letra1 = document.getElementById('letra1').value;
        const prefijo1 = document.getElementById('prefijo1').value;
        const sector1 = document.getElementById('sector1').value;

        if (tipoVia) direccion.push(tipoVia);
        if (numero1) direccion.push(numero1);
        if (letra1) direccion.push(letra1);
        if (prefijo1) direccion.push(prefijo1);
        if (sector1) direccion.push(sector1);

        // Vía Secundaria
        const numSecundaria = document.getElementById('numSecundaria').value.trim();
        const letraSecundaria = document.getElementById('letraSecundaria').value;

        if (numSecundaria) {
            direccion.push('# ' + numSecundaria);
            if (letraSecundaria) direccion.push(letraSecundaria);
        }

        // Vía Complemento
        const numPlaca = document.getElementById('numPlaca').value.trim();
        const sectorComplemento = document.getElementById('sectorComplemento').value;

        if (numPlaca) {
            direccion.push('- ' + numPlaca);
            if (sectorComplemento) direccion.push(sectorComplemento);
        }

        // Otro complemento
        const otroTipo = document.getElementById('otroComplementoTipo').value;
        const otroValor = document.getElementById('otroComplementoValor').value.trim();

        if (otroTipo && otroValor) {
            direccion.push(otroTipo + ' ' + otroValor);
        }

        const direccionFinal = direccion.join(' ');
        document.getElementById('direccionGenerada').innerHTML =
            direccionFinal || '<span class="text-muted">La dirección aparecerá aquí...</span>';

        return direccionFinal;
    }

    // Event listeners para actualizar la dirección en tiempo real
    const campos = [
        'tipovia', 'numero1', 'letra1', 'prefijo1', 'sector1',
        'numSecundaria', 'letraSecundaria', 'numPlaca', 'sectorComplemento',
        'otroComplementoTipo', 'otroComplementoValor'
    ];

    campos.forEach(campo => {
        document.getElementById(campo).addEventListener('change', generarDireccion);
        document.getElementById(campo).addEventListener('input', generarDireccion);
    });

    // Botón Limpiar
    document.getElementById('btnLimpiar').addEventListener('click', function() {
        campos.forEach(campo => {
            const elemento = document.getElementById(campo);
            if (elemento.tagName === 'SELECT') {
                elemento.selectedIndex = 0;
            } else {
                elemento.value = '';
            }
        });
        document.getElementById('direccionGenerada').innerHTML =
            '<span class="text-muted">La dirección aparecerá aquí...</span>';
    });

    // Botón Aceptar
    document.getElementById('btnAceptar').addEventListener('click', function() {
        const direccionFinal = generarDireccion();
        if (direccionFinal) {
            document.getElementById('direccion').value = direccionFinal;
            const modal = bootstrap.Modal.getInstance(document.getElementById('modalDireccion'));
            modal.hide();
        } else {
            alert('Por favor, complete al menos la vía principal para generar una dirección.');
        }
    });

    // Limpiar formulario al cerrar el modal
    document.getElementById('modalDireccion').addEventListener('hidden.bs.modal', function() {
        // Opcional: puedes descomentar si quieres limpiar al cerrar
        // document.getElementById('btnLimpiar').click();
    });
</script>
