<?php

namespace App\Http\Controllers;

use App\Models\Bug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class BugController extends Controller
{
    
    public function index()
    {
        if (Auth::user()->is_admin) {
            return Cache::tags(['bugs'])
                ->remember('bugs.all', 
                    now()->addDay(),
                    fn() => Bug::all());
        } else {
            return Cache::tags(['bugs'])
                ->remember('bugs.' . Auth::id(),
                    now()->addDay(),
                    fn() => Auth::user()->bugs);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        return Auth::user()->bugs()->create($validated)->refresh();
    }
}
