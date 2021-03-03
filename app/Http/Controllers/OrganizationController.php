<?php

namespace App\Http\Controllers;

use App\Events\OrganizationCreatedEvent;
use App\Models\Organization;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Cache;

class OrganizationController extends Controller
{
    public function index(): object
    {
        return Cache::tags(['organizations'])
            ->remember('organizations.all',
                now()->addDay(),
                fn() => Organization::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);

        $organization = Organization::create($validated);
        event(new OrganizationCreatedEvent($organization));

        return response()->json('ok');
    }
}
