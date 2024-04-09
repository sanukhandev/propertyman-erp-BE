<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Leads extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'customer_id',
        'source',
        'status',
        'remarks',
        'comment',
        'contact_date',
        'next_follow_up',
        'follow_up_notes'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'user_id',
        'company_id',
        'customer_id'
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(CompanyProfile::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function interactions(): HasMany
    {
        return $this->hasMany(Interactions::class);
    }




}
