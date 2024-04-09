<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'order_number',
        'customer_id',
        'user_id',
        'company_id',
        'status',
        'payment_status',
        'payment_method',
        'total',
        'remarks',
        'comment',
        'payment_date',
        'payment_due_date',
        'payment_reference',
        'payment_notes'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'user_id',
        'company_id',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(CompanyProfile::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrdersDetails::class);
    }

    public function additionalInformation(): HasMany
    {
        return $this->hasMany(AdditionalInformation::class, 'informationable');
    }

}
