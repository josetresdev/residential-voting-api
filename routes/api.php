<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['jwt.auth'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'user']);

    Route::apiResource('users', App\Http\Controllers\UserController::class);
    Route::apiResource('roles', App\Http\Controllers\RoleController::class);
    Route::apiResource('voting-sessions', App\Http\Controllers\VotingSessionController::class);
    Route::apiResource('questions', App\Http\Controllers\QuestionController::class);
    Route::apiResource('options', App\Http\Controllers\OptionController::class);
    Route::apiResource('votes', App\Http\Controllers\VoteController::class);
});
