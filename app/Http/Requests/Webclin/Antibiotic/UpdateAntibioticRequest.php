<?php

namespace App\Http\Requests\Webclin\Antibiotic;

use App\Http\Requests\APIBasicRequest;
use Illuminate\Validation\Rule;

class UpdateAntibioticRequest extends APIBasicRequest
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
        $systemId = $this->route('antibiotic');

        if ($systemId) {
            $this->merge([
                'id' => $systemId,
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
        $id = $this->route('antibiotic');

        return [
            'description' => [
                'required',
                Rule::unique('antibiotics')->where(function ($query) use ($id) {
                    $query->whereNull('deleted_at')->where('id', '<>', $id);
                }),
                'string',
                'max:100',
                'min:1',
            ],
            'id' => 'exists:antibiotics'
        ];
    }
}
