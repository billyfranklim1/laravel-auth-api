<?php

namespace App\Http\Resources\Webclin\Patient;

use App\Models\MedicalRecord;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        if (isset($this->id)) {
            $medicalRecords = isset($this->medicalRecords[0]) ? $this->medicalRecords[0]->number : null;

            return [
                'id' => $this->id,
                'name' => $this->name,
                'sus' => $this->sus,
                'social_name' => $this->social_name ?? null,
                'mother_name' => $this->mother_name ?? null,
                'email' => $this->email ?? null,
                'birthday' => $this->birthday ?? null,
                'rg' => $this->rg ?? null,
                'cpf' => $this->cpf ?? null,
                'gender' => $this->gender ?? null,
                'address' => $this->address ?? null,
                'number' => $this->number ?? null,
                'city' => $this->city ?? null,
                'uf' => $this->uf ?? null,
                'zip' => $this->zip ?? null,
                'complement' => $this->complement ?? null,
                'neighborhood' => $this->neighborhood ?? null,
                'phone' => $this->phone ?? null,
                'cellphone' => $this->cellphone ?? null,
                'medical_record' => $medicalRecords,
            ];
        }

        return $this->resource;
    }
}
