<?php

namespace App\Http\Controllers\CORE\UnitType;

use App\Http\Controllers\Controller;
use App\Http\Requests\CORE\UnitType\RegisterUnitTypeRequest;
use App\Http\Requests\CORE\UnitType\UpdateUnitTypeRequest;
use App\Http\Resources\CORE\UnitType\UnitTypeResource;
use App\Http\Resources\GenericResponseResource;
use App\Http\Resources\ModelChangeResource;
use App\Repositories\CORE\UnitTypeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UnitTypeController extends Controller
{
    /**
     * @var UnitTypeRepository
     */
    private UnitTypeRepository $unitTypeRepository;

    /**
     * @param UnitTypeRepository $unitTypeRepository
     */
    public function __construct(UnitTypeRepository $unitTypeRepository)
    {
        $this->unitTypeRepository = $unitTypeRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function index(Request $request): JsonResponse|AnonymousResourceCollection
    {
        try {
            $params = $request->all();

            return $this->unitTypeRepository->list($params);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param RegisterUnitTypeRequest $request
     * @return ModelChangeResource|JsonResponse
     */
    public function store(RegisterUnitTypeRequest $request): ModelChangeResource|JsonResponse
    {
        try {
            $data = $request->all();

            return $this->unitTypeRepository->createOrUpdate($data);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param $id
     * @return UnitTypeResource|JsonResponse|GenericResponseResource
     */
    public function show($id): UnitTypeResource|JsonResponse|GenericResponseResource
    {
        try {
            return $this->unitTypeRepository->find($id);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param UpdateUnitTypeRequest $request
     * @param $id
     * @return ModelChangeResource|JsonResponse|GenericResponseResource
     */
    public function update(UpdateUnitTypeRequest $request, $id): ModelChangeResource|JsonResponse|GenericResponseResource
    {
        try {
            $data = $request->all();

            return $this->unitTypeRepository->createOrUpdate($data, $id);
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
            return $this->unitTypeRepository->delete($id);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }
}
