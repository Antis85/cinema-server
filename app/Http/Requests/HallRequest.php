<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class HallRequest extends FormRequest
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
            'name' => ['required', 'sometimes', 'string'],
            'total_rows' => ['required', 'sometimes', 'nullable', 'integer'],
            'total_cols' => ['required', 'sometimes', 'nullable', 'integer'],
            'price_standard' => ['required', 'sometimes', 'nullable', 'integer'],
            'price_vip' => ['required', 'sometimes', 'nullable', 'integer'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
