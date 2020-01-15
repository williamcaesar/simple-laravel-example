<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class EntityDeletion extends Notification implements ShouldQueue
{
    use Queueable;
    private $creatorName;
    private $createdEntity;

    public function __construct($creatorName, $createdEntity)
    {
        $this->creatorName = $creatorName;
        $this->createdEntity = $createdEntity;
    }

    public function via($notifiable)
    {
        return ['slack'];
    }

    public function toSlack($notifiable)
    {
        $message = $this->creatorName . ' has deleted a ';
        $message .= $this->createdEntity;

        return (new SlackMessage())
            ->success()
            ->content($message);
    }
}
