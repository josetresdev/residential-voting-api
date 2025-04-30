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
        $users = $this->userService->index();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'roles' => 'array', // Los roles son opcionales
        ]);

        $user = $this->userService->store($data);
        return response()->json($user, 201);
    }

    public function show(string $id)
    {
        $user = $this->userService->show($id);
        return response()->json($user);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'roles' => 'array',
        ]);

        $user = $this->userService->update($id, $data);
        return response()->json($user);
    }

    public function destroy(string $id)
    {
        $this->userService->destroy($id);
        return response()->json(['message' => 'User deleted successfully']);
    }
}
