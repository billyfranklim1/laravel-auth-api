<?php

namespace App\Repositories\CORE;

use App\Http\Resources\CORE\UnitGroup\UnitGroupResource;
use App\Http\Resources\GenericResponseResource;
use App\Models\CORE\UnitGroup;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UnitGroupRepository
{
    /**
     * @var UnitGroup
     */
    private UnitGroup $model;

    /**
     * @param UnitGroup $model
     */
    public function __construct(UnitGroup $model)
    {
        $this->model = $model;
    }

    /**
     * @param $id
     * @return UnitGroupResource|GenericResponseResource
     */
    public function find($id): UnitGroupResource|GenericResponseResource
    {
        $unitGroup = $this->model->find($id);

        if (empty($unitGroup)) return new GenericResponseResource(
            'Grupo de Unidade não encontrado',
            Response::HTTP_NOT_FOUND
        );

        return new UnitGroupResource($unitGroup);
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
                $q->where('group', 'like', $searchTerm);
            });
        }

        $query->orderBy('created_at', 'desc');

        return UnitGroupResource::collection($query->paginate($perPage, ['*'], 'page', $page));
    }
}
