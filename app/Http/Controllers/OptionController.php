<?php

namespace App\Http\Controllers;

use App\Services\OptionService;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    protected OptionService $optionService;

    public function __construct(OptionService $optionService)
    {
        $this->optionService = $optionService;
    }

    public function index()
    {
        return $this->optionService->index();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'question_id' => 'required|exists:questions,id',
            'text' => 'required|string|max:255',
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
            'text' => 'sometimes|string|max:255',
            'question_id' => 'sometimes|exists:questions,id',
        ]);

        return $this->optionService->update($id, $data);
    }

    public function destroy(string $id)
    {
        return $this->optionService->destroy($id);
    }
}
