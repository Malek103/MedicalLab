<?php

namespace App\Notifications;

use App\Events\LabCreate;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewLabNotification extends Notification
{
    use Queueable;
    public $labNotification;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($labNotification)
    {
        $this->labNotification = $labNotification ;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {

        return [
                'id' => $this->labNotification['LID'],
                'name' => $this->labNotification['LName'],
                'location' => $this->labNotification['LLocation'],
                'document' => $this->labNotification['Ldocument'],
        ];
    }
}
