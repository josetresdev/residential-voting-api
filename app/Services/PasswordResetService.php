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

    public function show(int $id)
    {
        return PasswordReset::findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $passwordReset = PasswordReset::findOrFail($id);
            $passwordReset->update($data);
            return $passwordReset;
        });
    }

    public function destroy(int $id)
    {
        return DB::transaction(function () use ($id) {
            $passwordReset = PasswordReset::findOrFail($id);
            return $passwordReset->delete();
        });
    }
}
