<?php

namespace App\Repositories\Webclin;

use App\Http\Resources\Webclin\Postoperative\PostoperativeResource;
use App\Http\Resources\GenericResponseResource;
use App\Http\Resources\ModelChangeResource;
use App\Http\Resources\Webclin\Antibiotic\AntibioticResource;
use App\Models\Webclin\Postoperative;
use App\Models\Webclin\Antibiotic;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PostoperativeRepository
{
    /**
     * @var Postoperative
     */
    private Postoperative $model;

    /**
     * @param Postoperative $model
     */
    public function __construct(Postoperative $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $params
     * @param $postoperativeId
     * @return ModelChangeResource
     */
    public function createOrUpdate(array $params, $postoperativeId = null): ModelChangeResource
    {
        if ($postoperativeId) {
            $postoperative = $this->model->find($postoperativeId);
            $postoperative->update([
                'description' => $params['description']
            ]);
        } else {
            $postoperative = $this->model->create([
                'description' => $params['description']
            ]);
        }

        return new ModelChangeResource($postoperative);
    }

    /**
     * @param $id
     * @return PostoperativeResource|GenericResponseResource
     */
    public function find($id): PostoperativeResource|GenericResponseResource
    {
        $postoperative = $this->model->find($id);

        if (empty($postoperative)) return new GenericResponseResource(
            'Pós Operatório não encontrado',
            Response::HTTP_NOT_FOUND
        );

        return new PostoperativeResource($postoperative);
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

        return PostoperativeResource::collection($query->paginate($perPage, ['*'], 'page', $page));
    }

    /**
     * @param $id
     * @return ModelChangeResource|GenericResponseResource
     */
    public function delete($id): ModelChangeResource|GenericResponseResource
    {
        $postoperative = $this->model->find($id);

        if (empty($postoperative)) return new GenericResponseResource(
            'Pós Operatório não encontrado',
            Response::HTTP_NOT_FOUND
        );

        $postoperative->delete();

        return new ModelChangeResource($postoperative);
    }
}
