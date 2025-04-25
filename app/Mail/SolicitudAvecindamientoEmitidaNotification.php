<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SolicitudAvecindamientoEmitidaNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $solicitudId;
    public $userName;

    /**
     * Create a new message instance.
     */
    public function __construct($solicitudId, $userName)
    {
        $this->solicitudId = $solicitudId;
        $this->userName = $userName;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Tu solicitud ha sido emitida')
                    ->view('emails.solicitud_avecindamiento_emitida')
                    ->with([
                        'solicitudId' => $this->solicitudId,
                        'userName' => $this->userName,
                    ]);
    }
}
