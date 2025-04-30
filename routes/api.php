<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Users
Route::apiResource('users', App\Http\Controllers\UserController::class);

// Roles
Route::apiResource('roles', App\Http\Controllers\RoleController::class);

// UserRoles
Route::apiResource('user-roles', App\Http\Controllers\UserRoleController::class);

// VotingSessions
Route::apiResource('voting-sessions', App\Http\Controllers\VotingSessionController::class);

// Questions
Route::apiResource('questions', App\Http\Controllers\QuestionController::class);

// Options
Route::apiResource('options', App\Http\Controllers\OptionController::class);

// Votes
Route::apiResource('votes', App\Http\Controllers\VoteController::class);

// Password Resets
Route::apiResource('password-resets', App\Http\Controllers\PasswordResetController::class);

// Sessions
Route::apiResource('sessions', App\Http\Controllers\SessionController::class);