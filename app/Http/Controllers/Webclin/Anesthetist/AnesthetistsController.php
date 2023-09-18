<?php

namespace App\Http\Controllers\Webclin\Anesthetist;

use App\Http\Controllers\Controller;
use App\Http\Requests\Webclin\Anesthetist\RegisterAnesthetistRequest;
use App\Http\Requests\Webclin\Anesthetist\UpdateAnesthetistRequest;
use App\Http\Resources\Webclin\Anesthetist\AnesthetistResource;
use App\Http\Resources\GenericResponseResource;
use App\Http\Resources\ModelChangeResource;
use App\Repositories\Webclin\AnesthetistRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AnesthetistsController extends Controller
{
    /**
     * @var AnesthetistRepository
     */
    private AnesthetistRepository $anesthetistRepository;

    /**
     * @param AnesthetistRepository $anesthetistRepository
     */
    public function __construct(AnesthetistRepository $anesthetistRepository)
    {
        $this->anesthetistRepository = $anesthetistRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function index(Request $request): JsonResponse|AnonymousResourceCollection
    {
        try {
            $params = $request->all();

            return $this->anesthetistRepository->list($params);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param RegisterAnesthetistRequest $request
     * @return ModelChangeResource|JsonResponse
     */
    public function store(RegisterAnesthetistRequest $request): ModelChangeResource|JsonResponse
    {
        try {
            $data = $request->all();

            return $this->anesthetistRepository->createOrUpdate($data);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param $id
     * @return AnesthetistResource|JsonResponse|GenericResponseResource
     */
    public function show($id): AnesthetistResource|JsonResponse|GenericResponseResource
    {
        try {
            return $this->anesthetistRepository->find($id);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param UpdateAnesthetistRequest $request
     * @param $id
     * @return ModelChangeResource|JsonResponse
     */
    public function update(UpdateAnesthetistRequest $request, $id): ModelChangeResource|JsonResponse
    {
        try {
            $data = $request->all();

            return $this->anesthetistRepository->createOrUpdate($data, $id);
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
            return $this->anesthetistRepository->delete($id);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }
}
