<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    //
    protected $fillable = [
        'company_id',
        'sku',
        'description',
        'category',
        'unit_price',
        'stock_count',
        'safety_threshold',
    ];
    //custome table inventory instead of inventories
    protected $table='inventory';



    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
