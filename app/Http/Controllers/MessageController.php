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

        $sent = Message::where('from_user_id', $id);
        $from = Message::where('to_user_id', $id);
        $messages = $from->union($sent);

        return $messages->paginate(10);

//        return Cache::tags(['messages'])
//        ->remember('messages.' . $id,
//            now()->addDay(),
//            fn() => $received
//                ->merge($sent)
//                ->sortByDesc('created_at')
//        )->flatten(1);
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
