<?php

namespace App\Mail;

use App\Models\ContactSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactReply extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public ContactSubmission $submission,
        public string $replyMessage,
    ) {}

    public function envelope(): Envelope
    {
        $subject = $this->submission->subject
            ? 'Re: ' . $this->submission->subject
            : 'Re: Your Inquiry - Foresight CGC';

        return new Envelope(
            subject: $subject,
            replyTo: ['admin@foresightcosec.com'],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-reply',
        );
    }
}
