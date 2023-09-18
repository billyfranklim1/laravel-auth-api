<?php

namespace App\Http\Requests\CORE\User;

use App\Http\Requests\APIBasicRequest;

class UpdateUserRequest extends APIBasicRequest
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
            'user.name' => ['required', 'string', 'max:255'],
            'user.email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'permissions' => ['nullable', 'array'],
            'roles' => ['nullable', 'array'],
            'systems' => ['nullable', 'array'],
            'units' => ['nullable', 'array'],
            'id' => ['exists:users']
        ];
    }
}
