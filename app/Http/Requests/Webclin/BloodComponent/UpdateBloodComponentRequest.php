<?php

namespace App\Http\Requests\Webclin\BloodComponent;

use App\Http\Requests\APIBasicRequest;
use Illuminate\Validation\Rule;

class UpdateBloodComponentRequest extends APIBasicRequest
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
        $bloodComponentId = $this->route('blood_component');

        if ($bloodComponentId) {
            $this->merge([
                'id' => $bloodComponentId,
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
        $id = $this->route('blood_component');

        return [
            'description' => [
                'required',
                Rule::unique('blood_components')->where(function ($query) use ($id) {
                    $query->whereNull('deleted_at')->where('id', '<>', $id);
                }),
                'string',
                'max:100',
                'min:1',
            ],
            'id' => 'exists:blood_components'
        ];
    }
}
