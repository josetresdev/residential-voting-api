<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VoteService;

class VoteController extends Controller
{
    protected $voteService;

    public function __construct(VoteService $voteService)
    {
        $this->voteService = $voteService;
    }

    public function index()
    {
        return response()->json($this->voteService->index());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'option_id' => 'required|exists:options,id',
            'voting_session_id' => 'required|exists:voting_sessions,id',
        ]);

        $vote = $this->voteService->store($data);

        return response()->json($vote, 201);
    }

    public function show(string $id)
    {
        $vote = $this->voteService->show($id);

        return response()->json($vote);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'option_id' => 'sometimes|exists:options,id',
            'voting_session_id' => 'sometimes|exists:voting_sessions,id',
        ]);

        $vote = $this->voteService->update($id, $data);

        return response()->json($vote);
    }

    public function destroy(string $id)
    {
        $this->voteService->destroy($id);

        return response()->json(null, 204);
    }
}
