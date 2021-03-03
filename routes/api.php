<?php

use App\Http\Controllers\BugController;
use App\Http\Controllers\BugSearchController;
use App\Http\Controllers\CloseBugController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\MessageArchiveController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MessageSearchController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\OrganizationNotesController;
use App\Http\Controllers\ClickToCallController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {

    // Bug reporting routes
    Route::get('/bugs', [BugController::class, 'index']);
    Route::post('/bugs', [BugController::class, 'store']);

    Route::post('/bugs/{bug}/close', [CloseBugController::class, 'store']);
    Route::delete('/bugs/{bug}/close', [CloseBugController::class, 'destroy']);

    Route::get('/search/bugs', [BugSearchController::class, 'index']);


    // Message routes
    Route::get('/messages', [MessageController::class, 'index']);
    Route::post('/messages', [MessageController::class, 'store']);
    Route::get('/messages/{message}', [MessageController::class, 'show']);

    Route::post('/messages/{message}/archive', [MessageArchiveController::class, 'store']);
    Route::delete('/messages/{message}/archive', [MessageArchiveController::class, 'destroy']);

    Route::get('/search/messages', [MessageSearchController::class, 'index']);


    // User routes
    Route::get('/user', [UserController::class, 'show']);
    Route::get('/users', [UserController::class, 'index']);
    Route::patch('/users', [UserController::class, 'update']);


    // Notification routes
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::patch('/notifications/{id}', [NotificationController::class, 'update']);


    // Organization routes
    Route::get('/organizations', [OrganizationController::class, 'index']);

    // Organization Notes routes
    Route::post('/organizations/{organization}/notes', [OrganizationNotesController::class, 'store']);
    Route::get('/organizations/{organization}/notes', [OrganizationNotesController::class, 'index']);
    Route::patch('/organizations/{organization}/notes/{note}', [OrganizationNotesController::class, 'update']);

    // Company routes
    Route::get('/companies', [CompanyController::class, 'index']);

    // Click to Call
    Route::post('/click-to-call', [ClickToCallController::class, 'call']);
});
