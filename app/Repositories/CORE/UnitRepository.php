<?php

namespace App\Repositories\CORE;

use App\Http\Resources\CORE\Unit\UnitResource;
use App\Http\Resources\GenericResponseResource;
use App\Http\Resources\ModelChangeResource;
use App\Models\CORE\Unit;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UnitRepository
{
    /**
     * @var Unit
     */
    private Unit $model;

    /**
     * @param Unit $model
     */
    public function __construct(Unit $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $params
     * @param $unitId
     * @return ModelChangeResource|GenericResponseResource
     */
    public function createOrUpdate(array $params, $unitId = null): ModelChangeResource|GenericResponseResource
    {

        $data = [
            'unit' => $params['unit'],
            'unit_group_id' => (int) $params['group_id'],
            'unit_type_id' => (int) $params['type_id'],
            'address' => $params['address'] ?? null,
            'number' => $params['number'] ?? null,
            'city' => $params['city'] ?? null,
            'uf' => $params['state'] ?? null,
            'zip' => $params['zip'] ?? null,
            'complement' => $params['complement'] ?? null,
            'neighborhood' => $params['neighborhood'] ?? null,
            'phone' => $params['phone'] ?? null,
            'cnes' => $params['cnes'] ?? null,
            'cnpj' => $params['cnpj'] ?? null,
            'opening_hours' => $params['opening_hours'] ?? null,
            'has_psc' => $params['has_psc'] ?? false,
        ];
        //dd($data);

        if ($unitId) {
            $unit = $this->model->find($unitId);

            if (empty($unit)) return new GenericResponseResource(
                'Unidade não encontrada',
                Response::HTTP_NOT_FOUND
            );

            $unit->update($data);
        } else {
            $unit = $this->model->create($data);
        }

        return new ModelChangeResource($unit);
    }

    /**
     * @param $id
     * @return UnitResource|GenericResponseResource
     */
    public function find($id): UnitResource|GenericResponseResource
    {
        $unit = $this->model->find($id);

        if (empty($unit)) return new GenericResponseResource(
            'Unidade não encontrada',
            Response::HTTP_NOT_FOUND
        );

        return new UnitResource($unit);
    }

    /**
     * @param array $params
     * @return AnonymousResourceCollection
     */
    public function list(array $params): AnonymousResourceCollection
    {
        $perPage = $params['per_page'] ?? 10;
        $page = $params['page'] ?? 1;

        $query = $this->model->query()->with('unitType');

        if (isset($params['q']) && !empty($params['q'])) {
            $searchTerm = '%' . $params['q'] . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('unit', 'like', $searchTerm);
            });
        }

        $query->orderBy('created_at', 'desc');

        return UnitResource::collection($query->paginate($perPage, ['*'], 'page', $page));
    }

    /**
     * @param $id
     * @return ModelChangeResource|GenericResponseResource
     */
    public function delete($id): ModelChangeResource|GenericResponseResource
    {
        $unit = $this->model->find($id);

        if (empty($unit)) return new GenericResponseResource(
            'Unidade não encontrada',
            Response::HTTP_NOT_FOUND
        );

        $unit->delete();

        return new ModelChangeResource($unit);
    }
}
