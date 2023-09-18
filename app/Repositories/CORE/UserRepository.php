<?php

namespace App\Repositories\CORE;

use App\Http\Resources\GenericResponseResource;
use App\Http\Resources\ModelChangeResource;
use App\Http\Resources\CORE\User\UserResource;
use App\Models\CORE\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    /**
     * @var User
     */
    private User $model;

    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $params
     * @param $userId
     * @return mixed
     */
    public function createOrUpdate(array $params, $userId = null): mixed
    {
        $dataUser = $params['user'];

        if ($userId) {
            $user = $this->model->find($userId);
        } else {
            $user = $this->model->create([
                'name' => $dataUser['name'],
                'email' => $dataUser['email'],
                'password' => Hash::make($dataUser['password']),
            ]);
        }
        $user->syncPermissions($params['permissions'] ?? []);
        $user->syncRoles($params['roles'] ?? []);
        $user->syncSystems($params['systems'] ?? []);
        $user->syncUnits($params['units'] ?? []);
        if ($userId) {
            $user->update([
                'name' => $dataUser['name'],
                'email' => $dataUser['email']
            ]);
        }

        return new ModelChangeResource($user);
    }

    /**
     * @param string $email
     * @return UserResource
     */
    public function findByEmail(string $email): UserResource
    {
        $user = $this->model->where('email', $email)->select('id', 'name', 'email')->first();
        return new UserResource($user);
    }

    /**
     * @param $id
     * @return UserResource|GenericResponseResource
     */
    public function find($id): UserResource|GenericResponseResource
    {
        if ($id == 'me') {
            $id = Auth::id();
        }
        $user = $this->model->find($id);

        if (empty($user)) return new GenericResponseResource(
            'Usuário não encontrado',
            Response::HTTP_NOT_FOUND
        );

        return new UserResource($user);
    }

    /**
     * @param array $params
     * @return AnonymousResourceCollection
     */
    public function list(array $params): AnonymousResourceCollection
    {
        $perPage = $params['per_page'] ?? 10;
        $page = $params['page'] ?? 1;

        $query = $this->model->query();

        if (isset($params['q']) && !empty($params['q'])) {
            $searchTerm = '%' . $params['q'] . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                    ->orWhere('email', 'like', $searchTerm);
            });
        }

        if (isset($params['system']) && !empty($params['system'])) {
            $query->whereHas('userSystems', function ($q) use ($params) {
                $q->where('system_id', $params['system']);
            });
        }

        if (isset($params['unit']) && !empty($params['unit'])) {
            $query->whereHas('userUnits', function ($q) use ($params) {
                $q->where('unit_id', $params['unit']);
            });
        }

        if (isset($params['role']) && !empty($params['role'])) {
            $role = $params['role'];
            $query->whereHas('roles', function ($q) use ($role) {
                $q->where('id', $role);
            });
        }

        $query->orderBy('created_at', 'desc');

        return UserResource::collection($query->paginate($perPage, ['*'], 'page', $page));
    }


    public function delete($id): GenericResponseResource
    {
        $user = $this->model->find($id);

        if (empty($user)) {
            return new GenericResponseResource(
                'Usuário não encontrado',
                Response::HTTP_NOT_FOUND
            );
        }

        $user->delete();

        return new GenericResponseResource(
            'Usuário deletado com sucesso',
            Response::HTTP_OK
        );
    }
}
