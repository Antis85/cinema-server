<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class TicketRequest extends FormRequest
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
            'seance_id' => ['required', 'string'],
            'seats.seatsInfo' => ['required', 'array'],
            'seats.seatsIds' => ['required', 'array'],
            'seats.seatsInfo.*' => ['required', 'string'],
            'seats.seatsIds.*' => ['required', 'integer'],
            'seats' => ['required', 'array:seatsInfo,seatsIds'],
            'date' => ['required', 'date_format:Y-m-d'],
            'price' => ['required', 'numeric'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {

        throw new HttpResponseException(
            response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
