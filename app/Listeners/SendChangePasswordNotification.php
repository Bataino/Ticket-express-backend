<?php

namespace App\Listeners;

use App\Events\PasswordChange;
use App\Mail\PasswordChange as MailPasswordChange;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendChangePasswordNotification
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
     * @param  \App\Providers\PasswordChange  $event
     * @return void
     */
    public function handle(PasswordChange $event)
    {
        // dd($event);
        Mail::to($event->user->email)->send(new MailPasswordChange($event->user));
        //
    }
}
