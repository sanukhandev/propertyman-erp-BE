<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyProfileRequest extends FormRequest
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
            "name" => "sometimes|required|max:255",
            "email" => "sometimes|required|email",
            "phone" => "sometimes|required|max:15|min:9",
            "address1" => "sometimes|required|max:255",
            "address2" => "sometimes|required|max:255",
            "city" => "sometimes|required|max:255",
            "state" => "sometimes|required|max:255",
            "country" => "sometimes|required|max:255",
            "zip" => "sometimes|required|max:8|min:2",
            'is_deleted' => "sometimes|required|boolean",
            "additional_information" => "nullable|array",
            'additional_information.*.key' => 'required|string',
            'additional_information.*.value' => 'required|string',
            ];
    }
}
