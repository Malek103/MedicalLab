<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\LabCreate;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\NewLabNotification;
use Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCreateNewLabNotificattion
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(LabCreate $event)
    {
        $admin = User::where('type', 'A')->first();
        Notification::send($admin, new NewLabNotification($event->labNotification));
    }
}
