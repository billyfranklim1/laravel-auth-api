<?php

namespace App\Http\Resources\Webclin\Anesthetist;

use Illuminate\Http\Resources\Json\JsonResource;

class AnesthetistResource extends JsonResource
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
                'name' => $this->name
            ];
        }

        return $this->resource;
    }
}
