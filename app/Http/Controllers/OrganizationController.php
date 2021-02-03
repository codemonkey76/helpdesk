<?php

namespace App\Http\Controllers;

use App\Models\Organization;
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
}
