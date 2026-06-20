<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct($nome, $telefone, $telefoneTratado, $assunto, $mensagem)
    {
        $this->nome = $nome;
        $this->telefone = $telefone;
        $this->telefoneTratado = $telefoneTratado;
        $this->assunto = $assunto;
        $this->mensagem = $mensagem;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nova solicitação de contato ⚠️',
        );
    }

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

    public function attachments(): array
    {
        return [];
    }
}
