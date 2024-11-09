<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OTPMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
    public $name;

    public function __construct($otp, $name)
    {
        $this->otp = $otp;
        $this->name= $name;
    }

    public function build()
    {
        return $this->view('emails.otp')->with(['otp' => $this->otp, 'name' => $this->name]);
    }
    /**
     * Get the message envelope.
     */
   
}
