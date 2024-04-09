<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLeads extends FormRequest
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
            'user_id' => 'required|integer',
            'company_id' => 'required|integer',
            'customer_id' => 'required|integer',
            'source' => 'required|string',
            'status' => 'required|string',
            'remarks' => 'required|string',
            'comment' => 'required|string',
            'contact_date' => 'required|date',
            'next_follow_up' => 'required|date',
            'follow_up_notes' => 'required|string',
            'additional_information' => 'array',
            'additional_information.*.key' => 'required|string',
            'additional_information.*.value' => 'required|string'

        ];
    }
}
