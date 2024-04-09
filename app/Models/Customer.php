<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Customer extends Model
{
    use HasFactory;
    protected $hidden = [
        'is_deleted',
        'status',
        'created_at',
        'updated_at',
        'company_id',
        'user_id'
    ];
    protected $attributes = [
        'is_deleted' => false,
        'status' => 'ACTIVE'
    ];

    protected $fillable = [
        'type',
        'title',
        'first_name',
        'last_name',
        'id_type',
        'id_number',
        'contact_name',
        'contact_email',
        'contact_phone',
        'contact_phone2',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'country',
        'zip',
        'status',
        'user_id',
        'company_id'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function company():BelongsTo
    {
        return $this->belongsTo(CompanyProfile::class,'company_id');
    }
    public function additionalInformation(): HasMany
    {
        return $this->hasMany(AdditionalInformation::class);
    }



}
