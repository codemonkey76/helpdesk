<?php

use App\Broadcasting\UserChannel;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('Global', fn() => true);
Broadcast::channel('Organization.{orgId}.Notes', fn() => true);
Broadcast::channel('messaging', fn() => true);
Broadcast::channel('User.{userId}', UserChannel::class);
Broadcast::channel('User.{userId}.Messages.Search', UserChannel::class);
Broadcast::channel('User.{userId}.Organization.{orgId}.Notes.Search', UserChannel::class);
Broadcast::channel('User.{userId}.Bugs.Search', UserChannel::class);


