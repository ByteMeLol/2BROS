<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    //
    public function store(Request $request){
        dd($request->all());
    }
    public function create(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user?->company_id) {
                session([
                    'company_id' => $user->company_id,
                    'active_company_id' => $user->company_id,
                    'company_name' => $user->company?->name,
                    'active_company_name' => $user->company?->name,
                ]);
            } else {
                $company = Company::first();

                if ($company) {
                    session([
                        'company_id' => $company->id,
                        'active_company_id' => $company->id,
                        'company_name' => $company->name,
                        'active_company_name' => $company->name,
                    ]);
                }
            }

            return redirect('/home')->with('success', 'Logged in successfully.');
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);

       
    }
    public function destroy(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logged out successfully.');
    }
}
