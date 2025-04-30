<?php

namespace App\Http\Controllers;

use App\Services\VoteService;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    protected $voteService;

    public function __construct(VoteService $voteService)
    {
        $this->voteService = $voteService;
    }

    /**
     * Obtener todos los votos.
     */
    public function index()
    {
        return $this->voteService->index();
    }

    /**
     * Almacenar un nuevo voto.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'option_id' => 'required|exists:options,id',
            'voting_session_id' => 'required|exists:voting_sessions,id',
        ]);
    
        return $this->voteService->store($data);
    }

    /**
     * Mostrar un voto específico.
     */
    public function show(string $id)
    {
        return $this->voteService->show($id);
    }

    /**
     * Actualizar un voto existente.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'option_id' => 'sometimes|exists:options,id',
            'voting_session_id' => 'sometimes|exists:voting_sessions,id',
        ]);

        return $this->voteService->update($id, $data);
    }

    /**
     * Eliminar un voto específico.
     */
    public function destroy(string $id)
    {
        return $this->voteService->destroy($id);
    }
}
