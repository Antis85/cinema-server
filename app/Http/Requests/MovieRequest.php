<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Closure;

class MovieRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'duration_minutes' => ['required', 'string'],
            'origin' => ['required', 'string'],
            'picture' => ['nullable',
                function (string $attribute, mixed $value, Closure $fail) {
                    if (!is_string($value) && !is_file($value) || (is_file($value) && str_contains($value->getMimeType(), 'image') === false)) {
                        $fail("The {$attribute} must be an image or a string.");
                    }
                },
            ]
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
