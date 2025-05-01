<?php

namespace App\Services;

use App\Models\Option;
use App\Utils\ApiResponse;
use App\Utils\Pagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OptionService
{
    protected ApiResponse $apiResponse;

    public function __construct(ApiResponse $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function index()
    {
        $query = Option::with(['question', 'createdBy', 'updatedBy'])
                    ->orderByDesc('created_at');

        $options = Pagination::paginate($query);

        return $this->apiResponse->success($options);
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $data['created_by'] = Auth::id();
            $data['updated_by'] = Auth::id();

            $option = Option::create($data);

            return $this->apiResponse->success($option, 'Opción creada correctamente.', 201);
        });
    }

    public function show(string $id)
    {
        $option = Option::with(['question', 'createdBy', 'updatedBy'])->find($id);

        if (!$option) {
            return $this->apiResponse->error('Opción no encontrada', 404);
        }

        return $this->apiResponse->success($option);
    }

    public function update(string $id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $option = Option::findOrFail($id);
            $data['updated_by'] = Auth::id();
            $option->update($data);

            return $this->apiResponse->success($option, 'Opción actualizada correctamente.');
        });
    }

    public function destroy(string $id)
    {
        return DB::transaction(function () use ($id) {
            $option = Option::findOrFail($id);
            $option->delete();

            return $this->apiResponse->success(null, 'Opción eliminada correctamente.', 200);
        });
    }
}
