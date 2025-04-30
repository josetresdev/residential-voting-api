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

    public function index()
    {
        $sessions = $this->sessionService->index();
        return response()->json($sessions);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string|in:active,inactive',
        ]);

        $session = $this->sessionService->store($validated);
        return response()->json($session, 201);
    }

    public function show(string $id)
    {
        $session = $this->sessionService->show((int)$id);

        if (!$session) {
            return response()->json(['message' => 'Session not found'], 404);
        }

        return response()->json($session);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'status' => 'nullable|string|in:active,inactive',
            // Otros campos opcionales para la actualización
        ]);

        $session = $this->sessionService->update((int)$id, $validated);

        if (!$session) {
            return response()->json(['message' => 'Session not found or not updated'], 404);
        }

        return response()->json($session);
    }

    public function destroy(string $id)
    {
        $deleted = $this->sessionService->destroy((int)$id);

        if (!$deleted) {
            return response()->json(['message' => 'Session not found'], 404);
        }

        return response()->json(['message' => 'Session deleted successfully']);
    }
}
