<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AvisoCorteMail extends Mailable
{
    use Queueable, SerializesModels;

    private array $data;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->data['from_email'], $this->data['from_name']),
            subject: $this->data['subject'],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.aviso_corte',
            with: [
                'cliente_nombre' => $this->data['cliente_nombre'],
                'factura_numero' => $this->data['factura_numero'],
                'plan_etiqueta' => $this->data['plan_etiqueta'],
                'fecha_corte' => $this->data['fecha_corte'],
                'factura_total' => $this->data['factura_total'],
                'organizacion_moneda' => $this->data['organizacion_moneda'],
                'email' => $this->data['email'],
                'telefono' => $this->data['telefono'],
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
