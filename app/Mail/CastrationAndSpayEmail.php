<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CastrationAndSpayEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data; // Make request data available to the email view
    }

    public function build()
    {
        return $this->subject('Thank You for Your Castration and Spay Request')
            ->view('email.castrationandspay.index');
    }
}
