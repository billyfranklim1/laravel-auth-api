<?php

namespace App\Http\Requests\Webclin\Patient;

use App\Http\Requests\APIBasicRequest;
use Illuminate\Validation\Rule;

class UpdatePatientRequest extends APIBasicRequest
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
        $patientId = $this->route('patient');

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
        $id = $this->route('patient');

        return [
            'name' => [
                'required',
                Rule::unique('patients')->where(function ($query) use ($id) {
                    $query->whereNull('deleted_at')->where('id', '<>', $id);
                }),
                'string',
                'max:100',
                'min:1',
            ],
            'id' => 'exists:patients'
        ];
    }
}
