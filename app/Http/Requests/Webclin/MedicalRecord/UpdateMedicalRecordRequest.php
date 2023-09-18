<?php

namespace App\Http\Requests\Webclin\MedicalRecord;

use App\Http\Requests\APIBasicRequest;
use Illuminate\Validation\Rule;

class UpdateMedicalRecordRequest extends APIBasicRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $patientId = $this->route('medical-record');

        if ($patientId) {
            $this->merge([
                'id' => $patientId,
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $id = $this->route('medical-record');

        return [
            'number' => [
                'required',
                Rule::unique('medical_records')->where(function ($query) use ($id) {
                    $query->where('id', '<>', $id);
                }),
                'string',
                'max:100',
                'min:1',
            ],
            'id' => 'exists:medical_records'
        ];
    }
}
