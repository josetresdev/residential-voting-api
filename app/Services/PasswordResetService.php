<?php

namespace App\Services;

use App\Models\PasswordReset;
use Illuminate\Support\Facades\DB;

class PasswordResetService
{
    public function index()
    {
        return PasswordReset::orderByDesc('created_at')->get();
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            return PasswordReset::create($data);
        });
    }

    public function show(string $email)
    {
        return PasswordReset::where('email', $email)->firstOrFail();
    }

    public function update(string $email, array $data)
    {
        return DB::transaction(function () use ($email, $data) {
            $passwordReset = PasswordReset::where('email', $email)->firstOrFail();
            $passwordReset->update($data);
            return $passwordReset;
        });
    }

    public function destroy(string $email)
    {
        return DB::transaction(function () use ($email) {
            $passwordReset = PasswordReset::where('email', $email)->firstOrFail();
            return $passwordReset->delete();
        });
    }
}
