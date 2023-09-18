<?php

namespace App\Http\Resources\Auth;

use App\Models\CORE\User;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class SuccessfulLoginResource extends JsonResource
{
    /**
     * @param $request
     * @return array|Arrayable|JsonResponse|\JsonSerializable
     */
    public function toArray($request): array|Arrayable|JsonResponse|\JsonSerializable
    {
        $user = User::where('email', $request->email)->with('userUnits', function ($query) {
            $query->with('hasUnit');
        })->first();

        return [
            'message' => 'Usuário logado com sucesso',
            'user'    => $user,
            'token'   => $user->createToken("API TOKEN")->plainTextToken,
        ];
    }
}
