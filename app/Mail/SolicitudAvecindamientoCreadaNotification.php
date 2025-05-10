<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SolicitudAvecindamientoCreadaNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $solicitudId;
    public $userName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($solicitudId, $userName)
    {
        $this->solicitudId = $solicitudId;
        $this->userName = $userName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Notificación de Solicitud Creada')
                    ->view('emails.solicitud_avecindamiento_creada')
                    ->with([
                        'solicitudId' => $this->solicitudId,
                        'userName' => $this->userName,
                    ]);
    }
}
