<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContractRequest extends FormRequest
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
            'type' => 'required|string',
            'status' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'price' => 'required|numeric',
            'remarks' => 'nullable|string',
            'comment' => 'nullable|string',
            'payment_frequency' => 'required|string',
            'payment_method' => 'required|string',
            'payment_status' => 'required|string',
            'property_id' => 'required|exists:properties,id',
            'owner_id' => 'required|exists:customers,id',
            'customer_id' => 'nullable|exists:customers,id',
            'agent_id' => 'required|exists:users,id',
            'company_id' => 'required|exists:company_profiles,id',
            'user_id' => 'required|exists:users,id',
            'additional_information' => 'array',
            'additional_information.*.key' => 'required|string',
            'additional_information.*.value' => 'required|string',
        ];
    }
}
