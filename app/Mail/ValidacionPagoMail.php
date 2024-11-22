<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ValidacionPagoMail extends Mailable
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
            view: 'emails.validacion_pago',
            with: [
                'estatus' => $this->data['estatus'],
                'cliente_nombre' => $this->data['cliente_nombre'],
                'factura_mes' => $this->data['factura_mes'],
                'factura_year' => $this->data['factura_year'],
                'pago_metodo' => $this->data['pago_metodo'],
                'pago_referencia' => $this->data['pago_referencia'],
                'pago_banco' => $this->data['pago_banco'],
                'pago_moneda' => $this->data['pago_moneda'],
                'pago_monto' => $this->data['pago_monto'],
                'pago_fecha' => $this->data['pago_fecha'],
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
