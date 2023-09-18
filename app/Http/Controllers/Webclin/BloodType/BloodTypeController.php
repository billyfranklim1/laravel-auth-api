<?php

namespace App\Http\Controllers\Webclin\BloodType;

use App\Http\Controllers\Controller;
use App\Http\Requests\Webclin\BloodType\RegisterBloodTypeRequest;
use App\Http\Requests\Webclin\BloodType\UpdateBloodTypeRequest;
use App\Http\Resources\GenericResponseResource;
use App\Http\Resources\ModelChangeResource;
use App\Http\Resources\Webclin\BloodType\BloodTypeResource;
use App\Repositories\Webclin\BloodTypeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BloodTypeController extends Controller
{
    /**
     * @var BloodTypeRepository
     */
    private BloodTypeRepository $bloodTypeRepository;

    /**
     * @param BloodTypeRepository $bloodTypeRepository
     */
    public function __construct(BloodTypeRepository $bloodTypeRepository)
    {
        $this->bloodTypeRepository = $bloodTypeRepository;
    }

    /**
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function index(Request $request): JsonResponse|AnonymousResourceCollection
    {
        try {
            $params = $request->all();

            return $this->bloodTypeRepository->list($params);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param RegisterBloodTypeRequest $request
     * @return ModelChangeResource|JsonResponse
     */
    public function store(RegisterBloodTypeRequest $request): ModelChangeResource|JsonResponse
    {
        try {
            $data = $request->all();

            return $this->bloodTypeRepository->createOrUpdate($data);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param $id
     * @return BloodTypeResource|JsonResponse|GenericResponseResource
     */
    public function show($id): BloodTypeResource|JsonResponse|GenericResponseResource
    {
        try {
            return $this->bloodTypeRepository->find($id);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param UpdateBloodTypeRequest $request
     * @param $id
     * @return ModelChangeResource|JsonResponse
     */
    public function update(UpdateBloodTypeRequest $request, $id): ModelChangeResource|JsonResponse
    {
        try {
            $data = $request->all();

            return $this->bloodTypeRepository->createOrUpdate($data, $id);
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
            return $this->bloodTypeRepository->delete($id);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

}
