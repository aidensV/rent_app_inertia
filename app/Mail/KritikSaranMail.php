<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KritikSaranMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $username;
    protected $course;
    protected $text;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username,$course,$text)
    {
        $this->username = $username;
        $this->course = $course;
        $this->text = $text;
        
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Kritik Saran Mail',
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
            view: 'mail.kritik',
            with: ['username' => $this->username, 'course' => $this->course, 'text_kritik' => $this->text],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
