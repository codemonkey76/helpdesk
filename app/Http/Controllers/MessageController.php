<?php

namespace App\Http\Controllers;

use App\Events\MessageCreatedEvent;
use App\Models\Message;
use App\Models\User;
use App\Notifications\MessageReceivedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $currentPage = request()->get('page',1);

        $sent = Message::where('from_user_id', $id);
        $from = Message::where('to_user_id', $id);
        $messages = $from->union($sent);

        return Cache::tags(['messages', 'messages.' . $id])
        ->remember('messages.' . $id . '.' . $currentPage,
            now()->addDay(),
            fn() => $messages->paginate(10));
    }
    public function show(Message $message)
    {
        return $message;
    }

    public function store(Request $request)
    {
        $request->validate([
            'to_user_id' => 'required|exists:users,id',
            'body' => 'required|string'
        ]);
        $request['from_user_id'] = Auth::id();

        $message = Message::create($request->all());

        event(new MessageCreatedEvent($message));

        return response('ok', 201);
    }
}
