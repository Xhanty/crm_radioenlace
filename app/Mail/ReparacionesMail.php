<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReparacionesMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $reparacion;
    public $valid_transaction;

    public function __construct($user, $reparacion, $type_email)
    {
        $this->user = $user;
        $this->reparacion = $reparacion;
        $this->valid_transaction = $type_email;
    }

    public function build()
    {
        $subject = 'Nueva reparación asignada. Código' . $this->reparacion->token;

        if ($this->valid_transaction != 1) {
            $subject = 'Reparación gestionada. Código' . $this->reparacion->token;
        }

        return $this->view('emails.ReparacionesMail')->subject($subject);
    }
}
