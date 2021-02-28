<?php

namespace App\Http\Controllers;

use App\CollectionHelper;
//use App\Events\SearchNotesResultsEvent;
use App\Models\Note;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizationNotesSearchController extends Controller
{
    public function index(Organization $organization, Request $request)
    {
        $query = $request->query('query');

        $notes = null;
        if (!isset($query)) {
            $notes = $organization->notes()->latest()->paginate(10);
        } else {
            $notes = CollectionHelper::paginate(Note::search($query)->get()->where('noteable_type', 'organization')->where('noteable_id', $organization->id), 10);
        }

//        event(new SearchNotesResultsEvent($notes, Auth::id()));

        return response()->json('ok');
    }
}
