<?php

namespace App\Http\Resources\CORE\Unit;

use Illuminate\Http\Resources\Json\JsonResource;

class UnitResource extends JsonResource
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
                'unit' => $this->unit,
                'type_name' => $this->unitType->description,
                'type' => $this->type,
                'city' => $this->city,
            ];
        }

        return $this->resource;
    }
}
