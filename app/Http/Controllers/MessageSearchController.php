<?php

namespace App\Http\Controllers;

use App\Events\SearchMessageResultsEvent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MessageSearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query('query');
        $id = Auth::id();

        $received = null;
        $sent = null;

        if ($query === null) {
            $received = User::find($id)->receivedMessages->map(function ($message) {
                $message['direction'] = 'received';
                return $message;
            });

            $sent = User::find($id)->sentMessages->map(function ($message) {
                $message['direction'] = 'sent';
                return $message;
            });
        } else {
            $sent = Message::search('*' . $query . '*')->take(10000)->get()->where('from_user_id', $id)->map(function ($message) {
                $message['direction'] = 'sent';
                return $message;
            });
            $received = Message::search('*' . $query . '*')->take(10000)->get()->where('to_user_id', $id)->map(function ($message) {
                $message['direction'] = 'received';
                return $message;
            });
        }

        $messages = $sent->merge($received);

        event(new SearchMessageResultsEvent($messages, $id));

        return response()->json('ok');
    }
}
