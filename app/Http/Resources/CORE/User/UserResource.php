<?php

namespace App\Http\Resources\CORE\User;

use App\Models\CORE\UserSystems;
use App\Models\CORE\System;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {

        if (isset($this->id)) {

            return [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'permissions' => $this->getAllPermissions()->pluck('nmasame')->all(),
                'roles' => $this->getRoleNames(),
                'systems' => $this->getSystemNames(),
                'units' => $this->getUnitNames()
            ];
        }

        return $this->resource;
    }
}
