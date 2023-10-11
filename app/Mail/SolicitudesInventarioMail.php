<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SolicitudesInventarioMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $solicitud;
    public $valid_transaction;

    public function __construct($user, $solicitud, $type_email)
    {
        $this->user = $user;
        $this->solicitud = $solicitud;
        $this->valid_transaction = $type_email;
    }

    public function build()
    {
        $subject = 'Nueva solicitud de inventario. Código ' . $this->solicitud->codigo;

        if ($this->valid_transaction != 1) {
            $subject = 'Solicitud de inventario gestionada. Código ' . $this->solicitud->codigo;
        }

        return $this->view('emails.SolicitudInventarioMail')->subject($subject);
    }
}
