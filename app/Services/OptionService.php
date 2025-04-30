<?php

namespace App\Services;

use App\Models\Option;
use Illuminate\Support\Facades\DB;
use App\Utils\ApiResponse;

class OptionService
{
    protected $apiResponse;

    public function __construct(ApiResponse $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function index()
    {
        $options = Option::orderByDesc('created_at')->get();
        return $this->apiResponse->success($options);
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $option = Option::create($data);
            return $this->apiResponse->success($option, 'Option created successfully', 201);
        });
    }

    public function show(int $id)
    {
        $option = Option::find($id);

        if (!$option) {
            return $this->apiResponse->error('Option not found', 404);
        }

        return $this->apiResponse->success($option);
    }

    public function update(int $id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $option = Option::find($id);

            if (!$option) {
                return $this->apiResponse->error('Option not found or not updated', 404);
            }

            $option->update($data);
            return $this->apiResponse->success($option, 'Option updated successfully');
        });
    }

    public function destroy(int $id)
    {
        return DB::transaction(function () use ($id) {
            $option = Option::find($id);

            if (!$option) {
                return $this->apiResponse->error('Option not found', 404);
            }

            $option->delete();
            return $this->apiResponse->success(null, 'Option deleted successfully', 204);
        });
    }
}
