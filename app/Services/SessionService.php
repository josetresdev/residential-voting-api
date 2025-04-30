<?php

namespace App\Services;

use App\Models\Session;
use Illuminate\Support\Facades\DB;

class SessionService
{
    public function index()
    {
        return Session::orderByDesc('created_at')->get();
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            return Session::create($data);
        });
    }

    public function show($id)
    {
        return Session::findOrFail($id);
    }

    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $session = Session::findOrFail($id);
            $session->update($data);
            return $session;
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $session = Session::findOrFail($id);
            return $session->delete();
        });
    }
}
