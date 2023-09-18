<?php

namespace App\Http\Resources\Webclin\Postoperative;

use Illuminate\Http\Resources\Json\JsonResource;

class PostoperativeResource extends JsonResource
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
