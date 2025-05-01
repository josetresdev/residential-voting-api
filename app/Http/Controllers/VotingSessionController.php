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
        return $this->votingSessionService->index();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,closed',
        ]);
    
        return $this->votingSessionService->store($data);
    }

    public function show(string $id)
    {
        return $this->votingSessionService->show($id);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,closed',
        ]);

        return $this->votingSessionService->update($id, $data);
    }

    public function destroy(string $id)
    {
        return $this->votingSessionService->destroy($id);
    }
}
