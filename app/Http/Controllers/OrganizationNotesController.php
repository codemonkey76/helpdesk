<?php

namespace App\Http\Controllers;

use App\Events\NoteCreatedEvent;
use App\Models\Message;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class OrganizationNotesController extends Controller
{
    public function store(Organization $organization)
    {
        $validated = request()->validate([
            'note' => 'required'
        ]);
        $note = $organization->notes()->create($validated);
        event(new NoteCreatedEvent($note));
    }

    public function index(Organization $organization)
    {
        $currentPage = request()->get('page',1);

        $notes = $organization->notes()->latest();

        return Cache::tags(['organizations.' . $organization->id . '.notes'])
            ->remember('notes.' . $organization->id . '.' . $currentPage,
                now()->addDay(),
                fn() => $notes->paginate(10));
    }
}
