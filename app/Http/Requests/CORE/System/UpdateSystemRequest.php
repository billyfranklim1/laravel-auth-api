<?php

namespace App\Http\Requests\CORE\System;

use App\Http\Requests\APIBasicRequest;

class UpdateSystemRequest extends APIBasicRequest
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
        $systemId = $this->route('system');

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
        $id = $this->route('system');

        return [
            'system' => 'required|unique:systems,system,' . $id . '|string|max:100|min:1',
            'id' => 'exists:systems'
        ];
    }
}
