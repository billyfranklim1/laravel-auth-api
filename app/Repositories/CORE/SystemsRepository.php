<?php

namespace App\Repositories\CORE;

use App\Http\Resources\GenericResponseResource;
use App\Http\Resources\ModelChangeResource;
use App\Http\Resources\CORE\System\SystemsResource;
use App\Http\Resources\CORE\User\UserResource;
use App\Models\CORE\System;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class SystemsRepository
{
    /**
     * @var System
     */
    private System $model;

    /**
     * @param System $model
     */
    public function __construct(System $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $params
     * @param $systemId
     * @return ModelChangeResource
     */
    public function createOrUpdate(array $params, $systemId = null): ModelChangeResource
    {
        if ($systemId) {
            $system = $this->model->find($systemId);
            $system->update([
                'system' => $params['system']
            ]);
        } else {
            $system = $this->model->create([
                'system' => $params['system']
            ]);
        }

        return new ModelChangeResource($system);
    }

    /**
     * @param $id
     * @return SystemsResource|GenericResponseResource
     */
    public function find($id): SystemsResource|GenericResponseResource
    {
        $system = $this->model->find($id);

        if (empty($system)) return new GenericResponseResource(
            'Sistema não encontrado',
            Response::HTTP_NOT_FOUND
        );

        return new SystemsResource($system);
    }

    /**
     * @param array $params
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
                $q->where('system', 'like', $searchTerm);
            });
        }

        $query->orderBy('created_at', 'desc');

        return SystemsResource::collection($query->paginate($perPage, ['*'], 'page', $page));
    }
}
