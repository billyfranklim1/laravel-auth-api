<?php

namespace App\Http\Resources\CORE\Role;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
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
                'permissions' => $this->permissions->pluck('name')->all(),
            ];
        }

        return $this->resource;
    }
}
