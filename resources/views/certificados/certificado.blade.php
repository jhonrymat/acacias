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


        .left {
            text-align: left;
            /* Alinea el texto a la izquierda */
        }

        .right {
            text-align: right;
            /* Alinea el texto a la derecha */
        }

        .header-image-container {
            text-align: right;
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



        .footer {
            position: fixed;
            /* Fija el footer en la parte inferior */
            bottom: 0;
            /* Ubica el footer al final de la página */
            left: 0;
            width: 100%;
            /* Asegura que ocupe todo el ancho de la página */
            text-align: center;
            /* Centra todo el contenido */
            font-family: Arial, sans-serif;
            font-size: 7pt;
            /* Tamaño pequeño para texto de pie de página */
            line-height: 1.4;
            /* Espaciado entre líneas */
            color: gray;
            padding: 10px 0;
        }

        .footer hr {
            border: 0;
            border-top: 1px solid #000;
            /* Línea horizontal superior */
            margin-bottom: 10px;
        }

        .footer p {
            margin: 0 10px;
            /* Espacio interno para el texto */
            padding: 0;
        }

        .footer a {
            color: #000;
            /* Asegura que los enlaces tengan el color negro */
            text-decoration: none;
            /* Quita el subrayado */
        }

        .footer a:hover {
            text-decoration: underline;
            /* Subrayado en hover */
        }
    </style>
</head>

<body>
    <!-- Encabezado -->
    <div class="header">
        <div class="header-content">
            <div class="left">
                <p>Página: 1 de 1</p>
            </div>
            <div class="right">
                <p>Número de folios: 1</p>
            </div>
        </div>
        <div class="header-image-container">
            <img class="header-image" src="{{ public_path('images/imagen_header.jpg') }}" alt="Encabezado">
        </div>
    </div>


    <div class="left2">
        1020-7.10
    </div>

    <!-- Título -->
    <div class="title">
        LA SECRETARIA PRIVADA MUNICIPAL DE ACACÍAS – META
    </div>

    <!-- Contenido -->
    <div class="content" style="text-align: justify;">
        <p>
            En virtud de lo previsto en el artículo 315 de la Constitución Política, el articulo 29 literal f numeral 6
            de la Ley 1551 de 2012, los artículos 2.3.2.3.2 del Decreto
            1158 de 2019 pormedio del cual se adiciona el capítulo 3 al título 2 de la parte 3 del libro 2 del decreto
            1066 de 2015, los alcaldes municipales son las únicas
            autoridades competentes para expedir los certificados de residencia, en las áreas de influencia de los
            proyectos de exploración y explotación petrolera y minera, que
            aspiren acceder a labores como mano de obra no calificada.
            Los alcaldes expedirán dichos certificados con
            base en: Censo electoral, Sistema de identificación de
            potenciales beneficiarios de programas sociales Sisben y libros de afiliados a juntas de acción comunal,
            debidamente registrados ante el ente de control y vigilancia,
            siempre y cuando el ciudadano lleve más de un año inscrito en los mismos.
            Que conforme a lo expuesto
            anteriormente procede el Alcalde Municipal bajo el
            DECRETO 100 DEL 17 DE SEPTIEMBRE DE 2024, delegar en el titular de la <strong> Secretaría Privada</strong> o
            su
            encargado, o quien haga sus veces la facultad de expedir los
            certificados de residencia del Municipio de Acacías, concordante con el artículo 209 de la Constitución
            Política de Colombia y el artículo 92 de la Ley 136 de 1994
            modificado por el artículo 30 de la Ley 1551 de 2012.
        </p>
    </div>

    <!-- Certificado -->
    <div class="certificate">
        <u>CERTIFICA</u>
    </div>
    @php
        $articulo =
            str_contains(strtolower($zona), 'vereda') || str_contains(strtolower($zona), 'barrio') ? ' del' : ' de la';
    @endphp

    <div class="content">
        <p>Que, <strong>{{ $solicitante }}</strong>, identificado(a) con Cédula de Ciudadanía No
            <strong>{{ $cedula }}</strong> expedida en <strong>{{ $ciudad_expedicion }}</strong>, con dirección de
            residencia <strong>{{ $direccion }}</strong>{{ $articulo }} {{ $zona }}
            <strong>{{ $barrio_vereda }}</strong>, {{ $tipo_unidad }} <strong>{{ $codigo_numero }}</strong>.
        </p>
        <p>Es residente en el Municipio de Acacías, Meta.</p>
    </div>

    {{-- codicion si estado es igual a emitido pone en letras verde Certificado valido si no en rojo certificado rechazado --}}
    <div>
        @if ($estado == 'Emitido')
            <div class="validacion" style="color: green;">
                <p>Certificado Válido</p> <span>N° {{ $id }}</span>
            </div>
        @else
            <div class="validacion" style="color: red;">
                <p>Certificado Rechazado</p> <span>N° {{ $id }}</span>
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
    <br>

    <!-- Firma -->
    <!-- Firma -->
    <div class="firma">
        @if ($firma)
            <!-- Contenedor general de la firma con la marca de agua -->
            <div class="marca-agua">
                <span>Trámite No. {{ $id }} Trámite No. {{ $id }} Trámite No.
                    {{ $id }}</span>
                <span>No. {{ $id }} Trámite No. {{ $id }} Trámite No. {{ $id }}</span>
                <span>Trámite No. {{ $id }} Trámite No. {{ $id }} Trámite No.
                    {{ $id }}</span>
                <span>No. {{ $id }} Trámite No. {{ $id }} Trámite No. {{ $id }}</span>
                <span>Trámite No. {{ $id }} Trámite No. {{ $id }} Trámite No.
                    {{ $id }}</span>
                <span>No. {{ $id }} Trámite No. {{ $id }} Trámite No. {{ $id }}</span>
                <span>Trámite No. {{ $id }} Trámite No. {{ $id }} Trámite No.
                    {{ $id }}</span>
                <span>No. {{ $id }} Trámite No. {{ $id }} Trámite No. {{ $id }}</span>
                <span>Trámite No. {{ $id }} Trámite No. {{ $id }} Trámite No.
                    {{ $id }}</span>
                <span>No. {{ $id }} Trámite No. {{ $id }} Trámite No. {{ $id }}</span>
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
        <p><a href="{{ $verificacion_url }}" target="_blank">{{ $verificacion_url }}</a>, digita el siguiente numero
            de certificado:
            <strong>{{ $id }}</strong>
        </p>
        <p>o escaneado el código QR impreso en este certificado</p>
        <img src="{{ $qr }}" alt="Código QR" width="100" height="100">
    </div>

    <!-- Pie de página -->
    <div class="footer">
        <hr>
        <p>Calle 13 No. 13-31 Barrio Juan Mellao. Código Postal: 507001 PBX: 3203509652. Celular: 3214904867, Inspección
            Policía Uno 3214904872, Inspección Policía Dos 3214904871, Inspección Policía Tres 3115249434, Comisaría de
            Familia 3214904873, Víctimas 323224640 – 3214761116, Bienestar Animal 3214760076, Certificados de residencia
            3214761108. Línea de Atención al Usuario: 01 8000 112 996</p>
        <p>Correo Electrónico: <a href="mailto:contactenos@acacias.gov.co">contactenos@acacias.gov.co</a>, <a
                href="mailto:gobierno@acacias.gov.co">gobierno@acacias.gov.co</a></p>
        <p>Página Web: <a href="http://www.acacias.gov.co">www.acacias.gov.co</a> Twitter: <a
                href="https://twitter.com/Alcaldiaacacias">@Alcaldiaacacias</a> Facebook: <a
                href="https://www.facebook.com/alcaldiadeacacias">Alcaldía de Acacías</a> Instagram: <a
                href="https://www.instagram.com/alcaldiadeacacias">@alcaldiadeacacias</a></p>
        <p>Validado por: {{ $codigo_validador1 }}</p>
    </div>

</body>

</html>
