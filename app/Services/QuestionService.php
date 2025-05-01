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
            // Se genera un UUID para la nueva pregunta
            $data['uuid'] = Str::uuid()->toString();
            $question = Question::create($data);

            // Respuesta exitosa con código 201 (Creado)
            return $this->apiResponse->success($question, 'Pregunta creada correctamente.', 201);
        });
    }

    public function show(int $id)
    {
        // Buscamos la pregunta con sus relaciones
        $question = Question::with(['votingSession', 'createdBy', 'updatedBy'])->find($id);

        // Si no se encuentra la pregunta, devolvemos un error 404
        if (!$question) {
            return $this->apiResponse->error('Pregunta no encontrada.', 404);
        }

        // Respuesta exitosa con la pregunta
        return $this->apiResponse->success($question);
    }

    public function update(int $id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            // Buscamos la pregunta a actualizar
            $question = Question::find($id);

            // Si no se encuentra la pregunta, devolvemos un error 404
            if (!$question) {
                return $this->apiResponse->error('Pregunta no encontrada.', 404);
            }

            // Actualizamos la pregunta
            $question->update($data);

            // Respuesta exitosa con la pregunta actualizada
            return $this->apiResponse->success($question, 'Pregunta actualizada correctamente.');
        });
    }

    public function destroy(int $id)
    {
        return DB::transaction(function () use ($id) {
            // Buscamos la pregunta a eliminar
            $question = Question::find($id);

            // Si no se encuentra la pregunta, devolvemos un error 404
            if (!$question) {
                return $this->apiResponse->error('Pregunta no encontrada.', 404);
            }

            // Eliminamos la pregunta
            $question->delete();

            // Respuesta exitosa con código 200 (OK), indicando que la pregunta fue eliminada
            return $this->apiResponse->success(null, 'Pregunta eliminada correctamente.');
        });
    }

}
