<?php

use Illuminate\Support\Facades\Route;

// Users
Route::apiResource('users', App\Http\Controllers\UserController::class);

// Roles
Route::apiResource('roles', App\Http\Controllers\RoleController::class);

// Voting Sessions
Route::apiResource('voting-sessions', App\Http\Controllers\VotingSessionController::class);

// Questions
Route::apiResource('questions', App\Http\Controllers\QuestionController::class);

// Options
Route::apiResource('options', App\Http\Controllers\OptionController::class);

// Votes
Route::apiResource('votes', App\Http\Controllers\VoteController::class);