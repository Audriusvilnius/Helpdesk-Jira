<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SignUpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email, $name, $id;
    /**
     * Create a new message instance.
     */
    public function __construct($email, $name, $id)
    {
        $this->email = $email;
        $this->name = $name;
        $this->id = $id;
    }


    public function build()
    {
        return $this->subject('New user sign up, name:' . $this->name . ' email: ' . $this->email)
            ->view('emails.signup');
    }
}
