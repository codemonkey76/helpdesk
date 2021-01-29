<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class S3ImageController extends Controller
{
    public function show(Request $request, $user, $year, $month, $day, $file)
    {
        return Storage::disk('s3')->response("/images/uploads/$user/$year/$month/$day/$file");       
    }
}
