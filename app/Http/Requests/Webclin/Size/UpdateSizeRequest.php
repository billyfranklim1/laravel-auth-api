<?php

namespace App\Http\Requests\Webclin\Size;

use App\Http\Requests\APIBasicRequest;
use Illuminate\Validation\Rule;

class UpdateSizeRequest extends APIBasicRequest
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
        $sizeId = $this->route('size');

        if ($sizeId) {
            $this->merge([
                'id' => $sizeId,
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
        $id = $this->route('size');

        return [
            'time' => 'required',
            'description' => [
                'required',
                Rule::unique('sizes')->where(function ($query) use ($id) {
                    $query->whereNull('deleted_at')->where('id', '<>', $id);
                }),
                'string',
                'max:100',
                'min:1',
            ],
            'id' => 'exists:sizes'
        ];
    }
}
