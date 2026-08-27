<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificado de Residencia</title>
    <style>
        @page {
            margin: 0cm 0cm;
        }

        body {
            margin-top: 0.5cm;
            margin-right: 1.0cm;
            margin-bottom: 0.5cm;
            margin-left: 1.0cm;
            font-family: Arial, sans-serif;
        }

        .header {
            width: 100%;
            font-family: Arial, sans-serif;
            font-size: 12pt;
        }

        .header-image-container {
            text-align: center;
            width: 100%;
            height: 70px;
            margin-bottom: -15px;
        }

        .header-image {
            display: inline-block;
            max-height: 50px;
            width: auto;
        }

        .certificado-box {
    position: relative;
    border: 1.5px solid #000;
    padding: 5px 5px;
    margin-top: 10px;
    margin-right: 1cm;
    margin-left: 1cm;
    overflow: hidden;
}

        .escudo-marca-agua {
            position: absolute;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 500px;
            /* opacity: 0.18; */
            z-index: 0;
        }

        .certificado-content {
            position: relative;
            z-index: 1;
        }

        .title {
            text-align: center;
            font-size: 15px;
            font-weight: bold;
            text-transform: uppercase;
            margin: -2px 10px 0 0;
        }

        .content {
            margin: 10px 0;
            font-size: 15px;
        }

        .certificate {
            text-align: center;
            font-size: 17px;
            font-weight: 400;
        }

        .validacion {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
        }

        .fechas {
            text-align: center;
            font-family: Arial, sans-serif;
            line-height: 0.5;
            font-size: 12px;
        }

        .validador {
            text-align: center;
            font-family: Arial, sans-serif;
            line-height: 0.5;
            font-size: 12px;
            color: black;
            z-index: 3;
        }

        .verification {
    font-size: 16px;
    text-align: left;
    line-height: 0.1;
}

        .firma {
            text-align: center;
            font-family: Arial, sans-serif;
            position: relative;
            overflow: hidden;
        }

        .marca-agua {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            pointer-events: none;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .marca-agua span {
            transform: rotate(-10deg);
            z-index: 9999;
            font-size: 14px;
            font-family: Arial, sans-serif;
            color: rgba(0, 0, 0, 0.1);
            white-space: nowrap;
            display: inline-block;
            margin: 5px 0;
        }

        .firma-container {
            position: relative;
            z-index: 2;
            display: inline-block;
            width: 200px;
            height: auto;
        }

        .firma-container img {
            max-width: 100%;
            height: auto;
            display: block;
            z-index: 2;
            position: relative;
        }

        .firma p:first-of-type {
            margin-top: -5px;
        }

        /* Fila de Firma + QR lado a lado */
        .firma-qr-table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }

        .firma-cell {
            width: 70%;
            vertical-align: bottom;
        }

        .qr-cell {
            width: 30%;
            text-align: center;
            vertical-align: bottom;
        }

        .qr-image {
            width: 85px;
            height: 85px;
            border: 1px solid #000;
            padding: 4px;
        }

        .control-documental {
            font-size: 8px;
            font-family: Arial, sans-serif;
            margin-top: 20px;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 1cm;
            right: 1cm;
            width: auto;
            font-family: Arial, sans-serif;
            font-size: 7pt;
            line-height: 1.4;
            color: #333;
            padding: 8px 0 0 0;
            border-top: 1px solid #000;
        }

        .footer-table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
        }

        .footer-table td {
            vertical-align: top;
            padding: 0;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .footer-left {
            text-align: left;
            width: 12cm;
        }

        .footer-right {
            text-align: right;
            width: 6cm;
            font-style: italic;
        }

        .footer a {
            color: #333;
            font-weight: bold;
            text-decoration: none;
        }

        .footer-page {
            text-align: center;
            margin-top: 4px;
        }
    </style>
</head>

<body>
    <!-- Encabezado -->
    <div class="header">
        <div class="header-image-container">
            <img class="header-image" src="{{ public_path('images/logo-web.png') }}" alt="Encabezado">
        </div>
    </div>

    <div class="certificado-box">
        <img class="escudo-marca-agua" src="{{ public_path('images/marca-agua.png') }}" alt="">

        <div class="certificado-content">
            <!-- Título -->
            <div class="title">
                LA SECRETARIA PRIVADA MUNICIPAL DE ACACÍAS – META
            </div>

            <!-- Contenido -->
            <div class="content" style="text-align: justify;">
                <p>
                    En virtud de lo previsto en el artículo 315 de la Constitución Política, el articulo 29 literal f
                    numeral 6
                    de la Ley 1551 de 2012, los artículos 2.3.2.3.2 del Decreto
                    1158 de 2019 pormedio del cual se adiciona el capítulo 3 al título 2 de la parte 3 del libro 2 del
                    decreto
                    1066 de 2015, los alcaldes municipales son las únicas
                    autoridades competentes para expedir los certificados de residencia, en las áreas de influencia de
                    los
                    proyectos de exploración y explotación petrolera y minera, que
                    aspiren acceder a labores como mano de obra no calificada. Los alcaldes expedirán dichos
                    certificados con
                    base en: Censo electoral, Sistema de identificación de
                    potenciales beneficiarios de programas sociales Sisben y libros de afiliados a juntas de acción
                    comunal,
                    debidamente registrados ante el ente de control y vigilancia,
                    siempre y cuando el ciudadano lleve más de un año inscrito en los mismos.
                    Que conforme a lo expuesto
                    anteriormente procede el Alcalde Municipal bajo el
                    DECRETO 100 DEL 17 DE SEPTIEMBRE DE 2024, delegar en el titular de la <strong> Secretaría
                        Privada</strong> o
                    su
                    encargado, o quien haga sus veces la facultad de expedir los
                    certificados de residencia del Municipio de Acacías, concordante con el artículo 209 de la
                    Constitución
                    Política de Colombia y el artículo 92 de la Ley 136 de 1994
                    modificado por el artículo 30 de la Ley 1551 de 2012.
                </p>
            </div>

            <!-- Certificado -->
            <div class="certificate">
                <p>CERTIFICA</p>
            </div>
            @php
                $articulo =
                    str_contains(strtolower($zona), 'vereda') || str_contains(strtolower($zona), 'barrio')
                        ? ' del'
                        : ' de la';
            @endphp

            <div class="content">
                <p>Que, <strong>{{ $solicitante }}</strong>, identificado(a) con {{ $tipoDocumento }} No
                    <strong>{{ $cedula }}</strong> expedida en <strong>{{ $ciudad_expedicion }}</strong>, con
                    dirección de
                    residencia <strong>{{ $direccion }}</strong>{{ $articulo }} {{ $zona }}
                    <strong>{{ $barrio_vereda }}</strong> - Zona {{ $tipo_unidad }} <strong>{{ $codigo_numero }}</strong>.
                </p>
                <p>Es residente en el Municipio de Acacías, Meta.</p>
            </div>

            {{-- codicion si estado es igual a emitido pone en letras verde Certificado valido si no en rojo certificado rechazado --}}
            <div>
                @if ($estado == 'Emitido' || $estado == 'Por vencer')
                    <div class="validacion" style="color: green;">
                        <p>Certificado Válido</p> <span>N° {{ $id }}</span>
                    </div>
                @else
                    <div class="validacion" style="color: red;">
                        <p>Certificado No completado</p> <span>N° {{ $id }}</span>
                    </div>
                @endif
            </div>

            <!-- Vigencia -->
            <div class="fechas">
                <p>La presente certificación se expide a solicitud escrita del interesado(a).</p>
                <p><strong>Dada en Acacías, Meta, a los {{ $fecha_emision }}</strong></p>
                <p>Vigencia: Desde el {{ $vigencia_inicio }} {{ $vigencia_fin }}.</p>
            </div>

            <br>

            <!-- Firma + QR en la misma fila -->
            <table class="firma-qr-table">
                <tr>
                    <td class="firma-cell">
                        <div class="firma">
                            @if ($firma)
                                <div class="marca-agua">
                                    <span>Trámite No. {{ $id }} Trámite No. {{ $id }} Trámite No.
                                        {{ $id }}</span>
                                    <span>No. {{ $id }} Trámite No. {{ $id }} Trámite No.
                                        {{ $id }}</span>
                                    <span>Trámite No. {{ $id }} Trámite No. {{ $id }} Trámite No.
                                        {{ $id }}</span>
                                    <span>No. {{ $id }} Trámite No. {{ $id }} Trámite No.
                                        {{ $id }}</span>
                                    <span>Trámite No. {{ $id }} Trámite No. {{ $id }} Trámite No.
                                        {{ $id }}</span>
                                    <span>No. {{ $id }} Trámite No. {{ $id }} Trámite No.
                                        {{ $id }}</span>
                                    <span>Trámite No. {{ $id }} Trámite No. {{ $id }} Trámite No.
                                        {{ $id }}</span>
                                    <span>No. {{ $id }} Trámite No. {{ $id }} Trámite No.
                                        {{ $id }}</span>
                                    <span>Trámite No. {{ $id }} Trámite No. {{ $id }} Trámite No.
                                        {{ $id }}</span>
                                    <span>No. {{ $id }} Trámite No. {{ $id }} Trámite No.
                                        {{ $id }}</span>
                                    <span>Trámite No. {{ $id }} Trámite No. {{ $id }} Trámite No.
                                        {{ $id }}</span>
                                </div>
                                <div class="firma-container">
                                    <img src="{{ public_path('storage/' . $firma) }}" alt="Firma">
                                </div>
                            @endif
                            <div class="validador">
                                <p><strong>_________________________</strong></p>
                                <p><strong>{{ $validador }}</strong></p>
                                <p>{{ $cargo }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="qr-cell">
                        <img class="qr-image" src="{{ $qr }}" alt="Código QR">
                    </td>
                </tr>
            </table>

            <!-- Verificación -->
            <div class="verification">
                <p>Para verificar la integridad e inalterabilidad del presente documento consulte en el sitio:</p>
                <p><a href="{{ $verificacion_url }}" target="_blank">{{ $verificacion_url }}</a>, digita el siguiente
                    numero de certificado:
                    <strong>{{ $id }}</strong>
                </p>
                <p>o escaneado el código QR impreso en este certificado</p>
                <p>Fecha de descarga del certificado: {{ now()->format('d/m/Y h:i A') }}</p>
            </div>
        </div>
    </div>

    <!-- Control documental (fuera del recuadro) -->
    <div class="control-documental">
        <p>Proyectó Nombre Cargo Firma: {{ $codigo_validador1 }}</p>
        <p>Revisó Nombre Cargo Firma: {{ $codigo_validador2 }}</p>
    </div>

    <!-- Pie de página -->
    <div class="footer">
        <table class="footer-table">
            <tr>
                <td class="footer-left">
                    Sede Principal Calle 14 No. 21-32 - Barrio Cooperativo. Línea PBX: 3203509652. Línea Gratuita:
                    018000112996.<br>
                    Correo Electrónico: <a href="mailto:contactenos@acacias.gov.co">contactenos@acacias.gov.co</a>
                    Código postal: 507001. Página Web:
                    <a href="http://www.acacias.gov.co">www.acacias.gov.co</a>.
                </td>
                <td class="footer-right">
                    <em>1070.05.06</em><br>
                    PROCESO GESTIÓN GOBIERNO<br>
                    CERTIFICADO DE RESIDENCIA<br>
                    GGOB – F – 71 V11<br>
                    17/12/2024
                </td>
            </tr>
        </table>
        <p class="footer-page">Página 1 de 1</p>
    </div>

</body>

</html>
