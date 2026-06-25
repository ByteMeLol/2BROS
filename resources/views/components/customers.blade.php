
    <div class="max-w-5xl mx-auto px-4 py-8" x-data="{ openCustomerModal: false }">
        
        <!-- PAGE HEADER AREA -->
        <div class="mb-8 pb-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
            <div>
                <h1 class="text-xl font-bold tracking-tight text-slate-900">Customer Directory</h1>
                <p class="text-xs text-slate-500 mt-1.5">Central database for corporate contact cards, shipping hubs, and communication records.</p>
            </div>
            <div class="flex items-center space-x-2">
                <button class="bg-white border border-slate-200 text-slate-600 px-3.5 py-2 rounded-lg text-xs font-medium hover:bg-slate-50 transition shadow-sm">
                    <i class="fa-solid fa-file-export mr-1.5 text-slate-400"></i> Export Rolodex
                </button>
                <!-- FIXED MODAL TRIGGER -->
                <button type="button" onclick="toggleModal('customer-modal', true)"
                        class="bg-slate-900 hover:bg-slate-800 text-white px-3.5 py-2 rounded-lg text-xs font-semibold transition shadow-sm shadow-slate-900/10">
                    <i class="fa-solid fa-user-plus mr-1.5 text-slate-300"></i> Create Contact Profile
                </button>
            </div>
        </div>

        <!-- 📊 CONTACT INSIGHT CARDS -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Card 1: Total Corporate Nodes -->
            <div class="bg-white rounded-xl border border-slate-200/80 p-5 shadow-sm flex items-center justify-between hover:border-slate-300 transition-all duration-200">
                <div class="space-y-1.5">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Total Customers</span>
                    <div class="flex items-baseline space-x-1">
                        <span class="text-3xl font-bold text-slate-900 tracking-tight">{{$customers->count()}}</span>
                        <span class="text-xs font-medium text-slate-400">active profiles</span>
                    </div>
                </div>
                <div class="w-9 h-9 rounded-lg border border-slate-200/60 text-slate-400 flex items-center justify-center text-sm shadow-sm">
                    <i class="fa-solid fa-address-book"></i>
                </div>
            </div>

            <!-- Card 2: Industrial Categorization -->
            <div class="bg-white rounded-xl border border-slate-200/80 p-5 shadow-sm flex items-center justify-between hover:border-slate-300 transition-all duration-200">
                <div class="space-y-1.5">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Industry Verticals</span>
                    <div class="flex items-baseline space-x-1">
                        <span class="text-3xl font-bold text-slate-900 tracking-tight">{{ $customers->count() }}</span>
                        <span class="text-xs font-medium text-slate-400">sectors mapped</span>
                    </div>
                </div>
                <div class="w-9 h-9 rounded-lg border border-slate-200/60 text-slate-400 flex items-center justify-center text-sm shadow-sm">
                    <i class="fa-solid fa-industry"></i>
                </div>
            </div>

            <!-- Card 3: Missing Primary Contact Alert -->
            <div class="bg-white rounded-xl border border-slate-200/80 p-5 shadow-sm flex items-center justify-between hover:border-slate-300 transition-all duration-200">
                <div class="space-y-1.5">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Incomplete Records</span>
                    <div class="flex items-baseline space-x-1">
                        <span class="text-3xl font-bold text-slate-900 tracking-tight">{{ $customers->count() }}</span>
                        <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider bg-emerald-50 border border-emerald-100 px-1.5 py-0.5 rounded">All Verified</span>
                    </div>
                </div>
                <div class="w-9 h-9 rounded-lg border border-slate-200/60 text-slate-400 flex items-center justify-center text-sm shadow-sm">
                    <i class="fa-solid fa-shield-check"></i>
                </div>
            </div>
        </div>

        <!-- 📋 THE DETAILS LEDGER -->
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
            <div class="p-4 border-b border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h3 class="font-bold text-slate-900 text-xs uppercase tracking-wider">Tenant Directory Database</h3>
                    <p class="text-[10px] text-slate-400 mt-0.5">Isolated customer communication parameters for this workspace entity.</p>
                </div>
                <!-- Search bar -->
                <div class="relative max-w-xs w-full">
                    <input type="text" placeholder="Search contacts, phone numbers, addresses..." 
                           class="w-full bg-white border border-slate-200 rounded-lg py-1.5 pl-8 pr-3 text-xs text-slate-900 placeholder-slate-400 outline-none focus:border-slate-400 transition-colors shadow-inner">
                    <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-2.5 text-[10px] text-slate-400"></i>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-slate-50 text-slate-400 font-bold uppercase tracking-wider border-b border-slate-100">
                            <th class="p-4">Company Entity</th>
                            <th class="p-4">Primary Contact Person</th>
                            <th class="p-4">Direct Contact Info</th>
                            <th class="p-4">Primary Delivery Address</th>
                            <th class="p-4">Tax / Business ID</th>
                            <th class="p-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-600 font-medium">
                        <!-- Customer Profile 1 -->
                        @foreach ($customers as $cachedContents )
                            <tr class="hover:bg-slate-50/30 transition-colors">
                            <td class="p-4">
                                <span class="text-slate-900 block font-bold">{{ $cachedContents->company_name }}</span>
                                <span class="text-[10px] text-slate-400 block font-normal">Registered: 2026-02-14</span>
                            </td>
                            <td class="p-4">
                                <span class="text-slate-900 block font-semibold">{{ $cachedContents->contact_person }}</span>
                                <span class="text-[10px] text-slate-400 block font-normal">{{ $cachedContents->contact_role }}</span>
                            </td>
                            <td class="p-4 space-y-0.5">
                                <span class="text-slate-700 block font-mono text-[11px]"><i class="fa-solid fa-envelope text-slate-300 mr-1 w-3.5"></i>{{ $cachedContents->email }}</span>
                                <span class="text-slate-400 block font-mono text-[11px]"><i class="fa-solid fa-phone text-slate-300 mr-1 w-3.5"></i>{{ $cachedContents->phone }}</span>
                            </td>
                            <td class="p-4 max-w-[200px] truncate">
                                <span class="text-slate-700 block font-semibold">{{ $cachedContents->address }}</span>
                            </td>
                            <td class="p-4 font-mono text-slate-400">{{ $cachedContents->tax_id }}</td>
                            <td class="p-4 text-right space-x-1">
                                <button class="text-slate-400 hover:text-slate-900 p-1 transition-colors" title="Edit Contact Details"><i class="fa-solid fa-user-gear text-xs"></i></button>
                                <button class="text-slate-400 hover:text-slate-900 p-1 transition-colors" title="View Map Location"><i class="fa-solid fa-map-location-dot text-xs"></i></button>
                            </td>
                        </tr>
                        @endforeach
                        
                        
                        <!-- Customer Profile 2 -->
                        
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination Component -->
            {{-- <div class="p-4 border-t border-slate-100 bg-slate-50/30 flex items-center justify-between text-[11px] text-slate-400 font-medium">
                <span>Showing 2 profile structures for active tenant scope</span>
                <div class="flex items-center space-x-1">
                    <button class="px-2.5 py-1 border border-slate-200 rounded bg-white hover:bg-slate-50 disabled:opacity-50" disabled>Previous</button>
                    <button class="px-2.5 py-1 border border-slate-200 rounded bg-white hover:bg-slate-50 disabled:opacity-50" disabled>Next</button>
                </div>
            </div> --}}
        </div>

        <!-- 📥 CREATE CUSTOMER PROFILE POP-UP MODAL -->
        <div id="customer-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto">
            <!-- Dim Backdrop -->
            <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="toggleModal('customer-modal', false)"></div>

            <!-- Modal Content Box -->
            <div class="bg-white border border-slate-200 rounded-xl shadow-xl w-full max-w-md overflow-hidden relative z-10 transform transition-all">
                
                <!-- Modal Header -->
                <div class="p-4 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-900">Create Contact Profile</h3>
                        <p class="text-[10px] text-slate-400 mt-0.5">Introduce a new corporate entity profile to the database ledger.</p>
                    </div>
                    <button type="button" onclick="toggleModal('customer-modal', false)" class="text-slate-400 hover:text-slate-600 p-1">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>

                <!-- Modal Form Content -->
                <form action="/customers" method="POST" class="p-5 space-y-4">
                    @csrf

                    <!-- Company Field -->
                    <div class="space-y-1">
                        <label for="company_name" class="block text-[11px] font-semibold text-slate-700">Company Legal Name</label>
                        <input type="text" name="name" id="company_name" required placeholder="e.g. Apex Mining Solutions" 
                               class="w-full bg-slate-50/50 border border-slate-200 rounded-lg py-1.5 px-2.5 text-xs text-slate-900 outline-none focus:bg-white focus:border-slate-900 transition-all">
                    </div>

                    <!-- Contact Agent Fields -->
                    <div class="grid grid-cols-2 gap-3">
                        <div class="space-y-1">
                            <label for="contact_name" class="block text-[11px] font-semibold text-slate-700">Primary Contact Person</label>
                            <input type="text" name="contact_name" id="contact_name" required placeholder="Marcus Vance" 
                                   class="w-full bg-slate-50/50 border border-slate-200 rounded-lg py-1.5 px-2.5 text-xs text-slate-900 outline-none focus:bg-white focus:border-slate-900 transition-all">
                        </div>
                        <div class="space-y-1">
                            <label for="contact_role" class="block text-[11px] font-semibold text-slate-700">Agent Job Title</label>
                            <input type="text" name="contact_role" id="contact_role" placeholder="Procurement Director" 
                                   class="w-full bg-slate-50/50 border border-slate-200 rounded-lg py-1.5 px-2.5 text-xs text-slate-900 outline-none focus:bg-white focus:border-slate-900 transition-all">
                        </div>
                    </div>

                    <!-- Contact Info Fields -->
                    <div class="grid grid-cols-2 gap-3">
                        <div class="space-y-1">
                            <label for="email" class="block text-[11px] font-semibold text-slate-700">Email Address</label>
                            <input type="email" name="email" id="email" required placeholder="name@company.com" 
                                   class="w-full bg-slate-50/50 border border-slate-200 rounded-lg py-1.5 px-2.5 text-xs text-slate-900 outline-none focus:bg-white focus:border-slate-900 transition-all">
                        </div>
                        <div class="space-y-1">
                            <label for="phone" class="block text-[11px] font-semibold text-slate-700">Phone Number</label>
                            <input type="tel" name="phone" id="phone" placeholder="+255 689 254 189" 
                                   class="w-full bg-slate-50/50 border border-slate-200 rounded-lg py-1.5 px-2.5 text-xs text-slate-900 outline-none focus:bg-white focus:border-slate-900 transition-all">
                        </div>
                    </div>

                    <!-- Address & Tax Info -->
                    <div class="space-y-1">
                        <label for="delivery_address" class="block text-[11px] font-semibold text-slate-700">Primary Delivery Address</label>
                        <input type="text" name="address" id="delivery_address" placeholder="Warehouse 4B, Sector North" 
                               class="w-full bg-slate-50/50 border border-slate-200 rounded-lg py-1.5 px-2.5 text-xs text-slate-900 outline-none focus:bg-white focus:border-slate-900 transition-all">
                    </div>

                    <div class="space-y-1">
                        <label for="tax_id" class="block text-[11px] font-semibold text-slate-700">Tax / Business Registration ID</label>
                        <input type="text" name="tax_id" id="tax_id" placeholder="992018442" 
                               class="w-full bg-slate-50/50 border border-slate-200 rounded-lg py-1.5 px-2.5 text-xs text-slate-900 outline-none focus:bg-white focus:border-slate-900 transition-all">
                    </div>

                    <!-- Actions Footer -->
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-end space-x-2">
                        <button type="button" onclick="toggleModal('customer-modal', false)" 
                                class="bg-white border border-slate-200 text-slate-600 px-3.5 py-1.5 rounded-lg text-xs font-medium hover:bg-slate-50 transition-all">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="bg-slate-900 hover:bg-slate-800 text-white px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-all shadow-sm">
                            Save Account Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <!-- PLACE THIS AT THE BOTTOM OF YOUR VIEW FILE -->
    <script>
        function toggleModal(modalId, actionState) {
            const targetModal = document.getElementById(modalId);
            if (targetModal) {
                if (actionState) {
                    targetModal.classList.remove('hidden');
                } else {
                    targetModal.classList.add('hidden');
                }
            }
        }
    </script>


