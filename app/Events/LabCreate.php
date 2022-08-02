<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Notifications\Notification;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use App\Listeners\SendCreateNewLabNotificattion;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class LabCreate
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $labNotification;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($labNotification)
    {
        $this->labNotification = $labNotification;
    }
    public function handle($event)
    {
        $admin = User::where('type', 'A')->first();
        Notification::send($admin, new SendCreateNewLabNotificattion($event->labNotification));
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
