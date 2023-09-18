<?php

namespace App\Http\Controllers\Webclin\Classification;

use App\Http\Controllers\Controller;
use App\Http\Requests\Webclin\Classification\RegisterClassificationRequest;
use App\Http\Requests\Webclin\Classification\UpdateClassificationRequest;
use App\Http\Resources\GenericResponseResource;
use App\Http\Resources\ModelChangeResource;
use App\Http\Resources\Webclin\Classification\ClassificationResource;
use App\Repositories\Webclin\ClassificationRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ClassificationController extends Controller
{
    /**
     * @var ClassificationRepository
     */
    private ClassificationRepository $classificationRepository;

    /**
     * @param ClassificationRepository $classificationRepository
     */
    public function __construct(ClassificationRepository $classificationRepository)
    {
        $this->classificationRepository = $classificationRepository;
    }

    /**
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function index(Request $request): JsonResponse|AnonymousResourceCollection
    {
        try {
            $params = $request->all();

            return $this->classificationRepository->list($params);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param RegisterClassificationRequest $request
     * @return ModelChangeResource|JsonResponse
     */
    public function store(RegisterClassificationRequest $request): ModelChangeResource|JsonResponse
    {
        try {
            $data = $request->all();

            return $this->classificationRepository->createOrUpdate($data);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param $id
     * @return ClassificationResource|JsonResponse|GenericResponseResource
     */
    public function show($id): ClassificationResource|JsonResponse|GenericResponseResource
    {
        try {
            return $this->classificationRepository->find($id);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param UpdateClassificationRequest $request
     * @param $id
     * @return ModelChangeResource|JsonResponse
     */
    public function update(UpdateClassificationRequest $request, $id): ModelChangeResource|JsonResponse
    {
        try {
            $data = $request->all();

            return $this->classificationRepository->createOrUpdate($data, $id);
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
            return $this->classificationRepository->delete($id);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

}
