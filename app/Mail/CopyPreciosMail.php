<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CopyPreciosMail extends Mailable
{
    use Queueable, SerializesModels;

    public $id = "";
    public $code = "";
    public $fecha = "";
    public $proveedor = "";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id, $code, $proveedor, $fecha)
    {
        $this->id = $id;
        $this->code = $code;
        $this->proveedor = $proveedor;
        $this->fecha = $fecha;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Copia actualización de precios',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.CopyPreciosMail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
