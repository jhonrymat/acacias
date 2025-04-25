<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11pt;
            margin: 1.5cm;
        }

        .header {
            text-align: center;
        }

        .logo {
            width: 300px;
        }

        .title {
            font-weight: bold;
            text-align: center;
            font-size: 10pt;
            margin-top: 10px;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
            vertical-align: top;
        }

        .section-title {
            font-weight: bold;
            background-color: #f0f0f0;
        }

        .yes-no {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
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

    <div class="header">
        <img class="logo" src="{{ public_path('images/logo-web.png') }}" alt="Logo Alcaldía de Acacías">
        <div class="title">
            <table>
                <tr>
                    <th style="text-align: center;">
                        ACTA DE VISITA PARA EXPEDICIÓN DEL CERTIFICADO DE AVECINDAMIENTO<br>
                        ÁREA DE CONTROL FÍSICO – SECRETARÍA DE GOBIERNO
                    </th>
                </tr>
            </table>
        </div>
    </div>
    <br>
    <table>
        <tr>
            <th>FECHA DE SOLICITUD DEL TRÁMITE</th>
            <td>{{ $fecha_solicitud }}</td>
        </tr>
        <tr>
            <th>No RADICADO DEL TRÁMITE</th>
            <td>{{ $id }}</td>
        </tr>
        <tr>
            <th>NOMBRES Y APELLIDOS DEL PETICIONARIO</th>
            <td>{{ $solicitante }}</td>
        </tr>
        <tr>
            <th>No IDENTIFICACIÓN DEL PETICIONARIO</th>
            <td>{{ $tipoDocumento }} {{ $cedula }} expedida en {{ $ciudad_expedicion }}</td>
        </tr>
        <tr>
            <th>ABONADO DE NOTIFICACIÓN DEL PETICIONARIO</th>
            <td>{{ $telefono }}</td>
        </tr>
        <tr>
            <th>DIRECCIÓN DE LA VIVIENDA A VISITAR</th>
            <td><strong> {{ $direccion }}</strong> {{ $zona }}
                <strong>{{ $barrio_vereda }}</strong>, {{ $tipo_unidad }} <strong>{{ $codigo_numero }}</strong>.
            </td>
        </tr>
        <tr>
            <th>FECHA DE REALIZACIÓN DE LA VISITA</th>
            <td>{{ $fecha_visita }}</td>
        </tr>
        <tr>
            <th>VISITADOR</th>
            <td>{{ $validador1 }} {{ $codigo_validador1 }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <h4 class="section-title">HALLAZGOS EVIDENCIADOS DURANTE LA VISITA:</h4>
                <p>¿Se evidencia que la persona vive en dirección aportada?</p>

                <p>
                    <strong>
                        {{ $evidencia_residencia === 1 ? '[X] Sí' : '[ ] Sí' }}
                        &nbsp;&nbsp;
                        {{ $evidencia_residencia === 0 ? '[X] No' : '[ ] No' }}
                    </strong>
                </p>


                <h4 class="section-title">TIEMPO EN EL QUE LLEVA VIVIENDO EL PETICIONARIO EN EL INMUEBLE:</h4>
                <p>AÑOS: {{ $tiempo_residencia_anios ?? '___' }}</p>
                <p>MESES: {{ $tiempo_residencia_meses ?? '___' }}</p>
            </td>
        </tr>

    </table>


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
