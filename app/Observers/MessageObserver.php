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
        Cache::tags(['messages'])->forget('messages.' . $message->from_user_id);
        Cache::tags(['messages'])->forget('messages.' . $message->to_user_id);
    }

    /**
     * Handle the Message "updated" event.
     *
     * @param Message $message
     * @return void
     */
    public function updated(Message $message)
    {
        Cache::tags(['messages'])->forget('messages.' . $message->from_user_id);
        Cache::tags(['messages'])->forget('messages.' . $message->to_user_id);
    }

    /**
     * Handle the Message "deleted" event.
     *
     * @param Message $message
     * @return void
     */
    public function deleted(Message $message)
    {
        Cache::tags(['messages'])->forget('messages.' . $message->from_user_id);
        Cache::tags(['messages'])->forget('messages.' . $message->to_user_id);
    }
}
