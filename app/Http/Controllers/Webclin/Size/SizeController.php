<?php

namespace App\Http\Controllers\Webclin\Size;

use App\Http\Controllers\Controller;
use App\Http\Requests\Webclin\Size\RegisterSizeRequest;
use App\Http\Requests\Webclin\Size\UpdateSizeRequest;
use App\Http\Resources\Webclin\Size\SizeResource;
use App\Http\Resources\GenericResponseResource;
use App\Http\Resources\ModelChangeResource;
use App\Repositories\Webclin\SizeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SizeController extends Controller
{
    /**
     * @var SizeRepository
     */
    private SizeRepository $sizeRepository;

    /**
     * @param SizeRepository $sizeRepository
     */
    public function __construct(SizeRepository $sizeRepository)
    {
        $this->sizeRepository = $sizeRepository;
    }

    /**
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function index(Request $request): JsonResponse|AnonymousResourceCollection
    {
        try {
            $params = $request->all();

            return $this->sizeRepository->list($params);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param RegisterSizeRequest $request
     * @return ModelChangeResource|JsonResponse
     */
    public function store(RegisterSizeRequest $request): ModelChangeResource|JsonResponse
    {
        try {
            $data = $request->all();

            return $this->sizeRepository->createOrUpdate($data);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param $id
     * @return SizeResource|JsonResponse|GenericResponseResource
     */
    public function show($id): SizeResource|JsonResponse|GenericResponseResource
    {
        try {
            return $this->sizeRepository->find($id);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param UpdateSizeRequest $request
     * @param $id
     * @return ModelChangeResource|JsonResponse
     */
    public function update(UpdateSizeRequest $request, $id): ModelChangeResource|JsonResponse
    {
        try {
            $data = $request->all();

            return $this->sizeRepository->createOrUpdate($data, $id);
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
            return $this->sizeRepository->delete($id);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }
}
