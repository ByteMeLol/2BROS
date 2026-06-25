<div class="max-w-5xl mx-auto px-4 py-8" x-data="{ policyModal: false, claimModal: false }">

    <div class="mb-8 pb-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-xl font-bold tracking-tight text-slate-900">Insurance Desk</h1>
            <p class="text-xs text-slate-500 mt-1.5">Manage policies and claims for customers under the active company scope.</p>
        </div>
        <div class="flex items-center space-x-2">
            <button type="button" @click="policyModal = true"
                    class="bg-slate-900 hover:bg-slate-800 text-white px-3.5 py-2 rounded-lg text-xs font-semibold transition shadow-sm shadow-slate-900/10">
                <i class="fa-solid fa-file-shield mr-1.5 text-slate-300"></i> New Policy
            </button>
            <button type="button" @click="claimModal = true"
                    class="bg-white border border-slate-200 text-slate-700 px-3.5 py-2 rounded-lg text-xs font-medium hover:bg-slate-50 transition shadow-sm">
                <i class="fa-solid fa-file-circle-exclamation mr-1.5 text-slate-400"></i> New Claim
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl border border-slate-200/80 p-5 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Active Policies</span>
                <span class="text-3xl font-bold text-slate-900 tracking-tight">{{ $activePolicies }}</span>
            </div>
            <div class="w-9 h-9 rounded-lg border border-slate-200/60 text-slate-400 flex items-center justify-center text-sm shadow-sm">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-slate-200/80 p-5 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Coverage Total</span>
                <span class="text-xl font-bold text-slate-900 tracking-tight">TZS {{ number_format($totalCoverage, 2) }}</span>
            </div>
            <div class="w-9 h-9 rounded-lg border border-slate-200/60 text-slate-400 flex items-center justify-center text-sm shadow-sm">
                <i class="fa-solid fa-coins"></i>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-slate-200/80 p-5 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Open Claims</span>
                <span class="text-3xl font-bold text-slate-900 tracking-tight">{{ $openClaims }}</span>
            </div>
            <div class="w-9 h-9 rounded-lg border border-slate-200/60 text-slate-400 flex items-center justify-center text-sm shadow-sm">
                <i class="fa-solid fa-file-circle-question"></i>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-slate-200/80 p-5 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Inactive Policies</span>
                <span class="text-3xl font-bold text-slate-900 tracking-tight">{{ $inactivePolicies }}</span>
            </div>
            <div class="w-9 h-9 rounded-lg border border-slate-200/60 text-slate-400 flex items-center justify-center text-sm shadow-sm">
                <i class="fa-solid fa-file-circle-xmark"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
            <div class="p-4 border-b border-slate-100 bg-slate-50/50">
                <h3 class="font-bold text-slate-900 text-xs uppercase tracking-wider">Policies</h3>
                <p class="text-[10px] text-slate-400 mt-0.5">Policies linked to customers in the selected company scope.</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-slate-50 text-slate-400 font-bold uppercase tracking-wider border-b border-slate-100">
                            <th class="p-4">Policy No</th>
                            <th class="p-4">Customer</th>
                            <th class="p-4">Type</th>
                            <th class="p-4 text-right">Premium</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-600 font-medium">
                        @foreach ($policyOptions as $policy)
                            <tr class="hover:bg-slate-50/30 transition-colors">
                                <td class="p-4 font-mono font-bold text-slate-900">{{ $policy->policy_number }}</td>
                                <td class="p-4">
                                    <span class="text-slate-900 block font-semibold">{{ $policy->customer->company_name ?? 'N/A' }}</span>
                                    <span class="text-[10px] text-slate-400 block font-normal">{{ $policy->status }}</span>
                                </td>
                                <td class="p-4">{{ $policy->policy_type }}</td>
                                <td class="p-4 text-right font-mono font-bold">TZS {{ number_format($policy->premium_amount, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
            <div class="p-4 border-b border-slate-100 bg-slate-50/50">
                <h3 class="font-bold text-slate-900 text-xs uppercase tracking-wider">Claims</h3>
                <p class="text-[10px] text-slate-400 mt-0.5">Claim intake, approvals, and linked policy references.</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-slate-50 text-slate-400 font-bold uppercase tracking-wider border-b border-slate-100">
                            <th class="p-4">Claim No</th>
                            <th class="p-4">Policy</th>
                            <th class="p-4">Amount</th>
                            <th class="p-4 text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-600 font-medium">
                        @foreach ($claims as $claim)
                            <tr class="hover:bg-slate-50/30 transition-colors">
                                <td class="p-4 font-mono font-bold text-slate-900">{{ $claim->claim_number }}</td>
                                <td class="p-4">
                                    <span class="text-slate-900 block font-semibold">{{ $claim->insurancePolicy->policy_number ?? 'N/A' }}</span>
                                    <span class="text-[10px] text-slate-400 block font-normal">{{ $claim->insurancePolicy->customer->company_name ?? '' }}</span>
                                </td>
                                <td class="p-4 font-mono">TZS {{ number_format($claim->claim_amount, 2) }}</td>
                                <td class="p-4 text-right">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-slate-50 text-slate-700 border border-slate-200">{{ $claim->status }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if($isAdmin)
        <div class="mt-6 bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
            <div class="p-4 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between gap-4">
                <div>
                    <h3 class="font-bold text-slate-900 text-xs uppercase tracking-wider">Inactive Policy Review</h3>
                    <p class="text-[10px] text-slate-400 mt-0.5">Admin-only list for cancelled, expired, lapsed, and inactive policies.</p>
                </div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500 bg-slate-100 border border-slate-200 px-2 py-1 rounded">Admin view</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-slate-50 text-slate-400 font-bold uppercase tracking-wider border-b border-slate-100">
                            <th class="p-4">Policy No</th>
                            <th class="p-4">Customer</th>
                            <th class="p-4">Reason</th>
                            <th class="p-4 text-right">Premium</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-600 font-medium">
                        @foreach ($policies->filter(function ($policy) {
                            return in_array($policy->status, ['inactive', 'expired', 'cancelled', 'lapsed']);
                        }) as $policy)
                            <tr class="hover:bg-slate-50/30 transition-colors">
                                <td class="p-4 font-mono font-bold text-slate-900">{{ $policy->policy_number }}</td>
                                <td class="p-4">
                                    <span class="text-slate-900 block font-semibold">{{ $policy->customer->company_name ?? 'N/A' }}</span>
                                </td>
                                <td class="p-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">{{ $policy->status }}</span>
                                </td>
                                <td class="p-4 text-right font-mono font-bold">TZS {{ number_format($policy->premium_amount, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <div x-show="policyModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto" style="display: none;">
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm" @click="policyModal = false"></div>
        <div class="bg-white border border-slate-200 rounded-xl shadow-xl w-full max-w-md overflow-hidden relative z-10">
            <div class="p-4 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-900">Create Policy</h3>
                    <p class="text-[10px] text-slate-400 mt-0.5">Bind a policy to an existing customer.</p>
                </div>
                <button type="button" @click="policyModal = false" class="text-slate-400 hover:text-slate-600 p-1"><i class="fa-solid fa-xmark text-sm"></i></button>
            </div>
            <form action="/insurance/policies" method="POST" class="p-5 space-y-4">
                @csrf
                <div class="space-y-1">
                    <label class="block text-[11px] font-semibold text-slate-700">Customer</label>
                    <select name="customer_id" required class="w-full bg-slate-50/50 border border-slate-200 rounded-lg py-1.5 px-2.5 text-xs">
                        <option value="">Select customer</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->company_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="space-y-1">
                        <label class="block text-[11px] font-semibold text-slate-700">Policy No</label>
                        <input type="text" name="policy_number" id="policy_number" required readonly class="w-full bg-slate-50/50 border border-slate-200 rounded-lg py-1.5 px-2.5 text-xs font-mono">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-[11px] font-semibold text-slate-700">Type</label>
                        <input type="text" name="policy_type" required placeholder="Motor / Health / Property" class="w-full bg-slate-50/50 border border-slate-200 rounded-lg py-1.5 px-2.5 text-xs">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="space-y-1">
                        <label class="block text-[11px] font-semibold text-slate-700">Coverage</label>
                        <input type="number" step="0.01" name="coverage_amount" required class="w-full bg-slate-50/50 border border-slate-200 rounded-lg py-1.5 px-2.5 text-xs font-mono">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-[11px] font-semibold text-slate-700">Premium</label>
                        <input type="number" step="0.01" name="premium_amount" required class="w-full bg-slate-50/50 border border-slate-200 rounded-lg py-1.5 px-2.5 text-xs font-mono">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="space-y-1">
                        <label class="block text-[11px] font-semibold text-slate-700">Start Date</label>
                        <input type="date" name="start_date" class="w-full bg-slate-50/50 border border-slate-200 rounded-lg py-1.5 px-2.5 text-xs">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-[11px] font-semibold text-slate-700">End Date</label>
                        <input type="date" name="end_date" class="w-full bg-slate-50/50 border border-slate-200 rounded-lg py-1.5 px-2.5 text-xs">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="space-y-1">
                        <label class="block text-[11px] font-semibold text-slate-700">Billing Cycle</label>
                        <select name="billing_cycle" required class="w-full bg-slate-50/50 border border-slate-200 rounded-lg py-1.5 px-2.5 text-xs">
                            <option value="monthly">Monthly</option>
                            <option value="quarterly">Quarterly</option>
                            <option value="yearly">Yearly</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="block text-[11px] font-semibold text-slate-700">Status</label>
                        <select name="status" required class="w-full bg-slate-50/50 border border-slate-200 rounded-lg py-1.5 px-2.5 text-xs">
                            <option value="active">Active</option>
                            <option value="pending">Pending</option>
                            <option value="expired">Expired</option>
                        </select>
                    </div>
                </div>
                <div class="pt-3 border-t border-slate-100 flex items-center justify-end space-x-2">
                    <button type="button" @click="policyModal = false" class="bg-white border border-slate-200 text-slate-600 px-3.5 py-1.5 rounded-lg text-xs font-medium hover:bg-slate-50 transition-all">Cancel</button>
                    <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-all shadow-sm">Save Policy</button>
                </div>
            </form>
        </div>
    </div>

    <div x-show="claimModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto" style="display: none;">
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm" @click="claimModal = false"></div>
        <div class="bg-white border border-slate-200 rounded-xl shadow-xl w-full max-w-md overflow-hidden relative z-10">
            <div class="p-4 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-900">Create Claim</h3>
                    <p class="text-[10px] text-slate-400 mt-0.5">Register a claim against a policy.</p>
                </div>
                <button type="button" @click="claimModal = false" class="text-slate-400 hover:text-slate-600 p-1"><i class="fa-solid fa-xmark text-sm"></i></button>
            </div>
            <form action="/insurance/claims" method="POST" class="p-5 space-y-4">
                @csrf
                <div class="space-y-1">
                    <label class="block text-[11px] font-semibold text-slate-700">Policy</label>
                    <select name="insurance_policy_id" required class="w-full bg-slate-50/50 border border-slate-200 rounded-lg py-1.5 px-2.5 text-xs">
                        <option value="">Select policy</option>
                        @foreach ($policies as $policy)
                            <option value="{{ $policy->id }}">{{ $policy->policy_number }} - {{ $policy->customer->company_name ?? 'N/A' }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="space-y-1">
                        <label class="block text-[11px] font-semibold text-slate-700">Claim No</label>
                        <input type="text" name="claim_number" id="claim_number" required readonly class="w-full bg-slate-50/50 border border-slate-200 rounded-lg py-1.5 px-2.5 text-xs font-mono">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-[11px] font-semibold text-slate-700">Status</label>
                        <select name="status" required class="w-full bg-slate-50/50 border border-slate-200 rounded-lg py-1.5 px-2.5 text-xs">
                            <option value="pending">Pending</option>
                            <option value="reviewing">Reviewing</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                            <option value="paid">Paid</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="space-y-1">
                        <label class="block text-[11px] font-semibold text-slate-700">Claim Date</label>
                        <input type="date" name="claim_date" class="w-full bg-slate-50/50 border border-slate-200 rounded-lg py-1.5 px-2.5 text-xs">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-[11px] font-semibold text-slate-700">Incident Date</label>
                        <input type="date" name="incident_date" class="w-full bg-slate-50/50 border border-slate-200 rounded-lg py-1.5 px-2.5 text-xs">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="space-y-1">
                        <label class="block text-[11px] font-semibold text-slate-700">Claim Amount</label>
                        <input type="number" step="0.01" name="claim_amount" required class="w-full bg-slate-50/50 border border-slate-200 rounded-lg py-1.5 px-2.5 text-xs font-mono">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-[11px] font-semibold text-slate-700">Approved Amount</label>
                        <input type="number" step="0.01" name="approved_amount" class="w-full bg-slate-50/50 border border-slate-200 rounded-lg py-1.5 px-2.5 text-xs font-mono">
                    </div>
                </div>
                <div class="space-y-1">
                    <label class="block text-[11px] font-semibold text-slate-700">Description</label>
                    <textarea name="description" rows="3" class="w-full bg-slate-50/50 border border-slate-200 rounded-lg py-1.5 px-2.5 text-xs"></textarea>
                </div>
                <div class="pt-3 border-t border-slate-100 flex items-center justify-end space-x-2">
                    <button type="button" @click="claimModal = false" class="bg-white border border-slate-200 text-slate-600 px-3.5 py-1.5 rounded-lg text-xs font-medium hover:bg-slate-50 transition-all">Cancel</button>
                    <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-all shadow-sm">Save Claim</button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const policyInput = document.getElementById('policy_number');
        const claimInput = document.getElementById('claim_number');

        if (policyInput) {
            policyInput.value = `POL-${new Date().getFullYear()}-${Math.floor(Math.random() * 900) + 100}`;
        }

        if (claimInput) {
            claimInput.value = `CLM-${new Date().getFullYear()}-${Math.floor(Math.random() * 900) + 100}`;
        }
    });
</script>