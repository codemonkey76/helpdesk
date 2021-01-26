<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileImageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|file|image|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
        ]);

        $avatar = Storage::disk('s3')->put('/images/users', $request->image);

        return response()->json([
            'message' => 'File uploaded successfully',
            'avatar' => $avatar
        ], 201);
    }
}
