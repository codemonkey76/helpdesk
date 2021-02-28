<?php

namespace App\Broadcasting;

use App\Models\User;

class UserChannel
{
    public function join(User $user, User $userId)
    {
        return $user->is($userId);
    }
}
