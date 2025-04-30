<?php

namespace App\Http\Controllers;

use App\Services\CacheService;
use Illuminate\Http\Request;

class CacheController extends Controller
{
    protected $cacheService;

    public function __construct(CacheService $cacheService)
    {
        $this->cacheService = $cacheService;
    }

    public function index()
    {
        $cacheItems = $this->cacheService->index();
        return response()->json($cacheItems);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'key' => 'required|string|max:255|unique:cache,key',
            'value' => 'required|string',
        ]);

        $cacheItem = $this->cacheService->store($data);
        return response()->json($cacheItem, 201);
    }

    public function show(string $key)
    {
        $cacheItem = $this->cacheService->show($key);
        return response()->json($cacheItem);
    }

    public function update(Request $request, string $key)
    {
        $data = $request->validate([
            'value' => 'required|string',
        ]);

        $cacheItem = $this->cacheService->update($key, $data);
        return response()->json($cacheItem);
    }

    public function destroy(string $key)
    {
        $this->cacheService->destroy($key);
        return response()->json(['message' => 'Cache item deleted successfully']);
    }
}
