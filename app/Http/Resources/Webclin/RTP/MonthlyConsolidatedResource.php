<?php

namespace App\Http\Resources\Webclin\RTP;

use Illuminate\Http\Resources\Json\JsonResource;

class MonthlyConsolidatedResource extends JsonResource
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
