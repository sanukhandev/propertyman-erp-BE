<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContractRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => 'sometimes|string',
            'status' => 'sometimes|string',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date',
            'price' => 'sometimes|numeric',
            'remarks' => 'sometimes|string',
            'comment' => 'sometimes|string',
            'payment_frequency' => 'sometimes|string',
            'payment_method' => 'sometimes|string',
            'payment_status' => 'sometimes|string',
            'property_id' => 'sometimes|exists:properties,id',
            'owner_id' => 'sometimes|exists:customers,id',
            'customer_id' => 'sometimes|exists:customers,id',
            'agent_id' => 'sometimes|exists:users,id',
            'company_id' => 'sometimes|exists:company_profiles,id',
            'user_id' => 'sometimes|exists:users,id',
            'additional_information' => 'sometimes|array',
            'additional_information.*.key' => 'required|string',
            'additional_information.*.value' => 'required|string',
            ];
    }
}
