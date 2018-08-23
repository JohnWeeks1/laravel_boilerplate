<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Auth;

class ProductMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email_message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email_message)
    {
        $this->email_message = $email_message;
    }

    /**
     * Build the message.
     *
     * @return $this 
     */
    public function build()
    {
        return $this->from("".Auth::user()->email."")
        ->view('emails.email');
    }
}
