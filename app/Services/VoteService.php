<?php

namespace App\Services;

use App\Models\Vote;
use Illuminate\Support\Facades\DB;
use App\Utils\ApiResponse;
use Illuminate\Support\Str;
use App\Utils\Pagination;

class VoteService
{
    protected $apiResponse;

    public function __construct(ApiResponse $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    /**
     * Obtener todos los votos con paginación.
     */
    public function index()
    {
        $query = Vote::orderByDesc('created_at')->with(['user', 'option', 'votingSession']);
        $votes = Pagination::paginate($query);
        return $this->apiResponse->success($votes);
    }

    /**
     * Almacenar un nuevo voto o actualizar uno existente.
     */
    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $existingVote = Vote::where('user_id', $data['user_id'])
                ->where('voting_session_id', $data['voting_session_id'])
                ->first();

            if ($existingVote) {
                // Si ya existe un voto, actualizarlo
                $existingVote->update(['option_id' => $data['option_id']]);
                return $this->apiResponse->success($existingVote, 'Vote updated successfully');
            } else {
                // Si no existe, crear un nuevo voto
                $data['uuid'] = Str::uuid()->toString();
                $vote = Vote::create($data);
                return $this->apiResponse->success($vote, 'Vote created successfully', 201);
            }
        });
    }

    /**
     * Mostrar un voto específico.
     */
    public function show($id)
    {
        $vote = Vote::with(['user', 'option', 'votingSession'])->find($id);

        if (!$vote) {
            return $this->apiResponse->error('Vote not found', 404);
        }

        return $this->apiResponse->success($vote);
    }

    /**
     * Actualizar un voto existente.
     */
    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $vote = Vote::findOrFail($id);

            // Actualizar los datos del voto
            $vote->update($data);

            return $this->apiResponse->success($vote, 'Vote updated successfully');
        });
    }

    /**
     * Eliminar un voto.
     */
    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $vote = Vote::findOrFail($id);
            $vote->delete();
            return $this->apiResponse->success(null, 'Vote deleted successfully', 200);
        });
    }
}
