<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'address',
        'city',
        'state',
        'country',
        'zip',
        'gps_coordinates',
        'property_type',
        'no_of_bedrooms',
        'no_of_bathrooms',
        'no_of_floors',
        'no_of_parking',
        'area',
        'price_if_sale',
        'price_if_rent',
        'listing_type',
        'status',
        'company_id',
        'user_id',
        'customer_id',
    ];

    protected $hidden = [
        'company_id',
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(CompanyProfile::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function additionalInformation(): HasMany
    {
        return $this->hasMany(AdditionalInformation::class);
    }
}
