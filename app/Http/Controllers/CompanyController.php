<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Support\Facades\Cache;

class CompanyController extends Controller
{
    public function index(): object
    {
        return Cache::tags(['companies'])
            ->remember('companies.all',
                now()->addDay(),
                fn() => Company::all());
    }
}
