<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CompanyProfile extends Model
{
    use HasFactory;

    protected $hidden = [
        'is_deleted',
        'status',
        'created_at',
        'updated_at'
    ];
    protected $attributes = [
        'is_deleted' => false,
    ];
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address1',
        'address2',
        'city',
        'state',
        'country',
        'zip',
        'status',
        'is_deleted'
    ];

    public function users():HasMany
    {
        return $this->hasMany(User::class,'company_id');
    }
    public function customers():HasMany
    {
        return $this->hasMany(Customer::class,'company_id');
    }
}
