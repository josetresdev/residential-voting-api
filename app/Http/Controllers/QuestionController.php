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
        $questions = $this->questionService->index();
        return response()->json($questions);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question_text' => 'required|string',
            'question_type' => 'required|string',
            'quiz_id' => 'required|integer',
        ]);

        $question = $this->questionService->store($validated);
        return response()->json($question, 201);
    }

    public function show(string $id)
    {
        $question = $this->questionService->show((int) $id);

        if (!$question) {
            return response()->json(['message' => 'Question not found'], 404);
        }

        return response()->json($question);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'question_text' => 'required|string',
            'question_type' => 'required|string',
            'quiz_id' => 'required|integer',
        ]);

        $updated = $this->questionService->update((int) $id, $validated);

        if (!$updated) {
            return response()->json(['message' => 'Question not found or not updated'], 404);
        }

        return response()->json(['message' => 'Question updated successfully']);
    }

    public function destroy(string $id)
    {
        $deleted = $this->questionService->destroy((int) $id);

        if (!$deleted) {
            return response()->json(['message' => 'Question not found'], 404);
        }

        return response()->json(['message' => 'Question deleted successfully']);
    }
}
