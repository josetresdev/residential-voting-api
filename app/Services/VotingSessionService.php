<?php

namespace App\Services;

use App\Models\VotingSession;
use Illuminate\Support\Facades\DB;

class VotingSessionService
{
    /**
     * Get all voting sessions.
     */
    public function index()
    {
        return VotingSession::with(['questions'])->orderByDesc('created_at')->get();
    }

    /**
     * Store a newly created voting session.
     */
    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            // Crear una nueva sesión de votación
            return VotingSession::create($data);
        });
    }

    /**
     * Display the specified voting session with related questions.
     */
    public function show($id)
    {
        return VotingSession::with(['questions'])->findOrFail($id);
    }

    /**
     * Update the specified voting session.
     */
    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $votingSession = VotingSession::findOrFail($id);

            // Actualizar la sesión de votación
            $votingSession->update($data);

            return $votingSession;
        });
    }

    /**
     * Remove the specified voting session.
     */
    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $votingSession = VotingSession::findOrFail($id);
            return $votingSession->delete();
        });
    }
}
