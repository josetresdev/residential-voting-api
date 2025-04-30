<?php

namespace App\Services;

use App\Models\VotingSession;
use App\Utils\Pagination;
use Illuminate\Support\Facades\DB;
use App\Utils\ApiResponse;
use Illuminate\Support\Str;

class VotingSessionService
{
    protected $apiResponse;

    public function __construct(ApiResponse $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    /**
     * Obtener todas las sesiones de votación con paginación.
     */
    public function index()
    {
        $query = VotingSession::orderByDesc('created_at');
        $votingSessions = Pagination::paginate($query);
        return $this->apiResponse->success($votingSessions);
    }

    /**
     * Almacenar una nueva sesión de votación.
     */
    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            // Crear un UUID único para la sesión de votación
            $data['uuid'] = Str::uuid()->toString();

            // Crear la sesión de votación en la base de datos
            $votingSession = VotingSession::create($data);

            // Si en algún futuro se requieren relaciones adicionales, agregarla aquí
            // Por ejemplo, si hay relaciones con usuarios o configuraciones adicionales.
            
            // Retornar respuesta con el objeto creado
            return $this->apiResponse->success($votingSession, 'Voting session created successfully', 201);
        });
    }

    /**
     * Mostrar la sesión de votación especificada.
     */
    public function show($id)
    {
        $votingSession = VotingSession::find($id);

        if (!$votingSession) {
            return $this->apiResponse->error('Voting session not found', 404);
        }

        return $this->apiResponse->success($votingSession);
    }

    /**
     * Actualizar la sesión de votación especificada.
     */
    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $votingSession = VotingSession::findOrFail($id);

            // Actualizar los datos de la sesión de votación
            $votingSession->update($data);

            return $this->apiResponse->success($votingSession, 'Voting session updated successfully');
        });
    }

    /**
     * Eliminar la sesión de votación especificada.
     */
    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $votingSession = VotingSession::findOrFail($id);
    
            $votingSession->delete();
    
            return $this->apiResponse->success(null, 'Voting session deleted successfully', 200);
        });
    }
    
}
