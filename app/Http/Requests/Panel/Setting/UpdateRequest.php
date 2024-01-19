<?php

namespace App\Http\Requests\Panel\Setting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'company_logo' => 'nullable|mimes:jpg,jpeg,png',
            'company_name' => 'required|string',
            'company_description' => 'required|string',
            'company_email' => 'required|email',
            'company_phone_number' => 'required|string',
            'company_address' => 'required|string',
            'shipping_province_id' => 'required|string',
            'shipping_city_id' => 'required|string',
            'additional_shipping_fee' => 'required|numeric',
        ];
    }
}
