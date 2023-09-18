<?php

namespace App\Http\Controllers\CORE\Role;

use App\Http\Controllers\CORE\Controller;
use App\Http\Requests\CORE\Role\RegisterRoleRequest;
use App\Http\Requests\CORE\Role\UpdateRoleRequest;
use App\Http\Resources\GenericResponseResource;
use App\Http\Resources\ModelChangeResource;
use App\Http\Resources\CORE\Role\RoleResource;
use App\Repositories\CORE\RoleRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RolesController extends Controller
{
    /**
     * @var RoleRepository
     */
    private RoleRepository $roleRepository;

    /**
     * @param RoleRepository $roleRepository
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function index(Request $request): JsonResponse|AnonymousResourceCollection
    {
        try {
            $params = $request->all();

            return $this->roleRepository->list($params);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param RegisterRoleRequest $request
     * @return ModelChangeResource|JsonResponse
     */
    public function store(RegisterRoleRequest $request): ModelChangeResource|JsonResponse
    {
        try {
            $data = $request->all();

            return $this->roleRepository->createOrUpdate($data);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param $id
     * @return GenericResponseResource|RoleResource|JsonResponse
     */
    public function show($id): GenericResponseResource|RoleResource|JsonResponse
    {
        try {
            return $this->roleRepository->find($id);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param UpdateRoleRequest $request
     * @param $id
     * @return ModelChangeResource|JsonResponse
     */
    public function update(UpdateRoleRequest $request, $id): ModelChangeResource|JsonResponse
    {
        try {
            $data = $request->all();

            return $this->roleRepository->createOrUpdate($data, $id);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }
}
