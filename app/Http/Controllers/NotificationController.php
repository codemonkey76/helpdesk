<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        return Auth::user()->unreadNotifications;
    }

    public function update($id)
    {
        Log::info('Updating Notification ID: ' . $id);

        Auth::user()
            ->unreadNotifications()
            ->where('id', $id)
            ->sole()
            ->markAsRead();

        return response('ok', 201);
    }
}
