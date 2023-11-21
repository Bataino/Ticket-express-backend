<?php

namespace App\Listeners;

use App\Events\OrderCompleted;
use App\Mail\OrderCompleted as MailOrderCompleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderCompletedNotification
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
     * @param  \App\Events\OrderCompleted  $event
     * @return void
     */
    public function handle(OrderCompleted $event)
    {
        Mail::to($event->user->email)->send(new MailOrderCompleted($event->user, $event->order, $event->prices));
    }
}
