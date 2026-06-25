<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    //
    public function  index()
    {
        return view('inventory');
    }
    public function store(Request $request){
        //dd($request->all());
        $validatedData = $request->validate([
            'sku' => 'required|unique:inventory,sku',
            'description' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'unit_price' => 'required|numeric|min:0',
            'stock_count' => 'required|integer|min:0',
            'safety_threshold' => 'required|integer|min:0',

        
        ]);


        $companyId = session('company_id') ?: Auth::user()?->company_id;

        abort_unless($companyId, 403, 'No active company scope found for inventory creation.');

        Inventory::create([
            'company_id' => $companyId,
            'sku' => $validatedData['sku'],
            'description' => $validatedData['description'],
            'category' => $validatedData['category'],
            'unit_price' => $validatedData['unit_price'],
            'stock_count' => $validatedData['stock_count'],
            'safety_threshold' => $validatedData['safety_threshold'],
        ]);


        return redirect()->route('inventory.view')->with('success', 'Inventory item added successfully!');
    }
}
