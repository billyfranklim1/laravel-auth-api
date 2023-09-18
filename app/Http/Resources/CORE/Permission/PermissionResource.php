<?php

namespace App\Http\Resources\CORE\Permission;

use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
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
            ];
        }

        return $this->resource;
    }
}
