<?php

namespace App\Mail;

use App\Models\Pedido;
use App\Models\Status;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PedidoStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    private $pedido;
    private $status;

    /**
     * Create a new message instance.
     */
    public function __construct(
        Pedido $pedido,
        Status $status
    )
    {
        $this->pedido = $pedido;
        $this->status = $status;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Situação de Pedido de Viagem',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.pedido_status',
            with: [
                'pedido' => $this->pedido,
                'status' => $this->status
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
