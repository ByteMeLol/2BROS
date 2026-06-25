<x-layout>
    <x-slot:title>{{ $user->first_name }} {{ $user->last_name }} — 2bros</x-slot:title>

    <div class="max-w-4xl mx-auto px-4 py-8">
        
        <!-- BACK TO REGISTRY LOGIC -->
        <div class="mb-6">
            <a href="/users" class="inline-flex items-center text-xs font-semibold text-slate-400 hover:text-slate-900 transition-colors duration-150 group">
                <svg class="w-3.5 h-3.5 mr-2 transform group-hover:-translate-x-0.5 transition-transform duration-150" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Back to team hub
            </a>
        </div>

        <!-- HERO IDENTITY CARD -->
        <div class="bg-white border border-slate-200/80 rounded-xl p-6 shadow-sm mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center space-x-4">
                <div class="w-14 h-14 rounded-full bg-slate-900 text-white font-bold text-lg flex items-center justify-center tracking-tight uppercase">
                    {{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}
                </div>
                <div>
                    <div class="flex items-center space-x-2">
                        <h1 class="text-lg font-bold text-slate-900">{{ $user->first_name }} {{ $user->last_name }}</h1>
                        <span class="w-2 h-2 rounded-full bg-emerald-500" title="System Active Now"></span>
                    </div>
                    <p class="text-xs text-slate-500 mt-0.5">{{ $user->email }}</p>
                </div>
            </div>
            
            <!-- QUICK CONTEXT BADGES -->
            <div class="flex items-center space-x-2.5 sm:self-center">
                <span class="px-2.5 py-1 border border-slate-200 bg-slate-50 text-slate-700 rounded-lg text-[11px] font-bold">
                    {{ str_replace('_', ' ', $user->role->name ?? 'user') }}
                </span>
                <span class="px-2.5 py-1 border border-emerald-100 bg-emerald-50 text-emerald-800 rounded-lg text-[11px] font-bold">
                    {{ $user->company->name ?? 'No Company Assigned' }}
                </span>
            </div>
        </div>

        <!-- TWO-COLUMN DETAIL GRID -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- LEFT AREA: CORE DETAILS & ACCESS CREDENTIAL METRICS -->
            <div class="md:col-span-2 space-y-6">
                
                <!-- CONTACT & IDENTITY DATA BLOCK -->
                <div class="bg-white border border-slate-200/80 rounded-xl p-5 shadow-sm space-y-4">
                    <div class="pb-2 border-b border-slate-100">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">Account Information</h3>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                        <div>
                            <span class="block text-slate-400 font-medium mb-1">Full Legal Name</span>
                            <span class="text-slate-900 font-bold">{{ $user->first_name }} {{ $user->last_name }}</span>
                        </div>
                        <div>
                            <span class="block text-slate-400 font-medium mb-1">Corporate Email</span>
                            <span class="text-slate-900 font-mono font-semibold">{{ $user->email }}</span>
                        </div>
                        <div>
                            <span class="block text-slate-400 font-medium mb-1">Role</span>
                            <span class="text-slate-900 font-semibold">{{ str_replace('_', ' ', $user->role->name ?? 'user') }}</span>
                        </div>
                        <div>
                            <span class="block text-slate-400 font-medium mb-1">Company</span>
                            <span class="text-slate-900 font-semibold">{{ $user->company->name ?? 'No Company Assigned' }}</span>
                        </div>
                    </div>
                </div>

                <!-- TENANCY SYSTEM RESTRICTIONS -->
                <div class="bg-white border border-slate-200/80 rounded-xl p-5 shadow-sm space-y-3">
                    <div class="pb-2 border-b border-slate-100">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">Multi-Tenant Restrictions</h3>
                    </div>
                    
                    <div class="flex items-start space-x-3 text-xs bg-slate-50 p-3.5 rounded-lg border border-slate-100">
                        <i class="fa-solid fa-building-shield text-slate-400 mt-0.5 text-sm"></i>
                        <div class="space-y-1">
                            <span class="block text-slate-900 font-bold">Tenant Binding: {{ $user->company->name ?? 'No Company Assigned' }}</span>
                            <p class="text-[11px] text-slate-500 leading-relaxed font-medium">This profile is linked to the active company scope for the logged-in user. Cross-company access remains restricted unless an administrator changes the active tenant.</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- RIGHT AREA: AUDIT LOGS / ACCESS STATUS SECURITY BOX -->
            <div class="space-y-6">
                
                <!-- SECURITY & MANAGEMENT CARD -->
                <div class="bg-white border border-slate-200/80 rounded-xl p-5 shadow-sm space-y-4">
                    <div class="pb-2 border-b border-slate-100">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">Security Actions</h3>
                    </div>
                    
                    <div class="space-y-2">
                        <button class="w-full bg-slate-900 hover:bg-slate-800 text-white py-2 rounded-lg text-xs font-semibold transition-all shadow-sm flex items-center justify-center">
                            <i class="fa-solid fa-user-pen mr-2 text-[10px]"></i> Edit Profile Fields
                        </button>
                        <button class="w-full bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 py-2 rounded-lg text-xs font-semibold transition-all shadow-sm flex items-center justify-center">
                            <i class="fa-solid fa-key mr-2 text-[10px]"></i> Reset Security Access Pass
                        </button>
                        <button class="w-full bg-rose-50 border border-rose-100 text-rose-700 hover:bg-rose-100/70 py-2 rounded-lg text-xs font-semibold transition-all flex items-center justify-center">
                            <i class="fa-solid fa-ban mr-2 text-[10px]"></i> Suspend System Clearance
                        </button>
                    </div>
                </div>

                <!-- AUDIT TRAILS (When did they last log in?) -->
                <div class="bg-white border border-slate-200/80 rounded-xl p-5 shadow-sm space-y-3">
                    <div class="pb-2 border-b border-slate-100">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">Access Audit Trail</h3>
                    </div>

                    <div class="space-y-3 font-medium text-[11px]">
                        <div class="flex justify-between items-center text-slate-600">
                            <span class="flex items-center"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-2"></span> Session Opened</span>
                            <span class="text-slate-400 font-mono">{{ $user->created_at?->format('M d, Y') ?? 'Today' }}</span>
                        </div>
                        <div class="flex justify-between items-center text-slate-600">
                            <span class="flex items-center"><span class="w-1.5 h-1.5 rounded-full bg-slate-300 mr-2"></span> POS Sale Closed</span>
                            <span class="text-slate-400 font-mono">Yesterday, 17:05</span>
                        </div>
                        <div class="flex justify-between items-center text-slate-600">
                            <span class="flex items-center"><span class="w-1.5 h-1.5 rounded-full bg-slate-300 mr-2"></span> Logged In (IP: 192.168.1.4)</span>
                            <span class="text-slate-400 font-mono">Jun 22, 08:11</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</x-layout>