<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\QuestionService;

class QuestionController extends Controller
{
    protected $questionService;

    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }

    public function index()
    {
        return $this->questionService->index();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'voting_session_id' => 'nullable|exists:voting_sessions,id',
            'closes_at' => 'nullable|date',
            'created_by' => 'nullable|exists:users,id',
            'updated_by' => 'nullable|exists:users,id',
        ]);

        return $this->questionService->store($data);
    }

    public function show(string $id)
    {
        return $this->questionService->show((int) $id);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'sometimes|required|in:active,inactive',
            'voting_session_id' => 'nullable|exists:voting_sessions,id',
            'closes_at' => 'nullable|date',
            'updated_by' => 'nullable|exists:users,id',
        ]);

        return $this->questionService->update((int) $id, $data);
    }

    public function destroy(string $id)
    {
        return $this->questionService->destroy((int) $id);
    }
}
