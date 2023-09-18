<?php

namespace App\Http\Controllers\Webclin\Antibiotic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Webclin\Antibiotic\RegisterAntibioticRequest;
use App\Http\Requests\Webclin\Antibiotic\UpdateAntibioticRequest;
use App\Http\Resources\GenericResponseResource;
use App\Http\Resources\ModelChangeResource;
use App\Http\Resources\Webclin\Antibiotic\AntibioticResource;
use App\Repositories\Webclin\AntibioticRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AntibioticController extends Controller
{
    /**
     * @var AntibioticRepository
     */
    private AntibioticRepository $antibioticRepository;

    /**
     * @param AntibioticRepository $antibioticRepository
     */
    public function __construct(AntibioticRepository $antibioticRepository)
    {
        $this->antibioticRepository = $antibioticRepository;
    }

    /**
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function index(Request $request): JsonResponse|AnonymousResourceCollection
    {
        try {
            $params = $request->all();

            return $this->antibioticRepository->list($params);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param RegisterAntibioticRequest $request
     * @return ModelChangeResource|JsonResponse
     */
    public function store(RegisterAntibioticRequest $request): ModelChangeResource|JsonResponse
    {
        try {
            $data = $request->all();

            return $this->antibioticRepository->createOrUpdate($data);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param $id
     * @return AntibioticResource|JsonResponse|GenericResponseResource
     */
    public function show($id): AntibioticResource|JsonResponse|GenericResponseResource
    {
        try {
            return $this->antibioticRepository->find($id);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param UpdateAntibioticRequest $request
     * @param $id
     * @return ModelChangeResource|JsonResponse
     */
    public function update(UpdateAntibioticRequest $request, $id): ModelChangeResource|JsonResponse
    {
        try {
            $data = $request->all();

            return $this->antibioticRepository->createOrUpdate($data, $id);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param $id
     * @return GenericResponseResource|ModelChangeResource|JsonResponse
     */
    public function destroy($id): GenericResponseResource|ModelChangeResource|JsonResponse
    {
        try {
            return $this->antibioticRepository->delete($id);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

}
