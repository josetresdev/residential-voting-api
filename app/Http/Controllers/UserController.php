<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return $this->userService->index();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'roles' => 'nullable|array',
        ]);
    
        return $this->userService->store($data);
    }

    public function show(string $id)
    {
        return $this->userService->show($id);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'roles' => 'array',
        ]);

        return $this->userService->update($id, $data);
    }

    public function destroy(string $id)
    {
        return $this->userService->destroy($id);
    }
}
