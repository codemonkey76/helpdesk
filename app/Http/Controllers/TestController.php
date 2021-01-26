<?php

namespace App\Http\Controllers;

use App\Events\GlobalNotification;

class TestController extends Controller
{
    public function globalNotify()
    {
        broadcast(new GlobalNotification('Test Message', 'success'));
        return "Done.";
    }
}
