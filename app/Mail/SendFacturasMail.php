<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendFacturasMail extends Mailable
{
    use Queueable, SerializesModels;

    public $facturas;

    public function __construct($facturas)
    {
        $this->facturas = $facturas;
    }

    public function build()
    {
        return $this->view('emails.SendFacturasMail')->subject('Facturas pendientes | Radio Enlace');
    }
}
