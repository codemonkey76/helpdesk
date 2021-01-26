<?php

namespace App\Listeners;

use App\Events\MessageCreatedEvent;
use App\Models\User;
use App\Notifications\MessageReceivedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class NotifyUserMessageReceivedListener
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
     * @param MessageCreatedEvent $event
     * @return void
     */
    public function handle(MessageCreatedEvent $event)
    {
        $user = User::find($event->message->to_user_id);

        if ($user !== null) {
            $user->notify(new MessageReceivedNotification($event->message));
        }
    }
}
