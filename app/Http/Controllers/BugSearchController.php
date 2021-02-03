<?php

namespace App\Http\Controllers;

use App\Events\SearchBugResultsEvent;
use App\Models\Bug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class BugSearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query('query');
    
        $id = Auth::id();

        $bugs = null;

        if ($query === null) {
            if (Auth::user()->is_admin) {
                $bugs = Cache::tags(['bugs'])
                    ->remember('bugs.all', 
                        now()->addDay(),
                        fn() => Bug::all());
            } else {
                $bugs = Cache::tags(['bugs'])
                    ->remember('bugs.' . Auth::id(),
                        now()->addDay(),
                        fn() => Auth::user()->bugs);
            }
        } else {
            $builder = Bug::search('*' . $query . '*')->take(10000);
            if (! Auth::user()->is_admin) {
                $builder->where('user_id', Auth::id());
            }
            $bugs = $builder->get();
        }

        event(new SearchBugResultsEvent($bugs, $id));

        return response()->json('ok');
    }
}
