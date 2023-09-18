<?php

namespace App\Http\Resources\CORE\UnitGroup;

use Illuminate\Http\Resources\Json\JsonResource;

class UnitGroupResource extends JsonResource
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
                'group' => $this->group
            ];
        }

        return $this->resource;
    }
}
