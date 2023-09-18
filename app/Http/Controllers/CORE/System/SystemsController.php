<?php

namespace App\Http\Controllers\CORE\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\CORE\System\RegisterSystemRequest;
use App\Http\Requests\CORE\System\UpdateSystemRequest;
use App\Http\Resources\GenericResponseResource;
use App\Http\Resources\ModelChangeResource;
use App\Http\Resources\CORE\System\SystemsResource;
use App\Repositories\CORE\SystemsRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SystemsController extends Controller
{
    /**
     * @var SystemsRepository
     */
    private SystemsRepository $systemsRepository;

    /**
     * @param SystemsRepository $systemsRepository
     */
    public function __construct(SystemsRepository $systemsRepository)
    {
        $this->systemsRepository = $systemsRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function index(Request $request): JsonResponse|AnonymousResourceCollection
    {
        try {
            $params = $request->all();

            return $this->systemsRepository->list($params);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param RegisterSystemRequest $request
     * @return ModelChangeResource|JsonResponse
     */
    public function store(RegisterSystemRequest $request): ModelChangeResource|JsonResponse
    {
        try {
            $data = $request->all();

            return $this->systemsRepository->createOrUpdate($data);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param $id
     * @return SystemsResource|JsonResponse|GenericResponseResource
     */
    public function show($id): SystemsResource|JsonResponse|GenericResponseResource
    {
        try {
            return $this->systemsRepository->find($id);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param UpdateSystemRequest $request
     * @param $id
     * @return ModelChangeResource|JsonResponse
     */
    public function update(UpdateSystemRequest $request, $id): ModelChangeResource|JsonResponse
    {
        try {
            $data = $request->all();

            return $this->systemsRepository->createOrUpdate($data, $id);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }
}
