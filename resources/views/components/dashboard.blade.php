

    <!-- PAGE HEADER AREA -->
    <div class="mb-8 rounded-3xl bg-[#025c78] px-6 py-6 text-white shadow-xl shadow-slate-900/10 relative overflow-hidden">
        <div class="absolute -top-10 right-0 h-32 w-32 rounded-full bg-white/10 blur-3xl"></div>
        <div class="absolute -bottom-8 left-8 h-24 w-24 rounded-full bg-cyan-300/20 blur-2xl"></div>

        <div class="relative flex flex-col gap-6 xl:flex-row xl:items-end xl:justify-between">
            <div class="space-y-3">
                <div class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/10 px-3 py-1.5 text-[10px] font-bold uppercase tracking-wider">
                    <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                    {{ $currentCompany->name ?? 'No Company Assigned' }}
                </div>
                <div>
                    <h1 class="text-3xl font-black tracking-tight sm:text-4xl">Welcome back, {{ auth()->user()->first_name }}</h1>
                    <p class="mt-2 max-w-2xl text-sm text-white/75">Live dashboard metrics for the currently selected company scope.</p>
                </div>
            </div>

            <div class="grid w-full gap-3 sm:grid-cols-2 xl:w-auto xl:min-w-[320px]">
                <div class="rounded-2xl border border-white/10 bg-white/10 p-4 backdrop-blur-sm">
                    <p class="text-[10px] font-bold uppercase tracking-wider text-white/60">Company</p>
                    <p class="mt-2 text-sm font-semibold">{{ $currentCompany->name ?? 'No Company Assigned' }}</p>
                </div>
                <div class="rounded-2xl border border-white/10 bg-white/10 p-4 backdrop-blur-sm">
                    <p class="text-[10px] font-bold uppercase tracking-wider text-white/60">Role</p>
                    <p class="mt-2 text-sm font-semibold">{{ str_replace('_', ' ', auth()->user()->role->name ?? 'user') }}</p>
                </div>
            </div>
        </div>

        <div class="relative mt-6 flex flex-wrap gap-2">
            <span class="rounded-full border border-white/10 bg-white/10 px-3 py-1.5 text-[11px] font-semibold">{{ auth()->user()->email }}</span>
            <span class="rounded-full border border-white/10 bg-white/10 px-3 py-1.5 text-[11px] font-semibold">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</span>
            <span class="rounded-full border border-white/10 bg-white/10 px-3 py-1.5 text-[11px] font-semibold">{{ auth()->user()->created_at?->format('M d, Y') }}</span>
        </div>

        <div class="relative mt-6 flex items-center justify-end gap-2">
            <button class="rounded-lg border border-white/10 bg-white/10 px-3.5 py-2 text-xs font-medium text-white transition hover:bg-white/15">
                <i class="fa-solid fa-calendar-days mr-1.5 text-white/70"></i> This Month
            </button>
            <button class="rounded-lg border border-white bg-white px-3.5 py-2 text-xs font-semibold text-slate-900 transition hover:bg-slate-100">
                <i class="fa-solid fa-cloud-arrow-down mr-1.5 text-slate-500"></i> Master Report
            </button>
        </div>
    </div>

    <!-- 📊 UNIFORM MINIMAL DASHBOARD CARD GRID -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Card 1: Active Inventory -->
        <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm flex items-center justify-between hover:border-slate-300 transition-all duration-200">
            <div class="space-y-1.5">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Active Inventory</span>
                <div class="flex items-baseline space-x-1">
                    <span class="text-3xl font-bold text-slate-900 tracking-tight">{{ number_format($activeInventoryCount) }}</span>
                    <span class="text-xs font-medium text-slate-400">units</span>
                </div>
            </div>
            <div class="w-10 h-10 rounded-lg border border-slate-200 text-slate-400 flex items-center justify-center text-base shadow-sm">
                <i class="fa-solid fa-gears"></i>
            </div>
        </div>

        <!-- Card 2: Low Stock Alerts -->
        <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm flex items-center justify-between hover:border-slate-300 transition-all duration-200">
            <div class="space-y-1.5">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Low Stock Alerts</span>
                <div class="flex items-baseline space-x-1">
                    <span class="text-3xl font-bold text-slate-900 tracking-tight">{{ $lowStockCount }}</span>
                    <span class="text-xs font-medium text-amber-600 font-semibold uppercase tracking-wide">Lines</span>
                </div>
            </div>
            <div class="w-10 h-10 rounded-lg border border-slate-200 text-slate-400 flex items-center justify-center text-base shadow-sm">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
        </div>

        <!-- Card 3: Monthly Orders -->
        <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm flex items-center justify-between hover:border-slate-300 transition-all duration-200">
            <div class="space-y-1.5">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Monthly Orders</span>
                <div class="flex items-baseline space-x-1">
                    <span class="text-3xl font-bold text-slate-900 tracking-tight">TZS {{ number_format($monthlyOrders, 2) }}</span>
                    <span class="text-xs font-medium text-slate-400">TZS</span>
                </div>
            </div>
            <div class="w-10 h-10 rounded-lg border border-slate-200 text-slate-400 flex items-center justify-center text-base shadow-sm">
                <i class="fa-solid fa-scale-balanced"></i>
            </div>
        </div>

        <!-- Card 4: Team Accounts -->
        <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm flex items-center justify-between hover:border-slate-300 transition-all duration-200">
            <div class="space-y-1.5">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Team Accounts</span>
                <div class="flex items-baseline space-x-1">
                    <span class="text-3xl font-bold text-slate-900 tracking-tight">{{ $teamAccounts }}</span>
                    <span class="text-xs font-medium text-slate-400">active</span>
                </div>
            </div>
            <div class="w-10 h-10 rounded-lg border border-slate-200 text-slate-400 flex items-center justify-center text-base shadow-sm">
                <i class="fa-solid fa-users"></i>
            </div>
        </div>
    </div>

    <!-- 📊 GRAPHICAL METRICS VIEWPORTS -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Big Chart: Order Value Trends (Takes 2 columns) -->
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm lg:col-span-2 p-5 flex flex-col justify-between">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3 mb-4">
                <div>
                    <h3 class="font-bold text-slate-800 text-xs uppercase tracking-wider">Parts Distribution & Revenue Trend</h3>
                    <p class="text-[11px] text-slate-400 mt-0.5">Calculated tracking values across the last 6 months.</p>
                </div>
                <span class="text-[10px] font-mono text-slate-400 bg-slate-50 border border-slate-200 px-2 py-0.5 rounded">{{ $currentCompany->name ?? 'Workspace' }}</span>
            </div>
            <div class="h-64 relative">
                <canvas id="revenueTrendChart"></canvas>
            </div>
        </div>

        <!-- Small Chart: Category Share breakdown (Takes 1 column) -->
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-5 flex flex-col justify-between">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3 mb-4">
                <h3 class="font-bold text-slate-800 text-xs uppercase tracking-wider">Inventory Share</h3>
                <i class="fa-solid fa-pie-chart text-slate-300 text-xs"></i>
            </div>
            <div class="h-64 relative flex items-center justify-center">
                <canvas id="inventoryShareChart"></canvas>
            </div>
        </div>
    </div>

    <!-- 📋 DATA RECORDS LISTING SECTION -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Table Layout (2 Columns Wide) -->
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm lg:col-span-2 overflow-hidden">
            <div class="p-5 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                <h3 class="font-bold text-slate-800 text-xs uppercase tracking-wider">Critical Material Supply Tracking</h3>
                <span class="text-[10px] font-mono border border-slate-200 text-slate-500 bg-slate-50 px-2 py-0.5 rounded">Live Metrics</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-slate-50 text-slate-400 font-semibold uppercase tracking-wider border-b border-slate-100">
                            <th class="p-4">Material Part Description</th>
                            <th class="p-4">SKU / Code</th>
                            <th class="p-4 text-center">In-Stock Count</th>
                            <th class="p-4 text-right">Urgency Matrix</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-600 font-medium">
                                @forelse ($lowStockItems as $item)
                                    <tr class="hover:bg-slate-50/50 transition-colors">
                                        <td class="p-4 text-slate-900">{{ $item->description }}</td>
                                        <td class="p-4 font-mono text-slate-400">{{ $item->sku }}</td>
                                        <td class="p-4 text-center font-bold text-slate-900">{{ $item->stock_count }}</td>
                                        <td class="p-4 text-right">
                                            <span class="text-[10px] font-bold {{ $item->stock_count === 0 ? 'text-slate-500 bg-slate-100 border-slate-200' : 'text-amber-700 bg-amber-50 border-amber-200/60' }} px-2 py-0.5 rounded border">
                                                {{ $item->stock_count === 0 ? 'Out of Stock' : 'Low Stock' }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="p-4 text-center text-slate-400">No low stock items for the current company.</td>
                                    </tr>
                                @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Right Operations Audit Feed (1 Column Wide) -->
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-5">
            <h3 class="font-bold text-slate-800 mb-4 text-sm uppercase tracking-wider pb-2 border-b border-slate-100">System Audit Trail</h3>
            <div class="space-y-4">
                <div class="flex space-x-3 text-xs">
                    <i class="fa-solid fa-building text-slate-400 mt-0.5"></i>
                    <div>
                        <p class="font-semibold text-slate-800">Current Company</p>
                        <p class="text-slate-400 mt-0.5 font-mono text-[10px]">{{ $currentCompany->name ?? 'No company selected' }}</p>
                    </div>
                </div>
                <div class="flex space-x-3 text-xs">
                    <i class="fa-solid fa-triangle-exclamation text-slate-400 mt-0.5"></i>
                    <div>
                        <p class="font-semibold text-slate-800">Low Stock Alerts</p>
                        <p class="text-slate-400 mt-0.5 font-mono text-[10px]">{{ $lowStockCount }} items need review for this company.</p>
                    </div>
                </div>
                @forelse ($recentSales as $sale)
                    <div class="flex space-x-3 text-xs">
                        <i class="fa-solid fa-receipt text-slate-400 mt-0.5"></i>
                        <div>
                            <p class="font-semibold text-slate-800">{{ $sale->invoice_number }}</p>
                            <p class="text-slate-400 mt-0.5 font-mono text-[10px]">{{ $sale->customer->company_name ?? 'Customer' }} · TZS {{ number_format($sale->total_amount, 2) }}</p>
                        </div>
                    </div>
                @empty
                    <div class="flex space-x-3 text-xs">
                        <i class="fa-solid fa-receipt text-slate-400 mt-0.5"></i>
                        <div>
                            <p class="font-semibold text-slate-800">No Recent Sales</p>
                            <p class="text-slate-400 mt-0.5 font-mono text-[10px]">This company has no sales recorded yet.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- 📦 VENDOR SCRIPTS (Loaded cleanly at the page bottom) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Line Chart Config (Revenue / Orders Trend)
        const ctxLine = document.getElementById('revenueTrendChart').getContext('2d');
        new Chart(ctxLine, {
            type: 'line',
            data: {
                    labels: @json($revenueTrendLabels),
                datasets: [{
                    label: 'Orders Value ($)',
                        data: @json($revenueTrendValues),
                    borderColor: '#475569', // Minimal slate grey trendline
                    borderWidth: 2,
                    backgroundColor: 'rgba(71, 85, 105, 0.02)',
                    fill: true,
                    tension: 0.2,
                    pointRadius: 3,
                    pointBackgroundColor: '#475569'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { grid: { color: '#f1f5f9' }, ticks: { font: { size: 10, family: 'monospace' }, color: '#94a3b8' } },
                    x: { grid: { display: false }, ticks: { font: { size: 10 }, color: '#94a3b8' } }
                }
            }
        });

        // Doughnut Chart Config (Inventory Categories Split)
        const ctxPie = document.getElementById('inventoryShareChart').getContext('2d');
        new Chart(ctxPie, {
            type: 'doughnut',
            data: {
                    labels: @json($inventoryShareLabels),
                datasets: [{
                    data: @json($inventoryShareValues),
                    backgroundColor: [
                        '#334155', // Dark slate accent
                        '#64748b', // Medium slate body
                        '#cbd5e1'  // Light border slate
                    ],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { boxWidth: 10, font: { size: 10, weight: '500' }, color: '#64748b' }
                    }
                },
                cutout: '78%'
            }
        });
    </script>
