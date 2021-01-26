<?php

namespace App\Providers;

use App\Models\Ticket;
use App\Models\TicketEntry;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\ServiceProvider;
use App\Models\Contact;
use App\Models\Company;
use App\Models\Organization;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'contact' => Contact::class,
            'company' => Company::class,
            'organization' => Organization::class,
            'ticket' => Ticket::class,
            'ticket-entry' => TicketEntry::class
        ]);



        // For new connections.
        Redis::enableEvents();
    }
}
