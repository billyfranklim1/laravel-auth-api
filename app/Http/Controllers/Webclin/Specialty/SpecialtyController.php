<?php

namespace App\Http\Controllers\Webclin\Specialty;

use App\Http\Controllers\Controller;
use App\Http\Requests\Webclin\Specialty\RegisterSpecialtyRequest;
use App\Http\Requests\Webclin\Specialty\UpdateSpecialtyRequest;
use App\Http\Resources\Webclin\Specialty\SpecialtyResource;
use App\Http\Resources\GenericResponseResource;
use App\Http\Resources\ModelChangeResource;
use App\Repositories\Webclin\SpecialtyRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SpecialtyController extends Controller
{
    /**
     * @var SpecialtyRepository
     */
    private SpecialtyRepository $specialtyRepository;

    /**
     * @param SpecialtyRepository $specialtyRepository
     */
    public function __construct(SpecialtyRepository $specialtyRepository)
    {
        $this->specialtyRepository = $specialtyRepository;
    }

    /**
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function index(Request $request): JsonResponse|AnonymousResourceCollection
    {
        try {
            $params = $request->all();

            return $this->specialtyRepository->list($params);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param RegisterSpecialtyRequest $request
     * @return ModelChangeResource|JsonResponse
     */
    public function store(RegisterSpecialtyRequest $request): ModelChangeResource|JsonResponse
    {
        try {
            $data = $request->all();

            return $this->specialtyRepository->createOrUpdate($data);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param $id
     * @return SpecialtyResource|JsonResponse|GenericResponseResource
     */
    public function show($id): SpecialtyResource|JsonResponse|GenericResponseResource
    {
        try {
            return $this->specialtyRepository->find($id);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param UpdateSpecialtyRequest $request
     * @param $id
     * @return ModelChangeResource|JsonResponse
     */
    public function update(UpdateSpecialtyRequest $request, $id): ModelChangeResource|JsonResponse
    {
        try {
            $data = $request->all();

            return $this->specialtyRepository->createOrUpdate($data, $id);
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
            return $this->specialtyRepository->delete($id);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }
}
