<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|file|image|dimensions:min_width=10,min_height=10,max_width=4000,max_height=4000'
        ]);

        $url = Storage::disk('s3')->put($this->uploadUrl(), $request->image);

        return response()->json([
            'message' => 'File uploaded successfully',
            'url' => $url
        ], 201);
    }
    public function uploadUrl()
    {
        return '/users/' . Auth::id() . '/uploads/' . now()->format('Y/m/d');
    }
}
