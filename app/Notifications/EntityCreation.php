<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class EntityCreation extends Notification implements ShouldQueue
{
    use Queueable;
    private $creatorName;
    private $createdEntity;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($creatorName, $createdEntity)
    {
        $this->creatorName = $creatorName;
        $this->createdEntity = $createdEntity;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    public function toSlack($notifiable)
    {
        $message = $this->creatorName . ' has created a ';
        $message .= $this->createdEntity;

        return (new SlackMessage())
                    ->success()
                    ->content($message);
    }
}
