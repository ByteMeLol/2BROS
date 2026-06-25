<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    //
    protected $fillable = [
        'company_id',
        'expense_name',
        'category',
        'reference',
        'expense_date',
        'amount',
        'status',
    ];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
