<?php

namespace App\Services;

use App\Models\Question;
use Illuminate\Support\Facades\DB;

class QuestionService
{
    public function index()
    {
        return Question::with(['votingSession', 'createdBy', 'updatedBy'])
            ->orderByDesc('created_at')
            ->get();
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            return Question::create($data);
        });
    }

    public function show(int $id)
    {
        return Question::with(['votingSession', 'createdBy', 'updatedBy'])
            ->findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $question = Question::findOrFail($id);
            $question->update($data);
            return $question;
        });
    }

    public function destroy(int $id)
    {
        return DB::transaction(function () use ($id) {
            $question = Question::findOrFail($id);
            return $question->delete();
        });
    }
}
