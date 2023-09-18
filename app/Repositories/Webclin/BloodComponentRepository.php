<?php

namespace App\Repositories\Webclin;

use App\Http\Resources\Webclin\BloodComponent\BloodComponentResource;
use App\Http\Resources\GenericResponseResource;
use App\Http\Resources\ModelChangeResource;
use App\Http\Resources\Webclin\Antibiotic\AntibioticResource;
use App\Models\Webclin\BloodComponent;
use App\Models\Webclin\Antibiotic;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class BloodComponentRepository
{
    /**
     * @var BloodComponent
     */
    private BloodComponent $model;

    /**
     * @param BloodComponent $model
     */
    public function __construct(BloodComponent $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $params
     * @param $bloodComponentId
     * @return ModelChangeResource
     */
    public function createOrUpdate(array $params, $bloodComponentId = null): ModelChangeResource
    {
        if ($bloodComponentId) {
            $bloodComponent = $this->model->find($bloodComponentId);
            $bloodComponent->update([
                'description' => $params['description']
            ]);
        } else {
            $bloodComponent = $this->model->create([
                'description' => $params['description']
            ]);
        }

        return new ModelChangeResource($bloodComponent);
    }

    /**
     * @param $id
     * @return BloodComponentResource|GenericResponseResource
     */
    public function find($id): BloodComponentResource|GenericResponseResource
    {
        $bloodComponent = $this->model->find($id);

        if (empty($bloodComponent)) return new GenericResponseResource(
            'Hemocomponente não encontrado',
            Response::HTTP_NOT_FOUND
        );

        return new BloodComponentResource($bloodComponent);
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

        return BloodComponentResource::collection($query->paginate($perPage, ['*'], 'page', $page));
    }

    /**
     * @param $id
     * @return ModelChangeResource|GenericResponseResource
     */
    public function delete($id): ModelChangeResource|GenericResponseResource
    {
        $bloodComponent = $this->model->find($id);

        if (empty($bloodComponent)) return new GenericResponseResource(
            'Hemocomponente não encontrado',
            Response::HTTP_NOT_FOUND
        );

        $bloodComponent->delete();

        return new ModelChangeResource($bloodComponent);
    }
}
