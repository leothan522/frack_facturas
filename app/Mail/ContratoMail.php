<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContratoMail extends Mailable
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
            view: 'emails.contrato',
            with: [
                'organizacion_nombre' => $this->data['organizacion_nombre'],
                'organizacion_direccion' => $this->data['organizacion_direccion'],
                'organizacion_moneda' => $this->data['organizacion_moneda'],
                'organizacion_representante' => $this->data['organizacion_representante'],
                'cliente_nombre' => $this->data['cliente_nombre'],
                'cliente_direccion' => $this->data['cliente_direccion'],
                'cliente_fecha_pago' => $this->data['cliente_fecha_pago'],
                'plan_bajada' => $this->data['plan_bajada'],
                'plan_subida' => $this->data['plan_subida'],
                'plan_precio' => $this->data['plan_precio'],
                'limite_datos' => $this->data['limite_datos'],
                'metodos' => $this->data['metodos'],
                'terminacion_contrato' => $this->data['terminacion_contrato'],
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
