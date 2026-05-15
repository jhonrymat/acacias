<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Restablecer Contraseña</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f7f8fa; padding: 30px;">
    <div style="max-width: 600px; margin: auto; background-color: white; border-radius: 8px; padding: 30px;">
        <h2 style="color: #004884;">Restablecer tu contraseña</h2>
        <p>Recibimos una solicitud para restablecer la contraseña asociada a tu cuenta.</p>
        <p>Si fuiste tú, haz clic en el siguiente botón:</p>
        <p style="text-align: center;">
            <a href="{{ $url }}" style="background-color: #004884; color: white; text-decoration: none; padding: 12px 20px; border-radius: 5px;">
                Restablecer contraseña
            </a>
        </p>
        <p>Si no hiciste esta solicitud, puedes ignorar este mensaje.</p>
        <p style="font-size: 12px; color: gray;">© {{ date('Y') }} Alcaldía Municipal - Certificados en línea.</p>
    </div>
</body>
</html>
