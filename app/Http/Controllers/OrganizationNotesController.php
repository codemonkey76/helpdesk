<?php

namespace App\Http\Controllers;

use App\CollectionHelper;
use App\Events\NoteCreatedEvent;
use App\Events\NoteDeletedEvent;
use App\Events\NoteUpdatedEvent;
use App\Events\SearchOrganizationNotesResultsEvent;
use App\Models\Note;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

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


    public function performSearch(Organization $organization, Request $request)
    {
        if ($request->filled('query')) {
            return

                CollectionHelper::paginate(
                Note::search($request->query('query'))
                    ->get()
                    ->where('noteable_type', 'organization')
                    ->where('noteable_id', $organization->id),
                10);
        }

        return $organization->notes()->latest()->paginate(10);
    }

    public function searchNotes(Organization $organization, Request $request)
    {
        $notes = Cache::tags($this->getCacheTags($organization))
            ->remember($this->getSearchCacheKey($organization, $request),
                now()->addDay(),
                fn() => $this->performSearch($organization, $request));

        event(new SearchOrganizationNotesResultsEvent($notes, $organization->id, Auth::id()));
        return response()->json('ok');
    }

    public function getCacheTags(Organization $organization)
    {
        return ["organizations.{$organization->id}.notes"];
    }

    public function getSearchCacheKey(Organization $organization, Request $request)
    {
        return "notes.{$organization->id}.search.{$request->query('query')}.{$request->get('page', 1)}";
    }

    public function getCacheKey(Organization $organization, Request $request)
    {
        return "notes.{$organization->id}.{$request->query('query')}.{$request->get('page', 1)}";
    }

    public function index(Organization $organization, Request $request)
    {
        if ($request->has('query')) {
            return $this->searchNotes($organization, $request);
        }

        return Cache::tags($this->getCacheTags($organization))
            ->remember($this->getCacheKey($organization, $request),
                now()->addDay(),
                fn() => $organization->notes()->latest()->paginate(10));
    }

    public function update(Organization $organization, Note $note, Request $request)
    {
        $validated = $request->validate([
            'note' => 'required'
        ]);

        $note->update($validated);
        event(new NoteUpdatedEvent($note));

        return response()->json('ok');
    }
    public function destroy(Organization $organization, Note $note)
    {
        event(new NoteDeletedEvent($note));

        $note->delete();
        Log::info('Deleted note, firing NoteDeletedEvent');


        return response()->json('ok');

    }
}
