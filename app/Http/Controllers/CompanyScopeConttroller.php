<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class CompanyScopeConttroller extends Controller
{
    //
    public function switchCompany($id)
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

    //dd($id);
        // Enforce security check: Verify if user is super_admin before changing scopes
        if (! $user?->isSuperAdmin()) {
            abort(403, 'Unauthorized scope alteration request.');
        }

        $company = Company::all()->find($id);

        //dd($company);

        // Store both variables safely inside the session context
        session([
            'company_id'   => $company->id,
            'company_name' => $company->name,
        ]);

        return redirect()->back()->with('success', 'Active company scope switched to: ' . $company->name);
    }
    
}
