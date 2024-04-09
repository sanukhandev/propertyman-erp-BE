<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyProfileRequest extends FormRequest
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
            "name" => "required|max:255",
            "email" => "required|email",
            "phone" => "required|max:15|min:9",
            "address1" => "required|max:255",
            "address2" => "sometimes|max:255",
            "city" => "required|max:255",
            "state" => "required|max:255",
            "country" => "required|max:255",
            "zip" => "sometimes|max:8|min:2",
            "additional_information" => "nullable|array",
            'additional_information.*.key' => 'required|string',
            'additional_information.*.value' => 'required|string',
        ];
    }
}
