<?php

namespace App\Http\Requests\Webclin\BloodType;

use App\Http\Requests\APIBasicRequest;
use Illuminate\Validation\Rule;

class UpdateBloodTypeRequest extends APIBasicRequest
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
        $systemId = $this->route('blood_type');

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
        $id = $this->route('blood_type');

        return [
            'description' => [
                'required',
                Rule::unique('blood_types')->where(function ($query) use ($id) {
                    $query->whereNull('deleted_at')->where('id', '<>', $id);
                }),
                'string',
                'max:50',
                'min:1',
            ],
            'id' => 'exists:blood_types'
        ];
    }
}
