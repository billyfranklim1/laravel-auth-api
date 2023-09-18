<?php

namespace App\Repositories\CORE;

use App\Http\Resources\GenericResponseResource;
use App\Http\Resources\ModelChangeResource;
use App\Http\Resources\CORE\Role\RoleResource;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class RoleRepository
{
    /**
     * @var Role
     */
    private Role $model;

    /**
     * @param Role $model
     */
    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $params
     * @param $roleId
     * @return mixed
     */
    public function createOrUpdate(array $params, $roleId = null): mixed
    {
        if ($roleId) {
            $role = $this->model->find($roleId);
        } else {
            $role = $this->model->create([
                'name' => $params['name'],
                'guard_name' => 'web'
            ]);
        }
        $role->syncPermissions($params['permissions'] ?? []);
        if ($roleId) {
            $role->update([
                'name' => $params['name'],
            ]);
        }

        return new ModelChangeResource($role);
    }

    /**
     * @param $id
     * @return RoleResource|GenericResponseResource
     */
    public function find($id): RoleResource|GenericResponseResource
    {
        $system = $this->model->find($id);

        if (empty($system)) return new GenericResponseResource(
            'Sistema não encontrado',
            Response::HTTP_NOT_FOUND
        );

        return new RoleResource($system);
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function list(array $params): AnonymousResourceCollection
    {
        $perPage = $params['per_page'] ?? 10;
        $page = $params['page'] ?? 1;

        $query = $this->model->query();

        if (isset($params['q']) && !empty($params['q'])) {
            $searchTerm = '%' . $params['q'] . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm);
            });
        }

        if (isset($params['permission']) && !empty($params['permission'])) {
            $role = $params['permission'];
            $query->whereHas('permissions', function ($q) use ($role) {
                $q->where('name', $role);
            });
        }

        $query->orderBy('created_at', 'desc');

        return RoleResource::collection($query->paginate($perPage, ['*'], 'page', $page));
    }
}
