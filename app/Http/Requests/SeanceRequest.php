<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class SeanceRequest extends FormRequest
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
            'remove_seances' => ['sometimes', 'nullable', 'array'],
            'remove_seances.*' => ['required_with:remove_seances', 'array:id'],
            'remove_seances.*.id' => ['required_with:remove_seances', 'integer'],
            'create_seances' => ['sometimes', 'nullable', 'array'],
            'create_seances.*' => ['required_with:create_seances', 'array:hall_id,movie_id,start_time'],
            'create_seances.*.hall_id' => ['required_with:create_seances', 'integer'],
            'create_seances.*.movie_id' => ['required_with:create_seances', 'integer'],
            'create_seances.*.start_time' => ['required_with:create_seances', 'string'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
