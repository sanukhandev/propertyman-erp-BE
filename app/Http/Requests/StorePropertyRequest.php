<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'zip' => 'required|string|max:20',
            'gps_coordinates' => 'nullable|string',
            'property_type' => 'required|in:apartment,house,commercial,land,other',
            'no_of_bedrooms' => 'required|integer|min:0',
            'no_of_bathrooms' => 'required|integer|min:0',
            'no_of_floors' => 'required|integer|min:0',
            'no_of_parking' => 'nullable|integer|min:0',
            'area' => 'required|integer|min:0',
            'price_if_sale' => 'nullable|string',
            'price_if_rent' => 'nullable|string',
            'listing_type' => 'required|in:sale,rent',
            'status' => 'required|string|max:255',
            'company_id' => 'required|integer|exists:company_profiles,id',
            'user_id' => 'required|integer|exists:users,id',
            'customer_id' => 'required|integer|exists:customers,id',
            "additional_information" => "nullable|array",
            'additional_information.*.key' => 'required|string',
            'additional_information.*.value' => 'required|string',
            ];
    }
}
