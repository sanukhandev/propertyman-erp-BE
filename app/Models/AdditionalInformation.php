<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class AdditionalInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'customer_id',
        'company_id',
        'property_id',
        'contract_id',
        'user_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'company_id',
        'property_id',
        'contract_id',
        'user_id',
        'customer_id',
        'id'
    ];

    public function customer():BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(CompanyProfile::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class);
    }

}
