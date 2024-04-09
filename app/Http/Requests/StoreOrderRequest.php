<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'type' => 'required|in:sale,purchase,vendor,work,other',
            'order_number' => 'required|string|unique:orders,order_number',
            'customer_id' => 'required|integer|exists:customers,id',
            'status' => 'required|in:pending,approved,rejected',
            'payment_status' => 'required|in:paid,unpaid,partial',
            'payment_method' => 'required|in:cash,cheque,bank_transfer,credit_card,other',
            'total' => 'required|integer',
            'remarks' => 'nullable|string',
            'comment' => 'nullable|string',
            'payment_date' => 'nullable|date',
            'payment_due_date' => 'nullable|date',
            'payment_reference' => 'nullable|string',
            'payment_notes' => 'nullable|string',
            'additional_information' => 'nullable|array',
            'additional_information.*.key' => 'required|string',
            'additional_information.*.value' => 'required|string',
            'order_items' => 'required|array',
            'order_items.*.type' => 'required|in:product,service,other',
            'order_items.*.name' => 'required|string',
            'order_items.*.quantity' => 'required|integer',
            'order_items.*.price' => 'required|integer',
            'order_items.*.total' => 'required|integer',
            'order_items.*.additional_information' => 'nullable|array',
            'order_items.*.additional_information.*.key' => 'required|string',
            'order_items.*.additional_information.*.value' => 'required|string',

        ];
    }
}
