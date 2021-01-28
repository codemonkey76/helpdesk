<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageArchiveController extends Controller
{
    public function store(Message $message)
    {
        $message->archive();
    }
    public function destroy(Message $message)
    {
        $message->unarchive();
    }
}
