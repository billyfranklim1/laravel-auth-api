<?php

namespace App\Http\Requests\CORE\Unit;

use App\Http\Requests\APIBasicRequest;
use Illuminate\Validation\Rule;

class UpdateUnitRequest extends APIBasicRequest
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
        $unitId = $this->route('unit');

        if ($unitId) {
            $this->merge([
                'id' => $unitId,
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
        $id = $this->route('unit');

        return [
            'unit' => [
                'required',
                Rule::unique('units')->where(function ($query) use ($id) {
                    $query->whereNull('deleted_at')->where('id', '<>', $id);
                }),
                'string',
                'max:100',
                'min:1',
            ],
            'id' => 'exists:units'
        ];
    }
}
