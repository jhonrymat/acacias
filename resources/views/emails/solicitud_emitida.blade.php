<!DOCTYPE html>
<html>

<head>
    <style>
        /* Base */
        body,
        body *:not(html):not(style):not(br):not(tr):not(code) {
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif,
                'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
            position: relative;
        }

        body {
            -webkit-text-size-adjust: none;
            background-color: #ffffff;
            color: #718096;
            height: 100%;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            width: 100% !important;
        }

        .wrapper {
            background-color: #edf2f7;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        .content {
            margin: 0;
            padding: 0;
            width: 100%;
        }

        .inner-body {
            background-color: #ffffff;
            border-color: #e8e5ef;
            border-radius: 2px;
            border-width: 1px;
            box-shadow: 0 2px 0 rgba(0, 0, 0, 0.025), 2px 4px 0 rgba(0, 0, 0, 0.015);
            margin: 0 auto;
            padding: 32px;
            width: 570px;
        }

        .header {
            text-align: center;
            padding: 25px 0;
        }

        .header img {
            height: 75px;
            width: auto;
        }

        h1 {
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
            color: #3d4852;
            font-size: 18px;
            font-weight: bold;
            margin-top: 0;
            text-align: left;
        }

        p {
            font-size: 16px;
            line-height: 1.5em;
            margin-top: 0;
            text-align: left;
            color: #718096;
        }

        .button {
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
            border-radius: 4px;
            color: #fff !important;
            display: inline-block;
            overflow: hidden;
            text-decoration: none;
            background-color: #2d3748;
            border-bottom: 8px solid #2d3748;
            border-left: 18px solid #2d3748;
            border-right: 18px solid #2d3748;
            border-top: 8px solid #2d3748;
        }

        .footer {
            text-align: center;
            padding: 20px 0;
            font-size: 12px;
            color: #b0adc5;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <table class="content">
            <tr>
                <td class="header">
                    <img src="{{ asset('images/logo-header.png') }}" alt="Alcaldía de Acacías">
                </td>
            </tr>
            <tr>
                <td>
                    <div class="inner-body">
                        <h1>¡Hola {{ $userName }}!</h1>
                        <p>Nos complace informarte que tu solicitud de Certificado de Residencia ha sido emitida exitosamente.</p>
                        <p>Puedes consultar y descargar tu certificado haciendo clic en el siguiente enlace:</p>
                        <a href="{{ url('/versolicitudes') }}" class="button">Ver mi certificado</a>
                        <p>Gracias por usar nuestro sistema. Si tienes alguna pregunta, no dudes en contactarnos.</p>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="footer">
                    Equipo de Certificados de Residencia - Acacías, Meta
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
