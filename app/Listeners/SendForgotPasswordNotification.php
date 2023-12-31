<?php

namespace App\Listeners;

use App\Events\PasswordReset;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendForgotPasswordNotification
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
     * @param  \App\Providers\PasswordReset  $event
     * @return void
     */
    public function handle(PasswordReset $event)
    {
        Mail::to($event->user->email)->send(new \App\Mail\PasswordReset($event->user)); //
    }
}
