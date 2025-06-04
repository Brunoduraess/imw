<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class contactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($nome, $telefone, $telefoneTratado, $assunto, $mensagem)
    {
        $this->nome = $nome;
        $this->telefone = $telefone;
        $this->telefoneTratado = $telefoneTratado;
        $this->assunto = $assunto;
        $this->mensagem = $mensagem;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nova solicitação de contato ⚠️',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.contact',
            with: [
                'nome' => $this->nome,
                'telefone' => $this->telefone,
                'telefoneTratado' => $this->telefoneTratado,
                'assunto' => $this->assunto,
                'mensagem' => $this->mensagem,
            ],
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
