<?php

namespace App\Http\Controllers;

use App\Services\QuestionService;
use Illuminate\Http\Request;

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
        $validated = $request->validate([
            'question_text' => 'required|string',
            'question_type' => 'required|string',
            'quiz_id' => 'required|integer',
        ]);

        return $this->questionService->store($validated);
    }

    public function show(string $id)
    {
        return $this->questionService->show((int) $id);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'question_text' => 'required|string',
            'question_type' => 'required|string',
            'quiz_id' => 'required|integer',
        ]);

        return $this->questionService->update((int) $id, $validated);
    }

    public function destroy(string $id)
    {
        return $this->questionService->destroy((int) $id);
    }
}
