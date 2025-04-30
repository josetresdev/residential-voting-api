<?php

namespace App\Http\Controllers;

use App\Services\SessionService;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    protected $sessionService;

    public function __construct(SessionService $sessionService)
    {
        $this->sessionService = $sessionService;
    }

    /**
     * Mostrar todas las sesiones
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->sessionService->index();
    }

    /**
     * Crear una nueva sesión
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string|in:active,inactive',
        ]);

        return $this->sessionService->store($data);
    }

    /**
     * Mostrar los detalles de una sesión
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        return $this->sessionService->show($id);
    }

    /**
     * Actualizar una sesión existente
     *
     * @param Request $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'status' => 'nullable|string|in:active,inactive',
        ]);

        return $this->sessionService->update($id, $data);
    }

    /**
     * Eliminar una sesión
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        return $this->sessionService->destroy($id);
    }
}
