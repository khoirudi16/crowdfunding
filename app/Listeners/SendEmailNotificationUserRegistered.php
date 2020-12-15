<?php

namespace App\Listeners;

use App\Events\UserRegisteredEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisteredMail;

class SendEmailNotificationUserRegistered
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserRegisteredEvent  $event
     * @return void
     */
    public function handle(UserRegisteredEvent $event)
    {
        $email_to = $event->email_to;
        $name = $event->name;
        $otp = $event->otp;

        Mail::to($email_to)->send(new RegisteredMail($otp, $name, $email_to));
    }
}
