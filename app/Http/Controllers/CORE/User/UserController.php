<?php

namespace App\Http\Controllers\CORE\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CORE\User\RegisterUserRequest;
use App\Http\Requests\CORE\User\UpdateUserRequest;
use App\Http\Resources\GenericResponseResource;
use App\Http\Resources\ModelChangeResource;
use App\Http\Resources\CORE\User\UserResource;
use App\Repositories\CORE\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function index(Request $request): JsonResponse|AnonymousResourceCollection
    {
        try {
            $params = $request->all();
            return $this->userRepository->list($params);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param RegisterUserRequest $request
     * @return ModelChangeResource|JsonResponse
     */
    public function store(RegisterUserRequest $request): ModelChangeResource|JsonResponse
    {
        try {
            $data = $request->all();

            return $this->userRepository->createOrUpdate($data);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param $id
     * @return GenericResponseResource|UserResource|JsonResponse
     */
    public function show($id): GenericResponseResource|UserResource|JsonResponse
    {
        try {
            return $this->userRepository->find($id);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @param UpdateUserRequest $request
     * @param $id
     * @return ModelChangeResource|JsonResponse
     */
    public function update(UpdateUserRequest $request, $id): ModelChangeResource|JsonResponse
    {
        try {
            $params = $request->all();

            return $this->userRepository->createOrUpdate($params, $id);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    // delete

    /**
     * @param $id
     * @return GenericResponseResource|JsonResponse
     */
    public function destroy($id): GenericResponseResource|JsonResponse
    {
        try {
            return $this->userRepository->delete($id);
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }
}
