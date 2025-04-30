<?php

namespace App\Services;

use App\Models\Question;
use Illuminate\Support\Facades\DB;
use App\Utils\ApiResponse;

class QuestionService
{
    protected $apiResponse;

    public function __construct(ApiResponse $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function index()
    {
        $questions = Question::with(['votingSession', 'createdBy', 'updatedBy'])
            ->orderByDesc('created_at')
            ->get();
        
        return $this->apiResponse->success($questions);
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $question = Question::create($data);
            return $this->apiResponse->success($question, 'Question created successfully', 201);
        });
    }

    public function show(int $id)
    {
        $question = Question::with(['votingSession', 'createdBy', 'updatedBy'])
            ->find($id);

        if (!$question) {
            return $this->apiResponse->error('Question not found', 404);
        }

        return $this->apiResponse->success($question);
    }

    public function update(int $id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $question = Question::find($id);

            if (!$question) {
                return $this->apiResponse->error('Question not found or not updated', 404);
            }

            $question->update($data);
            return $this->apiResponse->success($question, 'Question updated successfully');
        });
    }

    public function destroy(int $id)
    {
        return DB::transaction(function () use ($id) {
            $question = Question::find($id);

            if (!$question) {
                return $this->apiResponse->error('Question not found', 404);
            }

            $question->delete();
            return $this->apiResponse->success(null, 'Question deleted successfully', 204);
        });
    }
}
