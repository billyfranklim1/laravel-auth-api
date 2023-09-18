<?php

namespace App\Repositories\CORE;

use App\Http\Resources\CORE\Permission\PermissionResource;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PermissionRepository
{
    /**
     * @var Permission
     */
    private Permission $model;

    /**
     * @param Permission $model
     */
    public function __construct(Permission $model)
    {
        $this->model = $model;
    }


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

        $query->orderBy('created_at', 'desc');

        return PermissionResource::collection($query->paginate($perPage, ['*'], 'page', $page));
    }
}
