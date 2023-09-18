<?php

namespace App\Http\Resources\CORE\UnitType;

use Illuminate\Http\Resources\Json\JsonResource;

class UnitTypeResource extends JsonResource
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
                'description' => $this->description
            ];
        }

        return $this->resource;
    }
}
