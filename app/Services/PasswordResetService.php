<?php

namespace App\Services;

use App\Models\PasswordReset;
use Illuminate\Support\Facades\DB;
use App\Utils\ApiResponse;

class PasswordResetService
{
    protected $apiResponse;

    public function __construct(ApiResponse $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function index()
    {
        $passwordResets = PasswordReset::orderByDesc('created_at')->get();
        return $this->apiResponse->success($passwordResets);
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $passwordReset = PasswordReset::create($data);
            return $this->apiResponse->success($passwordReset, 'Password reset created successfully', 201);
        });
    }

    public function show(int $id)
    {
        $passwordReset = PasswordReset::find($id);

        if (!$passwordReset) {
            return $this->apiResponse->error('Password reset request not found', 404);
        }

        return $this->apiResponse->success($passwordReset);
    }

    public function update(int $id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $passwordReset = PasswordReset::find($id);

            if (!$passwordReset) {
                return $this->apiResponse->error('Password reset request not found or not updated', 404);
            }

            $passwordReset->update($data);
            return $this->apiResponse->success($passwordReset, 'Password reset request updated successfully');
        });
    }

    public function destroy(int $id)
    {
        return DB::transaction(function () use ($id) {
            $passwordReset = PasswordReset::find($id);

            if (!$passwordReset) {
                return $this->apiResponse->error('Password reset request not found', 404);
            }

            $passwordReset->delete();
            return $this->apiResponse->success(null, 'Password reset request deleted successfully', 204);
        });
    }
}
