<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    //
    protected $fillable = [
        'customer_id',
        'company_id',
        'inventory_id',
        'invoice_number',
        'billing_terms',
        'quantity',
        'unit_price',
        'item_summary',
        'total_amount',
        'status',
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
