<?php

namespace App\Repositories\Webclin;

use App\Http\Resources\Webclin\Size\SizeResource;
use App\Http\Resources\GenericResponseResource;
use App\Http\Resources\ModelChangeResource;
use App\Http\Resources\Webclin\Antibiotic\AntibioticResource;
use App\Models\Webclin\Size;
use App\Models\Webclin\Antibiotic;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class SizeRepository
{
    /**
     * @var Size
     */
    private Size $model;

    /**
     * @param Size $model
     */
    public function __construct(Size $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $params
     * @param $sizeId
     * @return ModelChangeResource
     */
    public function createOrUpdate(array $params, $sizeId = null): ModelChangeResource
    {
        if ($sizeId) {
            $size = $this->model->find($sizeId);
            $size->update([
                'description' => $params['description'],
                'time' => $params['time']
            ]);
        } else {
            $size = $this->model->create([
                'description' => $params['description'],
                'time' => $params['time']
            ]);
        }

        return new ModelChangeResource($size);
    }

    /**
     * @param $id
     * @return SizeResource|GenericResponseResource
     */
    public function find($id): SizeResource|GenericResponseResource
    {
        $size = $this->model->find($id);

        if (empty($size)) return new GenericResponseResource(
            'Porte não encontrado',
            Response::HTTP_NOT_FOUND
        );

        return new SizeResource($size);
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

        return SizeResource::collection($query->paginate($perPage, ['*'], 'page', $page));
    }

    /**
     * @param $id
     * @return ModelChangeResource|GenericResponseResource
     */
    public function delete($id): ModelChangeResource|GenericResponseResource
    {
        $size = $this->model->find($id);

        if (empty($size)) return new GenericResponseResource(
            'Porte não encontrado',
            Response::HTTP_NOT_FOUND
        );

        $size->delete();

        return new ModelChangeResource($size);
    }
}
