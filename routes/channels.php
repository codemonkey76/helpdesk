<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('global-notifications', function ($user, $id) {
    return true;
});

Broadcast::channel('App.Models.User.{id}' , function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('App.Models.User.{id}.MessageSearch', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('App.Models.Message.{id}', function ($user, $id) {
   return (int) $user->id === (int) $id;
});

Broadcast::channel('messaging', function ($user) {
    return ['id' => $user->id, 'first_name' => $user->first_name, 'last_name' => $user->last_name];
});
