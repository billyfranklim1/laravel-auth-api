<?php

namespace App\Http\Requests\CORE\UnitType;

use App\Http\Requests\APIBasicRequest;
use Illuminate\Validation\Rule;

class UpdateUnitTypeRequest extends APIBasicRequest
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
        $unitTypeId = $this->route('unit-type');

        if ($unitTypeId) {
            $this->merge([
                'id' => $unitTypeId,
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
        $id = $this->route('unit-type');

        return [
            'description' => [
                'required',
                Rule::unique('unit_types')->where(function ($query) use ($id) {
                    $query->whereNull('deleted_at')->where('id', '<>', $id);
                }),
                'string',
                'max:100',
                'min:1',
            ],
            'id' => 'exists:unit_types'
        ];
    }
}
