<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        return Cache::tags(['users'])
            ->remember('users.all',
                now()->addDay(),
                fn() => User::select('id', 'first_name', 'last_name')->get()
            )->each->setAppends([])->toArray();
    }

    public function show(Request $request)
    {
        return Cache::tags(['users'])
            ->remember('users.' . $request->user()->id,
                now()->addDay(),
                fn()=> $request->user());
    }
    public function update(StoreUserRequest $request)
    {
        Auth::user()->update($request->all());

        return response('Saved', 201);
    }

}
