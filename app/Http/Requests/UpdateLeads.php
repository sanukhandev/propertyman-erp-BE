<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLeads extends FormRequest
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
            'user_id' => 'sometimes|integer',
            'company_id' => 'sometimes|integer',
            'customer_id' => 'sometimes|integer',
            'source' => 'sometimes|string',
            'status' => 'sometimes|string',
            'remarks' => 'sometimes|string',
            'comment' => 'sometimes|string',
            'contact_date' => 'sometimes|date',
            'next_follow_up' => 'sometimes|date',
            'follow_up_notes' => 'sometimes|string',
            'additional_information' => 'sometimes|array',
            'additional_information.*.key' => 'sometimes|string',
            'additional_information.*.value' => 'sometimes|string'
        ];
    }
}
