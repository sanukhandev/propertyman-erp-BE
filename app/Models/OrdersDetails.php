<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrdersDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'type',
        'name',
        'quantity',
        'price',
        'total'
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Orders::class);
    }

    public function additionalInformation(): HasMany
    {
        return $this->hasMany(AdditionalInformation::class);
    }
}
