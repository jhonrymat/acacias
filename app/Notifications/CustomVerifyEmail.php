<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class CustomVerifyEmail extends BaseVerifyEmail
{
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject(__('Verifica tu dirección de correo electrónico'))
            ->greeting(__('¡Hola :name!', ['name' => $notifiable->name]))
            ->line(__('Has iniciado el proceso para generar un Certificado de Residencia en la ciudad de Acacías, Meta.'))
            ->line(__('Para garantizar la seguridad de la información y evitar fraudes, es necesario que verifiques tu dirección de correo electrónico.'))
            ->action(__('Verificar correo electrónico'), $verificationUrl)
            ->line(__('Si no has iniciado este proceso o recibiste este correo por error, puedes ignorarlo.'))
            ->salutation(__('Saludos cordiales,'))
            ->salutation(__('Equipo de Certificados - Acacías, Meta'));

    }
}
