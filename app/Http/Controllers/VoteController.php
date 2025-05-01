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

    public function index()
    {
        return $this->voteService->index();
    }

    public function store(Request $request)
    {
        // Validación ajustada para 'voting_session_id' y otros campos
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'option_id' => 'required|exists:options,id',
            'voting_session_id' => 'required|exists:voting_sessions,id', // Corregido aquí
        ]);
    
        return $this->voteService->store($data);
    }

    public function show(string $id)
    {
        return $this->voteService->show($id);
    }

    public function update(Request $request, string $id)
    {
        // Validación ajustada para 'voting_session_id'
        $data = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'option_id' => 'sometimes|exists:options,id',
            'voting_session_id' => 'sometimes|exists:voting_sessions,id', // Corregido aquí
        ]);

        return $this->voteService->update($id, $data);
    }

    public function destroy(string $id)
    {
        return $this->voteService->destroy($id);
    }
}
