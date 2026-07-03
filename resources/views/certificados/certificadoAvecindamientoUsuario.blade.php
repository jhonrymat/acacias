<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificado de Avecindamiento</title>
    <style>
        @page {
            margin: 0cm 0cm;
        }

        body {
            margin-top: 0.5cm;
            margin-right: 1.0cm;
            margin-bottom: 0.5cm;
            /* Ajusta esta propiedad para el margen inferior */
            margin-left: 1.0cm;
        }


        .header {
            width: 100%;
            /* Asegura que ocupe todo el ancho */
            font-family: Arial, sans-serif;
            font-size: 10pt;
            /* Línea separadora */
        }

        .header-content {
            display: table;
            width: 100%;
            height: auto;
            /* Deja que el contenido determine la altura */
            box-sizing: border-box;
            margin-bottom: 10px;
            /* Espacio entre el texto y la imagen */
        }

        .left,
        .right {
            display: table-cell;
            /* Emula columnas de tabla */
            vertical-align: middle;
            /* Alinea el contenido verticalmente */
            padding: 5px 10px;
            /* Espaciado interno */
        }

        .certificado-box {
            border: 1.5px solid #000;
            padding: 15px 20px;
            margin-top: 15px;
        }


        .left {
            text-align: left;
            /* Alinea el texto a la izquierda */
        }

        .right {
            text-align: right;
            /* Alinea el texto a la derecha */
        }

        .header-image-container {
            text-align: center;
            /* Alinea la imagen hacia la derecha */
            width: 100%;
            /* Asegura que ocupe todo el ancho */
            height: 80px;
            /* Altura del contenedor */
            margin-bottom: 20px;
            /* Espaciado inferior */
        }

        .header-image {
            display: inline-block;
            /* Necesario para que respete el text-align */
            max-height: 60px;
            /* Altura máxima de la imagen */
            width: auto;
            /* Mantiene la proporción */
            margin-right: 20px;
            /* Ajusta manualmente el espacio hacia la derecha */
            margin-top: 5px;
            /* Ajusta manualmente el espacio hacia abajo */
        }

        .left2 {
            font-weight: bold;
            text-align: left;
            font-size: 14px;
            /* quitar paddin y margin */
            padding: 0;
            margin: 0;
        }



        .title {
            text-align: center;
            font-size: 15px;
            font-weight: bold;
            text-transform: uppercase;
            margin: 10px 0;
        }

        .content {
            margin: 10px 0;
            font-size: 13px;
        }

        .certificate {
            text-align: center;
            font-size: 15px;
            font-weight: bold;
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

        .signature {
            margin-top: 50px;
            text-align: center;
        }

        .verification {
            font-size: 12px;
            text-align: center;
            line-height: 0.5;
        }

        .firma {
            text-align: center;
            font-family: Arial, sans-serif;
            position: relative;
            overflow: hidden;
            /* Asegura que la marca de agua no desborde el contenedor */
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
            /* Transparencia */
            white-space: nowrap;
            display: inline-block;
            margin: 5px 0;
            /* Espaciado entre textos */
        }

        .firma-container {
            position: relative;
            z-index: 2;
            display: inline-block;
            width: 200px;
            /* Ajustar según la firma */
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
            /* Ajusta el valor negativo para acercar la línea */
        }

        .qr-container {
            text-align: center;
            margin-top: 10px;
        }


        .footer {
            position: fixed;
            bottom: 0;
            left: 2cm;
            right: 2cm;
            width: auto;
            font-family: Arial, sans-serif;
            font-size: 8pt;
            line-height: 1.4;
            color: #333;
            padding: 8px 0;
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
            width: 10cm;
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

        .footer a:hover {
            text-decoration: underline;
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


    {{-- <div class="left2">
        1020-7.10
    </div> --}}

    <!-- Título -->
    <div class="certificado-box">
        <div class="title">
            LA SECRETARIA PRIVADA MUNICIPAL DE ACACÍAS META
        </div>

        <!-- Contenido -->
        <div class="content" style="text-align: justify;">
            <p>
                De conformidad con el Decreto No 017 del 05 de marzo de 2026, <em>"Por medio del cual se hace una
                    delegación de funciones al Secretario Privado Código 020, Grado 01 Nivel Directivo"</em> establecido
                en el Artículo Primero, <em>en el cual delega al Secretario Privado de la Alcaldía Municipal de
                    Acacías - Meta o quien haga sus veces conforme a la facultad consagrada en el artículo 82 del Código
                    Civil Colombiano y el artículo 25 del Decreto Ley 1260 de 1970 en el Artículo Segundo el Secretario
                    Privado expedirá los Certificados de Avecindamiento.</em>
            </p>
        </div>

        <!-- Certificado -->
        <div class="certificate">
            <u>CERTIFICA</u>
        </div>
        @php
            $articulo =
                str_contains(strtolower($zona), 'vereda') || str_contains(strtolower($zona), 'barrio')
                    ? ' del'
                    : ' de la';
        @endphp

        <div class="content">
            <div class="content">
                <p>Que el (la) señor(a) <strong>{{ $solicitante }}</strong>, identificado con {{ $tipoDocumento }} No
                    <strong>{{ $cedula }}</strong> expedida en <strong>{{ $ciudad_expedicion }}</strong>. Para la
                    fecha de
                    verificación de solicitud formal radicada ante esta entidad, habita en el inmueble ubicado en la
                    dirección de nomenclatura <strong>{{ $direccion }}</strong> del barrio / vereda
                    <strong>{{ $barrio_vereda }}</strong>.
                </p>
            </div>
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

        {{-- div para centrar imagen --}}
        <div class="qr-container">
            <img src="{{ $qr }}" alt="Código QR" width="100" height="100">
        </div>

        <!-- Vigencia -->
        <div class="fechas">
            <p>La presente certificación se expide a solicitud escrita del interesado(a).</p>
            <p><strong>Dada en Acacías, Meta, a los {{ $fecha_emision }}</strong>,</p>
            <p>con una vigencia de doce (12) meses a partir de la fecha de expedición.</p>
        </div>

        <br>
        <br>

        <!-- Firma -->
        <!-- Firma -->
        <div class="firma">
            @if ($firma)
                <!-- Contenedor general de la firma con la marca de agua -->
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
                    <!-- Imagen de la firma -->
                    <img src="{{ public_path('storage/' . $firma) }}" alt="Firma">
                </div>
            @endif
            <!-- Datos adicionales -->
            <div class="validador">
                <p><strong>_________________________<strong></p>
                <p><strong>{{ $validador }}</strong></p>
                <p>{{ $cargo }}</p>
            </div>
        </div>

        <!-- Verificación -->
        <div class="verification">
            <p>Para verificar la integridad e inalterabilidad del presente documento consulte en el sitio:</p>
            <p><a href="{{ $verificacion_url }}" target="_blank">{{ $verificacion_url }}</a>, digita el siguiente
                numero
                de certificado:
                <strong>{{ $id }}</strong>
            </p>
            <p>o escaneado el código QR impreso en este certificado</p>
        </div>

        {{-- div, centra su contenido --}}
        <div style="text-align: center; margin-top: 20px;">
            <p style="color: red; text-decoration: underline; font-weight: bold; text-align: center;">
                Nota: Este certificado no es válido ni aplica para procesos de vinculación laboral en proyectos
                desarrollados por la industria de hidrocarburos.
            </p>
        </div>

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
                    1070.05.07<br>
                    PROCESO GESTIÓN GOBIERNO<br>
                    CERTIFICADO DE AVECINDAMIENTO<br>
                    GGOB – F – 147 V5<br>
                    01/07/2026
                </td>
            </tr>
        </table>
        <p class="footer-page">Página 1 de 1</p>
    </div>

</body>

</html>
