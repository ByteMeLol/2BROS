<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\InsurancePolicy;

class InsuranceClaim extends Model
{
    protected $fillable = [
        'company_id',
        'insurance_policy_id',
        'claim_number',
        'claim_date',
        'incident_date',
        'claim_amount',
        'approved_amount',
        'status',
        'description',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function insurancePolicy(): BelongsTo
    {
        return $this->belongsTo(InsurancePolicy::class);
    }
}