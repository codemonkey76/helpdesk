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

        $message = null;

        if (!isset($query)) {
            $messages = Message::where('from_user_id', $id)->orWhere('to_user_id', $id)->paginate(10);
        } else {
            $sent = Message::search($query)->where('from_user_id', $id)->get();
            $received = Message::search($query)->where('to_user_id', $id)->get();
            $messages = $sent->merge($received)->paginate(10);
        }

        event(new SearchMessageResultsEvent($messages, $id));

        return response()->json('ok');
    }
}
