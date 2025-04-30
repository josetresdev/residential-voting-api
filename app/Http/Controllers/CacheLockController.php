<?php

namespace App\Http\Controllers;

use App\Services\CacheLockService;
use Illuminate\Http\Request;

class CacheLockController extends Controller
{
    protected $cacheLockService;

    public function __construct(CacheLockService $cacheLockService)
    {
        $this->cacheLockService = $cacheLockService;
    }

    public function index()
    {
        $locks = $this->cacheLockService->index();
        return response()->json($locks);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'key' => 'required|string|max:255',
            'owner' => 'required|string|max:255',
            'expiration' => 'required|integer',
        ]);

        $lock = $this->cacheLockService->store($data);
        return response()->json($lock, 201);
    }

    public function show(string $id)
    {
        $lock = $this->cacheLockService->show($id);
        return response()->json($lock);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'key' => 'string|max:255',
            'owner' => 'string|max:255',
            'expiration' => 'integer',
        ]);

        $lock = $this->cacheLockService->update($id, $data);
        return response()->json($lock);
    }

    public function destroy(string $id)
    {
        $this->cacheLockService->destroy($id);
        return response()->json(['message' => 'Cache lock deleted successfully']);
    }
}
