<?php

namespace App\Repositories\Webclin;

use App\Http\Resources\GenericResponseResource;
use App\Http\Resources\ModelChangeResource;
use App\Http\Resources\Webclin\BloodType\BloodTypeResource;
use App\Models\Webclin\BloodType;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class BloodTypeRepository
{
    /**
     * @var BloodType
     */
    private BloodType $model;

    /**
     * @param BloodType $model
     */
    public function __construct(BloodType $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $params
     * @param $bloodTypeId
     * @return ModelChangeResource
     */
    public function createOrUpdate(array $params, $bloodTypeId = null): ModelChangeResource
    {
        if ($bloodTypeId) {
            $bloodType = $this->model->find($bloodTypeId);
            $bloodType->update([
                'description' => $params['description']
            ]);
        } else {
            $bloodType = $this->model->create([
                'description' => $params['description']
            ]);
        }

        return new ModelChangeResource($bloodType);
    }

    /**
     * @param $id
     * @return BloodTypeResource|GenericResponseResource
     */
    public function find($id): BloodTypeResource|GenericResponseResource
    {
        $bloodType = $this->model->find($id);

        if (empty($bloodType)) return new GenericResponseResource(
            'Tipo sanguíneo não encontrado',
            Response::HTTP_NOT_FOUND
        );

        return new BloodTypeResource($bloodType);
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

        return BloodTypeResource::collection($query->paginate($perPage, ['*'], 'page', $page));
    }

    /**
     * @param $id
     * @return ModelChangeResource|GenericResponseResource
     */
    public function delete($id): ModelChangeResource|GenericResponseResource
    {
        $bloodType = $this->model->find($id);

        if (empty($bloodType)) return new GenericResponseResource(
            'Tipo sanguíneo não encontrado',
            Response::HTTP_NOT_FOUND
        );

        $bloodType->delete();

        return new ModelChangeResource($bloodType);
    }
}
