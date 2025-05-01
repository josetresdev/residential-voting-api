<?php

namespace App\Services;

use App\Models\Question;
use Illuminate\Support\Facades\DB;
use App\Utils\ApiResponse;
use Illuminate\Support\Str;

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
            ->paginate(10);

        return $this->apiResponse->success($questions);
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $data['uuid'] = Str::uuid()->toString();
            $question = Question::create($data);

            return $this->apiResponse->success($question, 'Pregunta creada correctamente.', 201);
        });
    }

    public function show(int $id)
    {
        $question = Question::with(['votingSession', 'createdBy', 'updatedBy'])->find($id);

        if (!$question) {
            return $this->apiResponse->error('Pregunta no encontrada.', 404);
        }

        return $this->apiResponse->success($question);
    }

    public function update(int $id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $question = Question::find($id);

            if (!$question) {
                return $this->apiResponse->error('Pregunta no encontrada.', 404);
            }

            $question->update($data);

            return $this->apiResponse->success($question, 'Pregunta actualizada correctamente.');
        });
    }

    public function destroy(int $id)
    {
        return DB::transaction(function () use ($id) {
            $question = Question::find($id);

            if (!$question) {
                return $this->apiResponse->error('Pregunta no encontrada.', 404);
            }

            $question->delete();

            return $this->apiResponse->success(null, 'Pregunta eliminada correctamente.');
        });
    }

}
