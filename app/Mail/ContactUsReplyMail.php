<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $replyMessage;

    public function __construct($replyMessage)
    {
        $this->replyMessage = $replyMessage;
    }

    public function build()
    {
        return $this->subject('Response to Your Inquiry')
                    ->view('email.contactus.index');
    }
}
