<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class SeatRequest extends FormRequest
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
            'seats' => ['required', 'array'],
            'seats.*' => ['required', 'array:hall_id,index_row,index_col,seat_type'],
            'seats.*.hall_id' => ['required', 'integer'],
            'seats.*.index_row' => ['required', 'integer'],
            'seats.*.index_col' => ['required', 'integer'],
            'seats.*.seat_type' => ['required', 'integer'],
            'hallId' => ['nullable', 'integer'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
