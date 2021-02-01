<?php

namespace App\Observers;

use App\Models\Bug;
use Illuminate\Support\Facades\Cache;

class BugObserver
{
    /**
     * Handle the Bug "created" event.
     *
     * @param  \App\Models\Bug  $bug
     * @return void
     */
    public function created(Bug $bug)
    {
        Cache::tags(['bugs'])->forget('bugs.all');
        Cache::tags(['bugs'])->forget('bugs.' . $bug->user_id);
    }

    /**
     * Handle the Bug "updated" event.
     *
     * @param  \App\Models\Bug  $bug
     * @return void
     */
    public function updated(Bug $bug)
    {
        Cache::tags(['bugs'])->forget('bugs.all');
        Cache::tags(['bugs'])->forget('bugs.' . $bug->user_id);
    }

    /**
     * Handle the Bug "deleted" event.
     *
     * @param  \App\Models\Bug  $bug
     * @return void
     */
    public function deleted(Bug $bug)
    {
        Cache::tags(['bugs'])->forget('bugs.all');
        Cache::tags(['bugs'])->forget('bugs.' . $bug->user_id);
    }
}
