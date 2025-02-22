<?php

// app/Notifications/MaintenanceModeActivated.php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MaintenanceModeActivated extends Notification implements ShouldQueue
{
    use Queueable;

    public $secretUrl;

    /**
     * Constructor de la notificación
     */
    public function __construct($secretUrl)
    {
        $this->secretUrl = $secretUrl;
    }

    /**
     * Define el canal de entrega (correo)
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Contenido del correo
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Modo de Mantenimiento Activado')
            ->greeting('Hola ' . $notifiable->name)
            ->line('El modo de mantenimiento ha sido activado en la aplicación.')
            ->line('Puedes acceder utilizando el siguiente enlace secreto:')
            ->action('Acceso Secreto', $this->secretUrl)
            ->line('Por favor, no compartas este enlace con personas no autorizadas.');
    }
}
