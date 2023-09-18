<?php

namespace App\Repositories\Webclin;

use App\Http\Resources\GenericResponseResource;
use App\Http\Resources\ModelChangeResource;
use App\Http\Resources\Webclin\Classification\ClassificationResource;
use App\Models\Webclin\Classification;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ClassificationRepository
{
    /**
     * @var Classification
     */
    private Classification $model;

    /**
     * @param Classification $model
     */
    public function __construct(Classification $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $params
     * @param $classificationId
     * @return ModelChangeResource
     */
    public function createOrUpdate(array $params, $classificationId = null): ModelChangeResource
    {
        if ($classificationId) {
            $classification = $this->model->find($classificationId);
            $classification->update([
                'description' => $params['description']
            ]);
        } else {
            $classification = $this->model->create([
                'description' => $params['description']
            ]);
        }

        return new ModelChangeResource($classification);
    }

    /**
     * @param $id
     * @return ClassificationResource|GenericResponseResource
     */
    public function find($id): ClassificationResource|GenericResponseResource
    {
        $classification = $this->model->find($id);

        if (empty($classification)) return new GenericResponseResource(
            'Classificação não encontrada',
            Response::HTTP_NOT_FOUND
        );

        return new ClassificationResource($classification);
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

        return ClassificationResource::collection($query->paginate($perPage, ['*'], 'page', $page));
    }

    /**
     * @param $id
     * @return ModelChangeResource|GenericResponseResource
     */
    public function delete($id): ModelChangeResource|GenericResponseResource
    {
        $classification = $this->model->find($id);

        if (empty($classification)) return new GenericResponseResource(
            'Classificação não encontrada',
            Response::HTTP_NOT_FOUND
        );

        $classification->delete();

        return new ModelChangeResource($classification);
    }
}
