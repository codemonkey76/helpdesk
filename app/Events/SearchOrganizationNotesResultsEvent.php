<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SearchOrganizationNotesResultsEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $results;
    private $user;
    private $organization;

    /**
     * Create a new event instance.
     *
     * @param $notes
     * @param $organization
     * @param $user
     */
    public function __construct($results, $organization, $user)
    {
        $this->results = $results;
        $this->user = $user;
        $this->organization = $organization;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        Log::info('Firing event on channel User.userId.Organization.OrgId.Notes.Search');
        return new PrivateChannel("User.{$this->user}.Organization.{$this->organization}.Notes.Search");
    }
}
