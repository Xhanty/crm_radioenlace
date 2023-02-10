<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrdenCompraMail extends Mailable
{
    use Queueable, SerializesModels;

    public $file;
    public $attach;
    public $creador;
    public $proveedor;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($file, $attach, $creador, $proveedor)
    {
        $this->file = $file;
        $this->attach = $attach;
        $this->creador = $creador;
        $this->proveedor = $proveedor;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Orden de Compra',
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
            markdown: 'emails.OrdenCompraMail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return $this->attach;
    }
}
