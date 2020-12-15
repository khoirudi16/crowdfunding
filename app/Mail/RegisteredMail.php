<?php

namespace App\Mail;

use App\Otp;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisteredMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $otp;
    protected $name;
    protected $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($otp, $name, $email)
    {
        $this->otp = $otp;
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Noreply - Verify your account')->from('admin@example.com')->view('registered_notify')->with([
            'otp' => $this->otp,
            'name' => $this->name,
            'email' => $this->email
        ]);
    }
}
