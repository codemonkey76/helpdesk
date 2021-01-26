<?php

namespace App\Listeners;

use App\Events\InvoicePaidEvent;
use App\Models\Group;
use App\Notifications\InvoicePaidNotification;

class NotifyAccountsInvoicePaidListener
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
     * @param  InvoicePaidEvent  $event
     * @return void
     */
    public function handle(InvoicePaidEvent $event)
    {
        Group::whereName('accounts')->first()->users->each(fn($user) => $user->notify(new InvoicePaidNotification($event->invoice)));
    }
}
