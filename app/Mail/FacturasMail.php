<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FacturasMail extends Mailable
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
            replyTo: [
              new Address($this->data['reply_email'], $this->data['reply_name'])
            ],
            subject: $this->data['subject'],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.factura',
            with: [
                'nombre' => $this->data['nombre'],
                'apellido' => $this->data['apellido'],
                'mes' => $this->data['mes'],
                'telefono' => $this->data['telefono'],
                'email' => $this->data['email'],
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
        return [
            Attachment::fromStorage($this->data['path'])
                ->as($this->data['filename'])
                ->withMime('application/pdf'),
        ];
    }
}
