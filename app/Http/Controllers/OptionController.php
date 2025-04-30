<?php

namespace App\Http\Controllers;

use App\Services\OptionService;
use Illuminate\Http\Request;
use App\Utils\ApiResponse;

class OptionController extends Controller
{
    protected $optionService;
    protected $apiResponse;

    public function __construct(OptionService $optionService, ApiResponse $apiResponse)
    {
        $this->optionService = $optionService;
        $this->apiResponse = $apiResponse;
    }

    public function index()
    {
        return $this->optionService->index();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|string',
            'is_active' => 'nullable|boolean',
        ]);

        return $this->optionService->store($data);
    }

    public function show(string $id)
    {
        return $this->optionService->show($id);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'string|max:255',
            'value' => 'string',
            'is_active' => 'nullable|boolean',
        ]);

        return $this->optionService->update($id, $data);
    }

    public function destroy(string $id)
    {
        return $this->optionService->destroy($id);
    }
}
