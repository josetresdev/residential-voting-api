<?php

namespace App\Services;

use App\Models\Session;
use App\Utils\Pagination;
use Illuminate\Support\Facades\DB;
use App\Utils\ApiResponse;

class SessionService
{
    protected $apiResponse;

    public function __construct(ApiResponse $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    /**
     * Obtener todas las sesiones con paginación y orden
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Se obtiene la consulta con los datos ordenados
        $query = Session::orderByDesc('created_at');
        // Se aplica la paginación centralizada
        $sessions = Pagination::paginate($query);
        return $this->apiResponse->success($sessions);
    }

    /**
     * Crear una nueva sesión
     *
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            // Se crea la sesión
            $session = Session::create($data);
            // Se retorna la respuesta con la sesión creada
            return $this->apiResponse->success($session, 'Session created successfully', 201);
        });
    }

    /**
     * Mostrar una sesión específica
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        // Se busca la sesión por su ID
        $session = Session::find($id);

        if (!$session) {
            return $this->apiResponse->notFound('Session not found');
        }

        // Se retorna la sesión encontrada
        return $this->apiResponse->success($session);
    }

    /**
     * Actualizar una sesión existente
     *
     * @param int $id
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            // Se busca la sesión por ID
            $session = Session::find($id);

            if (!$session) {
                return $this->apiResponse->notFound('Session not found or not updated');
            }

            // Se actualiza la sesión
            $session->update($data);
            // Se retorna la respuesta con la sesión actualizada
            return $this->apiResponse->success($session, 'Session updated successfully');
        });
    }

    /**
     * Eliminar una sesión
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            // Se busca la sesión por ID
            $session = Session::find($id);

            if (!$session) {
                return $this->apiResponse->notFound('Session not found');
            }

            // Se elimina la sesión
            $session->delete();
            // Se retorna la respuesta de eliminación exitosa
            return $this->apiResponse->success(null, 'Session deleted successfully', 204);
        });
    }
}
