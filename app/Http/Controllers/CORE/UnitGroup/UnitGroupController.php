<?php

namespace App\Http\Controllers\CORE\UnitGroup;

use App\Http\Controllers\Controller;
use App\Http\Resources\CORE\UnitGroup\UnitGroupResource;
use App\Http\Resources\GenericResponseResource;
use App\Http\Resources\ModelChangeResource;
use App\Repositories\CORE\UnitGroupRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UnitGroupController extends Controller
{
    /**
     * @var UnitGroupRepository
     */
    private UnitGroupRepository $unitGroupRepository;

    /**
     * @param UnitGroupRepository $unitGroupRepository
     */
    public function __construct(UnitGroupRepository $unitGroupRepository)
    {
        $this->unitGroupRepository = $unitGroupRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function index(Request $request): JsonResponse|AnonymousResourceCollection
    {
        try {
            $params = $request->all();

            return $this->unitGroupRepository->list($params);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param $id
     * @return UnitGroupResource|JsonResponse|GenericResponseResource
     */
    public function show($id): UnitGroupResource|JsonResponse|GenericResponseResource
    {
        try {
            return $this->unitGroupRepository->find($id);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }
}
