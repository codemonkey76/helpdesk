<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileImageController;
use App\Http\Controllers\SpaController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::get('/test-notifications', [TestController::class, 'globalNotify']);
Route::post('/profile/image', [ProfileImageController::class, 'store']);

Route::get('/images/users/{image}', [ImageController::class, 'show']);

Route::get('/test', function() {
    return view('test');
});
Route::middleware('auth')->group(function() {
    Route::get('/{any}', [SpaController::class, 'index'])->where('any', '^(?!api\/)[\/\w\.-]*');
});


