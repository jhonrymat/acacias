<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $url;

    public function __construct($token, $email)
    {
        $this->url = url("/certificado-residencia/reset-password/{$token}?email={$email}");
    }

    public function build()
    {
        return $this->subject('Recupera tu contraseña - Certificado de Residencia')
            ->view('emails.xroad.reset-password');
    }
}
