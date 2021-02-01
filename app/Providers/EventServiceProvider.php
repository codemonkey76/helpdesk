<?php

namespace App\Providers;

use App\Events\InvoicePaidEvent;
use App\Events\MessageCreatedEvent;
use App\Listeners\NotifyAccountsInvoicePaidListener;
use App\Listeners\NotifyUserMessageReceivedListener;
use App\Models\Bug;
use App\Models\Message;
use App\Models\User;
use App\Observers\BugObserver;
use App\Observers\MessageObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        InvoicePaidEvent::class => [
            NotifyAccountsInvoicePaidListener::class
        ],
        MessageCreatedEvent::class => [
            NotifyUserMessageReceivedListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Message::observe(MessageObserver::class);
        Bug::observe(BugObserver::class);
    }
}
