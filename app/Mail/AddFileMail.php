<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AddFileMail extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket, $data, $id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ticket, $data, $id)
    {
        $this->data = $data;
        $this->ticket = $ticket;
        $this->id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Add new file, Ticket # ' . $this->ticket->id)
            ->view('emails.add-file');
    }
}
