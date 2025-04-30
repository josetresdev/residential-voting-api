<?php

namespace App\Http\Controllers;

use App\Services\VotingSessionService;
use Illuminate\Http\Request;

class VotingSessionController extends Controller
{
    protected $votingSessionService;

    public function __construct(VotingSessionService $votingSessionService)
    {
        $this->votingSessionService = $votingSessionService;
    }

    /**
     * Obtener todas las sesiones de votación.
     */
    public function index()
    {
        return $this->votingSessionService->index();
    }

    /**
     * Almacenar una nueva sesión de votación.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,closed',
        ]);
    
        return $this->votingSessionService->store($data);
    }

    /**
     * Mostrar una sesión de votación específica.
     */
    public function show(string $id)
    {
        return $this->votingSessionService->show($id);
    }

    /**
     * Actualizar una sesión de votación específica.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,closed',
        ]);

        return $this->votingSessionService->update($id, $data);
    }

    /**
     * Eliminar una sesión de votación específica.
     */
    public function destroy(string $id)
    {
        return $this->votingSessionService->destroy($id);
    }
}
