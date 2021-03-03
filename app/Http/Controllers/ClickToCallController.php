<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ClickToCallController extends Controller
{
    public function call()
    {
        Log::info('Hitting call method on ClickToCall controller');
        $url = config('fusion.server') . config('fusion.ctc_url');

        Log::info('Sending GET Request to: ' . $url);
        $response = Http::get($url, [
            'username' => config('fusion.username'),
            'password' => config('fusion.password'),
            'src_cid_name' => config('fusion.src_cid_name'),
            'src_cid_number' => config('fusion.src_cid_number'),
            'dest_cid_name' => config('fusion.dest_cid_name'),
            'dest_cid_number' => config('fusion.dest_cid_number'),
            'src' => config('fusion.src'),
            'dest' => config('fusion.dest'),
            'rec' => config('fusion.rec'),
            'ringback' => config('fusion.ringback')
        ]);

        Log::info($response);

    }
}
