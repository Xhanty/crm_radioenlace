<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AsignacionesMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $asignacion;
    public $valid_transaction;

    public function __construct($user, $asignacion, $type_email)
    {
        $this->user = $user;
        $this->asignacion = $asignacion;
        $this->valid_transaction = $type_email;
    }

    public function build()
    {
        $subject = 'Nueva asignación. Código ' . $this->asignacion->codigo;

        if ($this->valid_transaction != 1) {
            $subject = 'Asignación gestionada. Código ' . $this->asignacion->codigo;
        }

        return $this->view('emails.AsignacionesMail')->subject($subject);
    }
}
