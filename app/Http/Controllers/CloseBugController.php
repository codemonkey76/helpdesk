<?php

namespace App\Http\Controllers;

use App\Models\Bug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CloseBugController extends Controller
{
    public function destroy(Bug $bug)
    {
        Gate::allows('admin');
        $bug->update(['open' => true]);
    }
    public function store(Bug $bug)
    {
        Gate::allows('admin');
        $bug->update(['open' => false]);
    }
}
