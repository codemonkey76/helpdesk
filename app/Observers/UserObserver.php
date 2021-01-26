<?php

namespace App\Observers;

use App\Events\UserUpdatedEvent;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param User $user
     * @return void
     */
    public function created(User $user)
    {
        Cache::tags(['users'])->forget('users.all');
    }

    /**
     * Handle the User "updated" event.
     *
     * @param User $user
     * @return void
     */
    public function updated(User $user)
    {
        Cache::tags(['users'])->forget('users.' . $user->id);
        Cache::tags(['users'])->forget('users.all');
        broadcast(new UserUpdatedEvent($user));
    }

    public function updating(User $user)
    {
        if ($user->isDirty('avatar')) {
            Storage::disk('s3')->delete($user->getOriginal('avatar'));
        }
    }
    /**
     * Handle the User "deleted" event.
     *
     * @param User $user
     * @return void
     */
    public function deleted(User $user)
    {
        Cache::tags(['users'])->forget('users.' . $user->id);
        Cache::tags(['users'])->forget('users.all');
    }
}
