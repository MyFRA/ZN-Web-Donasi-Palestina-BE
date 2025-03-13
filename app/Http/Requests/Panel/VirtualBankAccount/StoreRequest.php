<?php

namespace App\Http\Requests\Panel\VirtualBankAccount;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'image' => 'mimes:jpg,jpeg,png',
            'bank_name' => 'required|string',
            'bank_short_code' => 'required|string',
            'type' => 'required|string|in:ewallet,qris,va'
        ];
    }
}
