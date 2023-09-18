<?php

namespace App\Http\Controllers\CORE\Unit;

use App\Http\Controllers\Controller;
use App\Http\Requests\CORE\Unit\RegisterUnitRequest;
use App\Http\Requests\CORE\Unit\UpdateUnitRequest;
use App\Http\Resources\CORE\Unit\UnitResource;
use App\Http\Resources\GenericResponseResource;
use App\Http\Resources\ModelChangeResource;
use App\Repositories\CORE\UnitRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UnitsController extends Controller
{
    /**
     * @var UnitRepository
     */
    private UnitRepository $unitRepository;

    /**
     * @param UnitRepository $unitRepository
     */
    public function __construct(UnitRepository $unitRepository)
    {
        $this->unitRepository = $unitRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function index(Request $request): JsonResponse|AnonymousResourceCollection
    {
        try {
            $params = $request->all();

            return $this->unitRepository->list($params);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param RegisterUnitRequest $request
     * @return ModelChangeResource|JsonResponse
     */
    public function store(RegisterUnitRequest $request): ModelChangeResource|JsonResponse
    {
        try {
            $data = $request->all();

            return $this->unitRepository->createOrUpdate($data);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param $id
     * @return UnitResource|JsonResponse|GenericResponseResource
     */
    public function show($id): UnitResource|JsonResponse|GenericResponseResource
    {
        try {
            return $this->unitRepository->find($id);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param UpdateUnitRequest $request
     * @param $id
     * @return ModelChangeResource|JsonResponse
     */
    public function update(UpdateUnitRequest $request, $id): ModelChangeResource|JsonResponse
    {
        try {
            $data = $request->all();

            return $this->unitRepository->createOrUpdate($data, $id);
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
            return $this->unitRepository->delete($id);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }
}
