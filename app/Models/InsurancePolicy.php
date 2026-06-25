<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\InsuranceClaim;

class InsurancePolicy extends Model
{
    protected $fillable = [
        'company_id',
        'customer_id',
        'policy_number',
        'policy_type',
        'coverage_amount',
        'premium_amount',
        'billing_cycle',
        'start_date',
        'end_date',
        'status',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function claims(): HasMany
    {
        return $this->hasMany(InsuranceClaim::class);
    }
}