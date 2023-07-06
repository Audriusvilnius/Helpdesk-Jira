<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data, $text;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $text)
    {
        $this->data = $data;
        $this->text = $text;
    }





    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Message from Ticket # ' . $this->data->id)
            ->view('emails.message');
    }
}
