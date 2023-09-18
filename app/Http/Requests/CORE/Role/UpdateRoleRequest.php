<?php

namespace App\Http\Requests\CORE\Role;

use App\Http\Requests\APIBasicRequest;

class UpdateRoleRequest extends APIBasicRequest
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
        $userId = $this->route('user');

        if ($userId) {
            $this->merge([
                'id' => $userId,
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
        $id = $this->route('user');

        return [
            'name' => ['required', 'string', 'max:255'],
            'permissions' => ['nullable', 'array'],
            'id' => ['exists:users']
        ];
    }
}
