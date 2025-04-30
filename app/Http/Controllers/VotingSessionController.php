<?php

namespace App\Http\Controllers;

use App\Services\VotingSessionService;
use Illuminate\Http\Request;

class VotingSessionController extends Controller
{
    protected $votingSessionService;

    public function __construct(VotingSessionService $votingSessionService)
    {
        $this->votingSessionService = $votingSessionService;
    }

    public function index()
    {
        $votingSessions = $this->votingSessionService->index();
        return response()->json($votingSessions);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:open,closed',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $votingSession = $this->votingSessionService->store($data);
        return response()->json($votingSession, 201);
    }

    public function show(string $id)
    {
        $votingSession = $this->votingSessionService->show($id);
        return response()->json($votingSession);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:open,closed',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $votingSession = $this->votingSessionService->update($id, $data);
        return response()->json($votingSession);
    }

    public function destroy(string $id)
    {
        $this->votingSessionService->destroy($id);
        return response()->json(['message' => 'Voting session deleted successfully']);
    }
}
