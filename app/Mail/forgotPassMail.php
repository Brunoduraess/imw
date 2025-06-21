<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class forgotPassMail extends Mailable
{
    use Queueable, SerializesModels;


    public function __construct($link)
    {
        $this->link = $link;
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Redefinição de senha da sua conta',
        );
    }


    public function content(): Content
    {
        return new Content(
            view: 'email.update_password',
            with: [
                'link' => $this->link,
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
