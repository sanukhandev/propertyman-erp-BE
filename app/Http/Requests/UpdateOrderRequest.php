<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
                'type' => 'sometimes|in:sale,purchase,vendor,work,other',
                'order_number' => 'sometimes|string|unique:orders,order_number,' . $this->order->id,
                'customer_id' => 'sometimes|integer|exists:customers,id',
                'user_id' => 'sometimes|integer|exists:users,id',
                'company_id' => 'sometimes|integer|exists:company_profiles,id',
                'status' => 'sometimes|in:pending,approved,rejected',
                'payment_status' => 'sometimes|in:paid,unpaid,partial',
                'payment_method' => 'sometimes|in:cash,cheque,bank_transfer,credit_card,other',
                'total' => 'sometimes|integer',
                'remarks' => 'nullable|string',
                'comment' => 'nullable|string',
                'payment_date' => 'nullable|date',
                'payment_due_date' => 'nullable|date',
                'payment_reference' => 'nullable|string',
                'payment_notes' => 'nullable|string',
                'additional_information' => 'nullable|array',
                'additional_information.*.key' => 'sometimes|string',
                'additional_information.*.value' => 'sometimes|string',
                'order_items' => 'sometimes|array',
                'order_items.*.type' => 'in:product,service,other',
                'order_items.*.name' => 'string',
                'order_items.*.quantity' => 'integer',
                'order_items.*.price' => 'integer',
                'order_items.*.total' => 'integer',
                'order_items.*.additional_information' => 'nullable|array',
                'order_items.*.additional_information.*.key' => 'sometimes|string',
                'order_items.*.additional_information.*.value' => 'sometimes|string',

        ];
    }
}
