<?php

namespace App\Http\Controllers;

use App\Models\InsuranceClaim;
use App\Models\InsurancePolicy;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InsuranceController extends Controller
{
    public function index()
    {
        return view('insurance');
    }

    public function storePolicy(Request $request)
    {
        if (! session('company_id')) {
            return redirect()->back()->with('error', 'Please select an active company before adding a policy.');
        }

        $validatedData = $request->validate([
            'customer_id' => [
                'required',
                Rule::exists('customers', 'id')->where(function ($query) {
                    return $query->where('company_id', session('company_id'));
                }),
            ],
            'policy_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('insurance_policies', 'policy_number')->where(function ($query) {
                    return $query->where('company_id', session('company_id'));
                }),
            ],
            'policy_type' => ['required', 'string', 'max:255'],
            'coverage_amount' => ['required', 'numeric', 'min:0'],
            'premium_amount' => ['required', 'numeric', 'min:0'],
            'billing_cycle' => ['required', 'string', 'max:255'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'status' => ['required', 'string', 'max:255'],
        ]);

        InsurancePolicy::create([
            'company_id' => session('company_id'),
            'customer_id' => $validatedData['customer_id'],
            'policy_number' => $validatedData['policy_number'],
            'policy_type' => $validatedData['policy_type'],
            'coverage_amount' => $validatedData['coverage_amount'],
            'premium_amount' => $validatedData['premium_amount'],
            'billing_cycle' => $validatedData['billing_cycle'],
            'start_date' => $validatedData['start_date'] ?? null,
            'end_date' => $validatedData['end_date'] ?? null,
            'status' => $validatedData['status'],
        ]);

        return redirect()->back()->with('success', 'Insurance policy created successfully.');
    }

    public function storeClaim(Request $request)
    {
        if (! session('company_id')) {
            return redirect()->back()->with('error', 'Please select an active company before adding a claim.');
        }

        $validatedData = $request->validate([
            'insurance_policy_id' => [
                'required',
                Rule::exists('insurance_policies', 'id')->where(function ($query) {
                    return $query->where('company_id', session('company_id'));
                }),
            ],
            'claim_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('insurance_claims', 'claim_number')->where(function ($query) {
                    return $query->where('company_id', session('company_id'));
                }),
            ],
            'claim_date' => ['nullable', 'date'],
            'incident_date' => ['nullable', 'date'],
            'claim_amount' => ['required', 'numeric', 'min:0'],
            'approved_amount' => ['nullable', 'numeric', 'min:0'],
            'status' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        InsuranceClaim::create([
            'company_id' => session('company_id'),
            'insurance_policy_id' => $validatedData['insurance_policy_id'],
            'claim_number' => $validatedData['claim_number'],
            'claim_date' => $validatedData['claim_date'] ?? null,
            'incident_date' => $validatedData['incident_date'] ?? null,
            'claim_amount' => $validatedData['claim_amount'],
            'approved_amount' => $validatedData['approved_amount'] ?? 0,
            'status' => $validatedData['status'],
            'description' => $validatedData['description'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Insurance claim created successfully.');
    }
}