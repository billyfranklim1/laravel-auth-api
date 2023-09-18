<?php

namespace App\Http\Resources\Webclin\Size;

use Illuminate\Http\Resources\Json\JsonResource;

class SizeResource extends JsonResource
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
                'time' => $this->time,
                'description' => $this->description
            ];
        }

        return $this->resource;
    }
}
