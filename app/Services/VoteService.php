<?php

namespace App\Services;

use App\Models\Vote;
use Illuminate\Support\Facades\DB;

class VoteService
{
    /**
     * Obtiene todos los votos con sus relaciones.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Vote::with(['user', 'question', 'option'])->get();
    }

    /**
     * Almacena un nuevo voto o actualiza uno existente.
     *
     * @param array $data
     * @return \App\Models\Vote
     */
    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            // Verificar si el usuario ya ha votado por esta pregunta
            $existingVote = Vote::where('user_id', $data['user_id'])
                ->where('question_id', $data['question_id'])
                ->first();

            if ($existingVote) {
                // Si ya existe un voto, actualizarlo
                $existingVote->update(['option_id' => $data['option_id']]);
                return $existingVote;
            } else {
                // Si no existe, crear un nuevo voto
                return Vote::create($data);
            }
        });
    }

    /**
     * Muestra un voto específico con sus relaciones.
     *
     * @param int $id
     * @return \App\Models\Vote
     */
    public function show($id)
    {
        return Vote::with(['user', 'question', 'option'])->findOrFail($id);
    }

    /**
     * Actualiza un voto específico.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Vote
     */
    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $vote = Vote::findOrFail($id);

            // Actualizando el voto
            $vote->update($data);

            return $vote;
        });
    }

    /**
     * Elimina un voto específico.
     *
     * @param int $id
     * @return bool|null
     */
    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $vote = Vote::findOrFail($id);
            return $vote->delete();
        });
    }
}
