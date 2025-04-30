<?php

namespace App\Services;

use App\Models\VotingSession;
use Illuminate\Support\Facades\DB;

class VotingSessionService
{
    public function index()
    {
        return VotingSession::all();
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            // Crear una nueva sesión de votación
            return VotingSession::create($data);
        });
    }

    public function show($id)
    {
        return VotingSession::with(['questions'])->findOrFail($id);
    }

    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $votingSession = VotingSession::findOrFail($id);

            // Actualizar la sesión de votación
            $votingSession->update($data);

            return $votingSession;
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $votingSession = VotingSession::findOrFail($id);
            return $votingSession->delete();
        });
    }
}
