<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    

    protected $fillable = [
        'company_id',
        'company_name',
        'contact_role',
        'contact_person',
        'address',
        'phone',
        'email',
        'tax_id',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}