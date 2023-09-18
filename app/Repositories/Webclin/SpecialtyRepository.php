<?php

namespace App\Repositories\Webclin;

use App\Http\Resources\Webclin\Specialty\SpecialtyResource;
use App\Http\Resources\GenericResponseResource;
use App\Http\Resources\ModelChangeResource;
use App\Http\Resources\Webclin\Antibiotic\AntibioticResource;
use App\Models\Webclin\Specialty;
use App\Models\Webclin\Antibiotic;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class SpecialtyRepository
{
    /**
     * @var Specialty
     */
    private Specialty $model;

    /**
     * @param Specialty $model
     */
    public function __construct(Specialty $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $params
     * @param $specialtyId
     * @return ModelChangeResource
     */
    public function createOrUpdate(array $params, $specialtyId = null): ModelChangeResource
    {
        if ($specialtyId) {
            $specialty = $this->model->find($specialtyId);
            $specialty->update([
                'description' => $params['description']
            ]);
        } else {
            $specialty = $this->model->create([
                'description' => $params['description']
            ]);
        }

        return new ModelChangeResource($specialty);
    }

    /**
     * @param $id
     * @return SpecialtyResource|GenericResponseResource
     */
    public function find($id): SpecialtyResource|GenericResponseResource
    {
        $specialty = $this->model->find($id);

        if (empty($specialty)) return new GenericResponseResource(
            'Especialidade não encontrada',
            Response::HTTP_NOT_FOUND
        );

        return new SpecialtyResource($specialty);
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

        return SpecialtyResource::collection($query->paginate($perPage, ['*'], 'page', $page));
    }

    /**
     * @param $id
     * @return ModelChangeResource|GenericResponseResource
     */
    public function delete($id): ModelChangeResource|GenericResponseResource
    {
        $specialty = $this->model->find($id);

        if (empty($specialty)) return new GenericResponseResource(
            'Especialidade não encontrada',
            Response::HTTP_NOT_FOUND
        );

        $specialty->delete();

        return new ModelChangeResource($specialty);
    }
}
