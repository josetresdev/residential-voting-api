<?php

namespace App\Services;

use App\Models\Vote;
use App\Utils\ApiResponse;
use App\Utils\Pagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VoteService
{
    protected $apiResponse;

    public function __construct(ApiResponse $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function index()
    {
        $query = Vote::with(['user', 'option', 'votingSession'])->orderByDesc('created_at');
        $votes = Pagination::paginate($query);
        return $this->apiResponse->success($votes);
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            // Verificamos si el voto ya existe para el usuario en esa sesión de votación
            $existingVote = Vote::where('user_id', $data['user_id'])
                ->where('voting_session_id', $data['voting_session_id']) // Se cambió a 'voting_session_id'
                ->first();

            if ($existingVote) {
                // Si ya existe el voto, lo actualizamos con la nueva opción
                $existingVote->update(['option_id' => $data['option_id']]);
                return $this->apiResponse->success($existingVote, 'Vote updated successfully');
            }

            // Si el voto no existe, lo creamos nuevo
            $data['uuid'] = Str::uuid()->toString(); // Generamos un UUID único
            $vote = Vote::create($data); // Creamos el voto en la base de datos

            return $this->apiResponse->success($vote, 'Vote created successfully', 201); // Retornamos la respuesta con el voto creado
        });
    }

    public function show($id)
    {
        $vote = Vote::with(['user', 'option', 'votingSession'])->find($id);

        if (!$vote) {
            return $this->apiResponse->error('Vote not found', 404);
        }

        return $this->apiResponse->success($vote);
    }

    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            // Buscar voto existente
            $vote = Vote::findOrFail($id);

            // Actualizamos los datos del voto
            $vote->update($data);

            return $this->apiResponse->success($vote, 'Vote updated successfully');
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            // Buscar el voto por ID y eliminarlo
            $vote = Vote::findOrFail($id);
            $vote->delete();

            return $this->apiResponse->success(null, 'Vote deleted successfully', 200);
        });
    }
}
