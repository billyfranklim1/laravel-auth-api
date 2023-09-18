<?php

namespace App\Http\Requests\Webclin\Anesthetist;

use App\Http\Requests\APIBasicRequest;
use Illuminate\Validation\Rule;

class UpdateAnesthetistRequest extends APIBasicRequest
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
        $systemId = $this->route('anesthetist');

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
        $id = $this->route('anesthetist');

        return [
            'name' => [
                'required',
                Rule::unique('anesthetists')->where(function ($query) use ($id) {
                    $query->whereNull('deleted_at')->where('id', '<>', $id);
                }),
                'string',
                'max:100',
                'min:1',
            ],
            'id' => 'exists:anesthetists'
        ];
    }
}
