
    <div class="max-w-5xl mx-auto px-4 py-8">
        
        <!-- PAGE HEADER AREA -->
        <div class="mb-8 pb-5 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-lg font-bold tracking-tight text-slate-900">System Configuration</h1>
                <p class="text-xs text-slate-400 mt-0.5">Define industrial node parameters, tax bounds, safety stock rules, and access control scopes.</p>
            </div>
            <div>
                <button type="submit" form="settings-form" class="bg-slate-900 hover:bg-slate-800 text-white text-xs font-semibold py-1.5 px-4 rounded-lg transition shadow-xs flex items-center space-x-2">
                    <i class="fa-solid fa-floppy-disk text-[11px]"></i>
                    <span>Commit Changes</span>
                </button>
            </div>
        </div>

        <!-- MAIN DUAL-COLUMN CONFIGURATION GRID -->
        <form id="settings-form" action="#" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- LEFT COLUMN: FINANCIAL & NODE VARIABLES (2/3 Width) -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Box 1: Core Financial Parameters -->
                    <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm">
                        <div class="border-b border-slate-100 pb-3 mb-4">
                            <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Accounting & Ledger Defaults</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs font-medium">
                            <div>
                                <label class="text-slate-400 font-bold uppercase tracking-wider text-[10px] block mb-1.5">Base Operating Currency</label>
                                <select class="w-full bg-slate-50 border border-slate-200 rounded-lg p-2 font-medium text-slate-800 focus:bg-white focus:border-slate-400 focus:outline-hidden transition-all">
                                    <option value="USD">USD ($) — United States Dollar</option>
                                    <option value="EUR">EUR (€) — Euro Area</option>
                                </select>
                            </div>
                            <div>
                                <label class="text-slate-400 font-bold uppercase tracking-wider text-[10px] block mb-1.5">Industrial VAT / Tax Standard</label>
                                <div class="relative flex items-center">
                                    <input type="number" step="0.1" value="18.0" class="w-full bg-slate-50 border border-slate-200 rounded-lg p-2 font-medium text-slate-800 focus:bg-white focus:border-slate-400 focus:outline-hidden transition-all pr-8">
                                    <span class="absolute right-3 text-slate-400 font-mono text-[11px] font-bold">%</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Box 2: Inventory Rules & Alert Triggers -->
                    <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm">
                        <div class="border-b border-slate-100 pb-3 mb-4">
                            <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Inventory Threshold Formulas</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs font-medium">
                            <div>
                                <label class="text-slate-400 font-bold uppercase tracking-wider text-[10px] block mb-1.5">Global Safety Low-Stock Limit</label>
                                <div class="relative flex items-center">
                                    <input type="number" value="5" class="w-full bg-slate-50 border border-slate-200 rounded-lg p-2 font-medium text-slate-800 focus:bg-white focus:border-slate-400 focus:outline-hidden transition-all pr-12">
                                    <span class="absolute right-3 text-slate-400 text-[10px] font-bold uppercase tracking-wider">Units</span>
                                </div>
                                <p class="text-[10px] text-slate-400 mt-1.5 leading-relaxed">Global fall-back metric to flag items on the dashboard metrics card automatically.</p>
                            </div>
                            <div>
                                <label class="text-slate-400 font-bold uppercase tracking-wider text-[10px] block mb-1.5">Critical Out-of-Stock Locking</label>
                                <select class="w-full bg-slate-50 border border-slate-200 rounded-lg p-2 font-medium text-slate-800 focus:bg-white focus:border-slate-400 focus:outline-hidden transition-all">
                                    <option value="lock">Restrict Sales Counter when Stock is 0</option>
                                    <option value="allow">Allow Back-Orders / Negative Counts</option>
                                </select>
                                <p class="text-[10px] text-slate-400 mt-1.5 leading-relaxed">Controls if terminal operators can dispatch parts before a warehouse check-in.</p>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- RIGHT COLUMN: NODE INFRASTRUCTURE & BACKUPS (1/3 Width) -->
                <div class="space-y-6">
                    
                    <!-- Box 3: Network Infrastructure Reference -->
                    <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm flex flex-col justify-between">
                        <div>
                            <div class="border-b border-slate-100 pb-3 mb-4 flex items-center justify-between">
                                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Node Architecture</h3>
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            </div>
                            
                            <div class="space-y-3 text-xs">
                                <div>
                                    <span class="text-slate-400 block font-bold uppercase tracking-wider text-[9px]">Active Branch Identity</span>
                                    <span class="text-slate-900 font-mono font-bold mt-0.5 block">2B-HQ (Main Warehouse Hub)</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 block font-bold uppercase tracking-wider text-[9px]">Database Cluster Sync</span>
                                    <span class="text-slate-600 font-medium mt-0.5 block">Automated every 10 minutes</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="pt-4 border-t border-slate-100 mt-6">
                            <button type="button" class="w-full group p-2.5 rounded-lg border border-slate-200 bg-slate-50/40 hover:bg-white hover:border-slate-400 transition-all text-left flex items-center justify-between">
                                <span class="text-[11px] font-bold text-slate-700 group-hover:text-slate-900 uppercase tracking-wide">Test Node Ping</span>
                                <i class="fa-solid fa-network-wired text-[10px] text-slate-400 group-hover:text-slate-900"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Box 4: System Diagnostics Clearance -->
                    <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm">
                        <div class="border-b border-slate-100 pb-3 mb-4">
                            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Instance Verification</h3>
                        </div>
                        <div class="text-[11px] text-slate-500 space-y-2">
                            <p>You are managing settings as <span class="font-bold text-slate-900">UID-{{ auth()->user()->id }}</span>.</p>
                            <p class="bg-slate-50 border border-slate-200 p-2 rounded font-mono text-[10px] text-slate-600 leading-normal">
                                Security Hash Scoped:<br>
                                SHA-256 Verified Node Block
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </form>

    </div>
