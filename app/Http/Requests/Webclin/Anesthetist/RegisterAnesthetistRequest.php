<?php

namespace App\Http\Requests\Webclin\Anesthetist;

use App\Http\Requests\APIBasicRequest;
use Illuminate\Validation\Rule;

class RegisterAnesthetistRequest extends APIBasicRequest
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
            'name' => ['required', Rule::unique('anesthetists')->whereNull('deleted_at'), 'string', 'max:100', 'min:1']
        ];
    }
}
