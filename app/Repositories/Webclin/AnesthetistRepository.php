<?php

namespace App\Repositories\Webclin;

use App\Http\Resources\Webclin\Anesthetist\AnesthetistResource;
use App\Http\Resources\GenericResponseResource;
use App\Http\Resources\ModelChangeResource;
use App\Http\Resources\Webclin\Antibiotic\AntibioticResource;
use App\Models\Webclin\Anesthetist;
use App\Models\Webclin\Antibiotic;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class AnesthetistRepository
{
    /**
     * @var Anesthetist
     */
    private Anesthetist $model;

    /**
     * @param Anesthetist $model
     */
    public function __construct(Anesthetist $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $params
     * @param $anesthetistId
     * @return ModelChangeResource
     */
    public function createOrUpdate(array $params, $anesthetistId = null): ModelChangeResource
    {
        if ($anesthetistId) {
            $anesthetist = $this->model->find($anesthetistId);
            $anesthetist->update([
                'name' => $params['name']
            ]);
        } else {
            $anesthetist = $this->model->create([
                'name' => $params['name']
            ]);
        }

        return new ModelChangeResource($anesthetist);
    }

    /**
     * @param $id
     * @return AnesthetistResource|GenericResponseResource
     */
    public function find($id): AnesthetistResource|GenericResponseResource
    {
        $anesthetist = $this->model->find($id);

        if (empty($anesthetist)) return new GenericResponseResource(
            'Anestesista não encontrado',
            Response::HTTP_NOT_FOUND
        );

        return new AnesthetistResource($anesthetist);
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
                $q->where('name', 'like', $searchTerm);
            });
        }

        $query->orderBy('created_at', 'desc');

        return AnesthetistResource::collection($query->paginate($perPage, ['*'], 'page', $page));
    }

    /**
     * @param $id
     * @return ModelChangeResource|GenericResponseResource
     */
    public function delete($id): ModelChangeResource|GenericResponseResource
    {
        $anesthetist = $this->model->find($id);

        if (empty($anesthetist)) return new GenericResponseResource(
            'Anestesista não encontrado',
            Response::HTTP_NOT_FOUND
        );

        $anesthetist->delete();

        return new ModelChangeResource($anesthetist);
    }
}
