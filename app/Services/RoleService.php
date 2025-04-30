<?php

namespace App\Services;

use App\Models\Role;
use App\Utils\Pagination;
use Illuminate\Support\Facades\DB;
use App\Utils\ApiResponse;

class RoleService
{
    protected $apiResponse;

    public function __construct(ApiResponse $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function index()
    {
        // Usando paginación si es necesario, en este caso con roles
        $query = Role::orderByDesc('created_at');
        $roles = Pagination::paginate($query);
        return $this->apiResponse->success($roles);
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            // Se crea el rol
            $role = Role::create($data);

            // Se devuelve la respuesta con el rol creado
            return $this->apiResponse->success($role, 'Role created successfully', 201);
        });
    }

    public function show(int $id)
    {
        // Se obtiene el rol por su ID
        $role = Role::find($id);

        // Si no se encuentra, se devuelve un error
        if (!$role) {
            return $this->apiResponse->error('Role not found', 404);
        }

        // Se devuelve la respuesta con los datos del rol
        return $this->apiResponse->success($role);
    }

    public function update(int $id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            // Se obtiene el rol
            $role = Role::find($id);

            // Si no se encuentra, se devuelve un error
            if (!$role) {
                return $this->apiResponse->error('Role not found or not updated', 404);
            }

            // Se actualiza el rol
            $role->update($data);

            // Se devuelve la respuesta con el rol actualizado
            return $this->apiResponse->success($role, 'Role updated successfully');
        });
    }

    public function destroy(int $id)
    {
        return DB::transaction(function () use ($id) {
            // Se obtiene el rol
            $role = Role::find($id);

            // Si no se encuentra, se devuelve un error
            if (!$role) {
                return $this->apiResponse->error('Role not found', 404);
            }

            // Se elimina el rol
            $role->delete();

            // Se devuelve la respuesta con el rol eliminado
            return $this->apiResponse->success(null, 'Role deleted successfully', 200);
        });
    }
}
