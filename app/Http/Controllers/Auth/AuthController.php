<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\GenericResponseResource;
use App\Http\Resources\Auth\SuccessfulLoginResource;
use App\Repositories\CORE\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
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
     * @param LoginRequest $request
     * @return JsonResponse|SuccessfulLoginResource|GenericResponseResource
     */
    public function login(LoginRequest $request): JsonResponse|SuccessfulLoginResource|GenericResponseResource
    {
        try {
            if(!Auth::attempt($request->only(['email', 'password']))){
                return new GenericResponseResource(
                    'Email e/ou senha incorretas',
                    Response::HTTP_UNAUTHORIZED
                );
            }

            $system = $request->system;
            $user = $this->userRepository->findByEmail($request->email);

            if (!$user->verifySystemAccess($system)) {
                return new GenericResponseResource(
                    'Usuário não autorizado a utilizar o sistema',
                    Response::HTTP_UNAUTHORIZED
                );
            } elseif ($system === 4 && empty($user->getUnitNames())) {
                return new GenericResponseResource(
                    'Usuário sem unidades vinculadas',
                    Response::HTTP_UNAUTHORIZED
                );
            } else {
                return new SuccessfulLoginResource($request);
            }
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }

    /**
     * @return GenericResponseResource|JsonResponse
     */
    public function logout(): GenericResponseResource|JsonResponse
    {
        try {
            Auth::logout();

            return new GenericResponseResource(
                'Successfully logged out'
            );
        } catch (\Throwable $th) {
            return $this->internalServerErrorResponse($th);
        }
    }
}
