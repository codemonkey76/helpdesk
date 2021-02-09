<?php

namespace App\Observers;

use App\Models\Message;
use Illuminate\Support\Facades\Cache;

class MessageObserver
{
    /**
     * Handle the Message "created" event.
     *
     * @param Message $message
     * @return void
     */
    public function created(Message $message)
    {
        Cache::tags(['messages.' . $message->from_user_id])->flush();
        Cache::tags(['messages.' . $message->to_user_id])->flush();
    }

    /**
     * Handle the Message "updated" event.
     *
     * @param Message $message
     * @return void
     */
    public function updated(Message $message)
    {
        Cache::tags(['messages.' . $message->from_user_id])->flush();
        Cache::tags(['messages.' . $message->to_user_id])->flush();
    }

    /**
     * Handle the Message "deleted" event.
     *
     * @param Message $message
     * @return void
     */
    public function deleted(Message $message)
    {
        Cache::tags(['messages.' . $message->from_user_id])->flush();
        Cache::tags(['messages.' . $message->to_user_id])->flush();
    }
}
