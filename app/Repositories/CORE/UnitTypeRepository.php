<?php

namespace App\Repositories\CORE;

use App\Http\Resources\CORE\UnitType\UnitTypeResource;
use App\Http\Resources\GenericResponseResource;
use App\Http\Resources\ModelChangeResource;
use App\Models\CORE\UnitType;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UnitTypeRepository
{
    /**
     * @var UnitType
     */
    private UnitType $model;

    /**
     * @param UnitType $model
     */
    public function __construct(UnitType $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $params
     * @param $unitTypeId
     * @return ModelChangeResource|GenericResponseResource
     */
    public function createOrUpdate(array $params, $unitTypeId = null): ModelChangeResource|GenericResponseResource
    {
        if ($unitTypeId) {
            $unitType = $this->model->find($unitTypeId);

            if (empty($unitType)) return new GenericResponseResource(
                'Tipo de Unidade não encontrada',
                Response::HTTP_NOT_FOUND
            );

            $unitType->update([
                'description' => $params['description']
            ]);
        } else {
            $unitType = $this->model->create([
                'description' => $params['description']
            ]);
        }

        return new ModelChangeResource($unitType);
    }

    /**
     * @param $id
     * @return UnitTypeResource|GenericResponseResource
     */
    public function find($id): UnitTypeResource|GenericResponseResource
    {
        $unitType = $this->model->find($id);

        if (empty($unitType)) return new GenericResponseResource(
            'Tipo de Unidade não encontrada',
            Response::HTTP_NOT_FOUND
        );

        return new UnitTypeResource($unitType);
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
                $q->where('description', 'like', $searchTerm);
            });
        }

        $query->orderBy('created_at', 'desc');

        return UnitTypeResource::collection($query->paginate($perPage, ['*'], 'page', $page));
    }

    /**
     * @param $id
     * @return ModelChangeResource|GenericResponseResource
     */
    public function delete($id): ModelChangeResource|GenericResponseResource
    {
        $unitType = $this->model->find($id);

        if (empty($unitType)) return new GenericResponseResource(
            'Tipo de Unidade não encontrada',
            Response::HTTP_NOT_FOUND
        );

        $unitType->delete();

        return new ModelChangeResource($unitType);
    }
}
