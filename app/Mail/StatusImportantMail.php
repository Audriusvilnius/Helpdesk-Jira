<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/** @package App\Mail */
class StatusImportantMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data, $id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $id)
    {
        $this->data = $data;
        $this->id = $id;
    }




    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Ticket # ' . $this->data->id . ' updated')
            ->view('emails.status');
    }
}
