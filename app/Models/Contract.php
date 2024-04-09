<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'status',
        'start_date',
        'end_date',
        'price',
        'remarks',
        'comment',
        'payment_frequency',
        'payment_method',
        'payment_status',
        'property_id',
        'owner_id',
        'customer_id', // Assuming it's okay to mass assign even though it's nullable
        'agent_id',
        'company_id',
        'user_id',
    ];

    protected $hidden = [
        'company_id',
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function agent(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(CompanyProfile::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function additionalInformation():HasMany
    {
        return $this->hasMany(AdditionalInformation::class);
    }
}


