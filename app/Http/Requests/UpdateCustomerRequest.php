<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
            'type' => ['sometimes', 'required', 'in:INDIVIDUAL,BUSINESS,OTHERS'],
            'title' => ['sometimes', 'required', 'in:MR,MISS,M/S'],
            'first_name' => ['sometimes', 'required', 'string', 'max:255'],
            'last_name' => ['sometimes', 'required', 'string', 'max:255'],
            'id_type' => ['sometimes', 'required', 'in:TRADE_LICENCE,NATIONAL_ID,PASSPORT,OTHERS'],
            'id_number' => ['sometimes', 'required', 'string', 'max:255'],
            'contact_name' => ['sometimes', 'required', 'string', 'max:255'],
            'contact_email' => ['sometimes', 'required', 'string', 'email', 'max:255'],
            'contact_phone' => ['sometimes', 'required', 'string', 'max:255'],
            'contact_phone2' => ['nullable', 'string', 'max:255'],
            'address_line1' => ['sometimes', 'required', 'string', 'max:255'],
            'address_line2' => ['nullable', 'string', 'max:255'],
            'city' => ['sometimes', 'required', 'string', 'max:255'],
            'state' => ['sometimes', 'required', 'string', 'max:255'],
            'country' => ['sometimes', 'required', 'string', 'max:255'],
            'zip' => ['sometimes', 'required', 'string', 'max:255'],
            "additional_information" => "nullable|array",
            'additional_information.*.key' => 'required|string',
            'additional_information.*.value' => 'required|string',
            ];
    }
}
