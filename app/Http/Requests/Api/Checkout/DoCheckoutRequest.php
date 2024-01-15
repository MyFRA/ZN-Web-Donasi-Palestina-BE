<?php

namespace App\Http\Requests\Api\Checkout;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class DoCheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'products' => 'array|required',
            'products.*.id' => 'required|exists:products,id',
            'products.*.qty' => 'required|numeric',
            'destination_province' => 'required|string',
            'destination_province_id' => 'required|numeric',
            'destination_city' => 'required|string',
            'destination_city_id' => 'required|numeric',
            'destination_district' => 'required|string',
            'destination_village' => 'required|string',
            'home_office_address' => 'required|string',
            'postal_code' => 'required|digits:5',
            'courier' => 'required|in:jne,tiki,pos',
            'courier_cost_service' => 'required|string',
            'courier_cost_value' => 'required|numeric',
            'courier_cost_etd' => 'required|string',
            'full_name' => 'required|string',
            'whatsapp_number' => 'required|string',
            'email' => 'required|string',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            'code'  => 422,
            'msg'   => "Error Validations",
            'error' => $validator->errors()->first(),
        ], 422);

        throw new ValidationException($validator, $response);
    }
}
