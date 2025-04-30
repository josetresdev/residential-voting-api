<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function index()
    {
        return User::with(['roles'])->get();
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $data['password'] = Hash::make($data['password']); // Asegurando que la contraseña esté hasheada
            $user = User::create($data);
            
            // Asignando roles si es necesario
            if (isset($data['roles'])) {
                $user->roles()->sync($data['roles']);
            }

            return $user;
        });
    }

    public function show($id)
    {
        return User::with(['roles'])->findOrFail($id);
    }

    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $user = User::findOrFail($id);

            // Actualizando la contraseña solo si está presente
            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }

            $user->update($data);

            // Actualizando roles si es necesario
            if (isset($data['roles'])) {
                $user->roles()->sync($data['roles']);
            }

            return $user;
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $user = User::findOrFail($id);
            $user->roles()->detach(); // Desasignando roles antes de borrar
            return $user->delete();
        });
    }
}
