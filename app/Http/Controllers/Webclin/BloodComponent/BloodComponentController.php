<?php

namespace App\Http\Controllers\Webclin\BloodComponent;

use App\Http\Controllers\Controller;
use App\Http\Requests\Webclin\BloodComponent\RegisterBloodComponentRequest;
use App\Http\Requests\Webclin\BloodComponent\UpdateBloodComponentRequest;
use App\Http\Resources\Webclin\BloodComponent\BloodComponentResource;
use App\Http\Resources\GenericResponseResource;
use App\Http\Resources\ModelChangeResource;
use App\Repositories\Webclin\BloodComponentRepository;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BloodComponentController extends Controller
{
    /**
     * @var BloodComponentRepository
     */
    private BloodComponentRepository $bloodComponentRepository;

    /**
     * @param BloodComponentRepository $bloodComponentRepository
     */
    public function __construct(BloodComponentRepository $bloodComponentRepository)
    {
        $this->bloodComponentRepository = $bloodComponentRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function index(Request $request): JsonResponse|AnonymousResourceCollection
    {
        try {
            $params = $request->all();

            return $this->bloodComponentRepository->list($params);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param RegisterBloodComponentRequest $request
     * @return ModelChangeResource|JsonResponse
     */
    public function store(RegisterBloodComponentRequest $request): ModelChangeResource|JsonResponse
    {
        try {
            $data = $request->all();

            return $this->bloodComponentRepository->createOrUpdate($data);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param $id
     * @return BloodComponentResource|JsonResponse|GenericResponseResource
     */
    public function show($id): BloodComponentResource|JsonResponse|GenericResponseResource
    {
        try {
            return $this->bloodComponentRepository->find($id);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param UpdateBloodComponentRequest $request
     * @param $id
     * @return ModelChangeResource|JsonResponse
     */
    public function update(UpdateBloodComponentRequest $request, $id): ModelChangeResource|JsonResponse
    {
        try {
            $data = $request->all();

            return $this->bloodComponentRepository->createOrUpdate($data, $id);
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
            return $this->bloodComponentRepository->delete($id);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }
}
