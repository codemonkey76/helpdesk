<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function show($image)
    {
        return Storage::disk('s3')->response('images/users/' . $image);
    }
}
