<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FarmMechanizationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data; // Make request data available to the email view
    }

    public function build()
    {
        return $this->subject('Thank You for Your Farm Mechanization Request')
            ->view('email.farmmechanization.index');
    }
}
