<?php

namespace App\Repositories\Webclin;

use App\Http\Resources\GenericResponseResource;
use App\Http\Resources\ModelChangeResource;
use App\Http\Resources\Webclin\Antibiotic\AntibioticResource;
use App\Models\Webclin\Antibiotic;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class AntibioticRepository
{
    /**
     * @var Antibiotic
     */
    private Antibiotic $model;

    /**
     * @param Antibiotic $model
     */
    public function __construct(Antibiotic $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $params
     * @param $antibioticId
     * @return ModelChangeResource
     */
    public function createOrUpdate(array $params, $antibioticId = null): ModelChangeResource
    {
        if ($antibioticId) {
            $antibiotic = $this->model->find($antibioticId);
            $antibiotic->update([
                'description' => $params['description']
            ]);
        } else {
            $antibiotic = $this->model->create([
                'description' => $params['description']
            ]);
        }

        return new ModelChangeResource($antibiotic);
    }

    /**
     * @param $id
     * @return AntibioticResource|GenericResponseResource
     */
    public function find($id): AntibioticResource|GenericResponseResource
    {
        $antibiotic = $this->model->find($id);

        if (empty($antibiotic)) return new GenericResponseResource(
            'Antibiótico não encontrado',
            Response::HTTP_NOT_FOUND
        );

        return new AntibioticResource($antibiotic);
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

        return AntibioticResource::collection($query->paginate($perPage, ['*'], 'page', $page));
    }

    /**
     * @param $id
     * @return ModelChangeResource|GenericResponseResource
     */
    public function delete($id): ModelChangeResource|GenericResponseResource
    {
        $antibiotic = $this->model->find($id);

        if (empty($antibiotic)) return new GenericResponseResource(
            'Antibiótico não encontrado',
            Response::HTTP_NOT_FOUND
        );

        $antibiotic->delete();

        return new ModelChangeResource($antibiotic);
    }
}
