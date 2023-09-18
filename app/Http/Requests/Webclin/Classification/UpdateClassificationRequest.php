<?php

namespace App\Http\Requests\Webclin\Classification;

use App\Http\Requests\APIBasicRequest;
use Illuminate\Validation\Rule;

class UpdateClassificationRequest extends APIBasicRequest
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
        $systemId = $this->route('classification');

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
        $id = $this->route('classification');

        return [
            'description' => [
                'required',
                Rule::unique('classifications')->where(function ($query) use ($id) {
                    $query->whereNull('deleted_at')->where('id', '<>', $id);
                }),
                'string',
                'max:100',
                'min:1',
            ],
            'id' => 'exists:classifications'
        ];
    }
}
