<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePropertyRequest extends FormRequest
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
            'name' => 'sometimes|string|max:255',
            'location' => 'sometimes|string|max:255',
            'address' => 'sometimes|string|max:255',
            'city' => 'sometimes|string|max:255',
            'state' => 'sometimes|string|max:255',
            'country' => 'sometimes|string|max:255',
            'zip' => 'sometimes|string|max:20',
            'gps_coordinates' => 'sometimes|nullable|string',
            'property_type' => 'sometimes|in:apartment,house,commercial,land,other',
            'no_of_bedrooms' => 'sometimes|integer|min:0',
            'no_of_bathrooms' => 'sometimes|integer|min:0',
            'no_of_floors' => 'sometimes|integer|min:0',
            'no_of_parking' => 'sometimes|nullable|integer|min:0',
            'area' => 'sometimes|integer|min:0',
            'price_if_sale' => 'sometimes|nullable|string',
            'price_if_rent' => 'sometimes|nullable|string',
            'listing_type' => 'sometimes|in:sale,rent',
            'status' => 'sometimes|string|max:255',
            'company_id' => 'sometimes|integer|exists:company_profiles,id',
            'user_id' => 'sometimes|integer|exists:users,id',
            'customer_id' => 'sometimes|integer|exists:customers,id',
            "additional_information" => "nullable|array",
            'additional_information.*.key' => 'required|string',
            'additional_information.*.value' => 'required|string',
            ];
    }
}
