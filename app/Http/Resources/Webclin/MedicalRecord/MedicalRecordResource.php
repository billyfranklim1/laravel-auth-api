<?php

namespace App\Http\Resources\Webclin\MedicalRecord;

use Illuminate\Http\Resources\Json\JsonResource;

class MedicalRecordResource extends JsonResource
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
                'number' => (int) $this->params_unit_id === (int) $this->unit_id ? $this->number : null,
                'patient' => $this->patient->name,
                'sus' => $this->patient->sus,
                'unit' => $this->unit_id,
            ];
        }

        return $this->resource;
    }
}
