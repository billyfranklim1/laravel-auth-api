<?php

namespace App\Http\Resources\CORE\System;

use Illuminate\Http\Resources\Json\JsonResource;

class SystemsResource extends JsonResource
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
                'system' => $this->system
            ];
        }

        return $this->resource;
    }
}
