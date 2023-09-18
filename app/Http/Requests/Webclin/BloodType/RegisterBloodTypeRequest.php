<?php

namespace App\Http\Requests\Webclin\BloodType;

use App\Http\Requests\APIBasicRequest;
use Illuminate\Validation\Rule;

class RegisterBloodTypeRequest extends APIBasicRequest
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
            'description' => ['required', Rule::unique('blood_types')->whereNull('deleted_at'), 'string', 'max:50', 'min:1']
        ];
    }
}
