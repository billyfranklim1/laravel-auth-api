<?php

namespace App\Http\Requests\CORE\User;

use App\Http\Requests\APIBasicRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterUserRequest extends APIBasicRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'user.name' => ['required', 'string', 'max:255'],
            'user.email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'user.password' => ['required', 'string', 'min:8', 'confirmed'],
            'permissions' => ['nullable', 'array'],
            'roles' => ['nullable', 'array']
        ];
    }

    public function messages(): array
    {
        return [
            'user.name.required' => 'O campo nome é obrigatório.',
            'user.email.required' => 'O campo e-mail é obrigatório.',
            'user.email.email' => 'Por favor, insira um endereço de e-mail válido.',
            'user.email.unique' => 'O e-mail informado já está em uso.',
            'user.password.required' => 'O campo senha é obrigatório.',
            'user.password.min' => 'A senha deve ter pelo menos 8 caracteres.',
            'user.password.confirmed' => 'A confirmação de senha não corresponde.',
        ];
    }

}
