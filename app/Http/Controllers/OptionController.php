<?php

namespace App\Http\Controllers;

use App\Services\OptionService;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    protected $optionService;

    public function __construct(OptionService $optionService)
    {
        $this->optionService = $optionService;
    }

    public function index()
    {
        $options = $this->optionService->index();
        return response()->json($options);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|string',
            'is_active' => 'nullable|boolean',
        ]);

        $option = $this->optionService->store($data);

        return response()->json($option, 201);
    }

    public function show(string $id)
    {
        $option = $this->optionService->show($id);

        if (!$option) {
            return response()->json(['message' => 'Option not found'], 404);
        }

        return response()->json($option);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'string|max:255',
            'value' => 'string',
            'is_active' => 'nullable|boolean',
        ]);

        $option = $this->optionService->update($id, $data);

        if (!$option) {
            return response()->json(['message' => 'Option not found or not updated'], 404);
        }

        return response()->json(['message' => 'Option updated successfully']);
    }

    public function destroy(string $id)
    {
        $deleted = $this->optionService->destroy($id);

        if (!$deleted) {
            return response()->json(['message' => 'Option not found'], 404);
        }

        return response()->json(['message' => 'Option deleted successfully']);
    }
}
