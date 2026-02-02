<?php require_once 'header.php'; ?>

<div class="min-h-screen bg-slate-50/50 pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
        <!-- Header & Quick Actions -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
            <div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight">Overview</h1>
                <p class="text-slate-500 font-medium mt-1">Hello,
                    <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?>. Here's your financial status.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <div class="flex -space-x-2">
                    <div
                        class="w-8 h-8 rounded-full border-2 border-white bg-brand-100 flex items-center justify-center text-[10px] font-bold text-brand-600">
                        JD</div>
                    <div
                        class="w-8 h-8 rounded-full border-2 border-white bg-accent-100 flex items-center justify-center text-[10px] font-bold text-accent-600">
                        SM</div>
                </div>
                <span class="text-xs font-bold text-slate-400 ml-2">Shared with 2 others</span>
            </div>
        </div>

        <!-- Stats Row: High Performance Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
            <!-- Balance Card -->
            <div class="card-bento bg-gradient-to-br from-brand-600 to-brand-700 text-white relative overflow-hidden">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-white/10 rounded-full blur-2xl"></div>
                <p class="text-brand-100 font-bold uppercase tracking-widest text-[10px] mb-2">Available Balance</p>
                <div class="flex items-baseline gap-1">
                    <span
                        class="text-4xl font-black"><?php echo $currency_symbol . number_format($balance, 2); ?></span>
                </div>
                <div class="mt-6 pt-4 border-t border-white/10 flex items-center justify-between">
                    <span class="text-[10px] font-bold text-brand-200 uppercase">Primary Account</span>
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                </div>
            </div>

            <!-- Income Card -->
            <div class="card-bento flex flex-col justify-between group">
                <div>
                    <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px] mb-2">Monthly Inflow</p>
                    <h3 class="text-3xl font-black text-slate-900 group-hover:text-emerald-600 transition-colors">
                        +<?php echo $currency_symbol . number_format($totalIncome, 2); ?></h3>
                </div>
                <div
                    class="mt-4 flex items-center text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-md w-fit">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                            d="M5 10l7-7m0 0l7 7m-7-7v18" />
                    </svg>
                    High Liquidity
                </div>
            </div>

            <!-- Expenses Card -->
            <div class="card-bento flex flex-col justify-between group">
                <div>
                    <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px] mb-2">Monthly Outflow</p>
                    <h3 class="text-3xl font-black text-slate-900 group-hover:text-accent-600 transition-colors">
                        -<?php echo $currency_symbol . number_format($totalExpenses, 2); ?></h3>
                </div>
                <div
                    class="mt-4 flex items-center text-[10px] font-bold text-accent-600 bg-accent-50 px-2 py-1 rounded-md w-fit">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                            d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                    </svg>
                    Monitored
                </div>
            </div>
        </div>

        <!-- Analytics Section -->
        <!-- Feature Implementation: Spending Analytics (Basic) -->
        <!-- Shows a doughnut chart of expenses categorized by user-defined categories -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-10">
            <div class="lg:col-span-8 card-bento p-8">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="text-xl font-black text-slate-900">Spending Distribution</h3>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Allocation by
                            Category</p>
                    </div>
                </div>
                <div class="h-80">
                    <canvas id="expensesChart"></canvas>
                </div>
            </div>

            <div class="lg:col-span-4 flex flex-col gap-6">
                <!-- Feature: User Profile & Account Status -->
                <!-- Displays current role and basic analytics summary -->
                <div class="card-bento bg-slate-900 text-white relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-4">
                        <form action="/BudgetX/public/profile/upload" method="POST" enctype="multipart/form-data"
                            id="profileForm">
                            <label for="profile_upload"
                                class="cursor-pointer text-slate-500 hover:text-brand-400 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </label>
                            <input type="file" name="profile_pic" id="profile_upload" class="hidden"
                                onchange="document.getElementById('profileForm').submit()">
                        </form>
                    </div>
                    <div class="flex items-center gap-4 mb-6">
                        <div
                            class="w-14 h-14 rounded-2xl bg-brand-500/20 flex items-center justify-center border border-brand-500/30 overflow-hidden shadow-inner">
                            <?php if (isset($_SESSION['profile_pic'])): ?>
                                <img src="/BudgetX/public/uploads/profile/<?php echo $_SESSION['profile_pic']; ?>"
                                    class="w-full h-full object-cover">
                            <?php else: ?>
                                <span
                                    class="text-xl font-black text-brand-400"><?php echo substr($_SESSION['username'] ?? 'U', 0, 1); ?></span>
                            <?php endif; ?>
                        </div>
                        <div>
                            <h4 class="text-lg font-black tracking-tight">
                                <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?>
                            </h4>
                            <div class="flex flex-col">
                                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">
                                    <?php echo ucfirst($_SESSION['role'] ?? 'Member'); ?> Account
                                </p>
                                <p
                                    class="text-[9px] font-black <?php echo ($subscription['subscription_status'] === 'ACTIVE') ? 'text-emerald-400' : 'text-slate-500'; ?> uppercase tracking-widest mt-0.5">
                                    Status: <?php echo $subscription['subscription_status'] ?? 'INACTIVE'; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 bg-white/5 rounded-xl border border-white/5">
                            <span class="text-xs font-bold text-slate-400">Monthly Yield</span>
                            <span class="text-xs font-black text-emerald-400">+12.4%</span>
                        </div>
                        <!-- Option to Upgrade (Present in sidebar) -->
                        <a href="/BudgetX/public/upgrade"
                            class="btn-primary w-full !py-2 text-xs flex items-center justify-center gap-2">
                            Upgrade to Premium
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Summary -->
                <div class="card-bento flex-1">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">Quick Insights</p>
                    <div class="space-y-4">
                        <div class="flex items-baseline justify-between">
                            <span class="text-sm font-bold text-slate-600">Daily Average</span>
                            <span
                                class="text-lg font-black text-slate-900"><?php echo $currency_symbol . number_format($totalExpenses / 30, 2); ?></span>
                        </div>
                        <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                            <div class="bg-brand-500 h-full w-[65%] rounded-full"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- NEW: Prominent Upgrade Banner -->
        <!-- Feature Implementation: Premium Upsell Banner -->
        <!-- Encourages basic users to upgrade by highlighting exclusive premium features -->
        <div class="relative group mb-10">
            <div
                class="absolute -inset-1 bg-gradient-to-r from-brand-600 to-accent-600 rounded-3xl blur opacity-25 group-hover:opacity-40 transition-opacity">
            </div>
            <div
                class="relative bg-white rounded-3xl p-8 border border-brand-100 flex flex-col md:flex-row items-center justify-between gap-6 shadow-xl">
                <div class="flex items-center gap-6">
                    <div
                        class="w-16 h-16 bg-brand-50 rounded-2xl flex items-center justify-center text-brand-600 flex-shrink-0">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-slate-900 mb-1">Unlock Scientific Wealth Management</h3>
                        <p class="text-slate-500 font-medium text-sm leading-relaxed">Join Premium to access Shared
                            Goals, Deep Analytics, and Overspending Alerts.</p>
                    </div>
                </div>
                <a href="/BudgetX/public/upgrade"
                    class="btn-primary py-3 px-8 text-sm font-black whitespace-nowrap shadow-lg shadow-brand-500/20">
                    Get Premium Access
                </a>
            </div>
        </div>

        <!-- Detailed Transactions Split -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Income -->
            <div class="card-bento p-0 overflow-hidden">
                <div class="p-6 border-b border-slate-50 flex items-center justify-between bg-slate-50/30">
                    <h3 class="text-lg font-black text-slate-900">Recent Income</h3>
                    <div class="flex items-center gap-2">
                        <a href="/BudgetX/public/income/create"
                            class="p-2 bg-emerald-50 text-emerald-600 rounded-xl hover:bg-emerald-100 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </a>
                        <a href="/BudgetX/public/income"
                            class="text-xs font-bold text-brand-600 hover:underline px-2">View all</a>
                    </div>
                </div>
                <div class="divide-y divide-slate-50">
                    <?php if (empty($recentIncome)): ?>
                        <div class="p-12 text-center">
                            <p class="text-sm font-bold text-slate-300 uppercase tracking-widest">No entries yet</p>
                        </div>
                    <?php else: ?>
                        <?php foreach (array_slice($recentIncome, 0, 5) as $income): ?>
                            <div class="flex items-center justify-between p-6 hover:bg-slate-50/50 transition-colors">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-black text-slate-900">
                                            <?php echo htmlspecialchars($income['source']); ?>
                                        </p>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                                            <?php echo date('M d, Y', strtotime($income['date'])); ?>
                                        </p>
                                    </div>
                                </div>
                                <span
                                    class="text-sm font-black text-emerald-600">+<?php echo $currency_symbol . number_format($income['amount'], 2); ?></span>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Recent Expenses -->
            <div class="card-bento p-0 overflow-hidden">
                <div class="p-6 border-b border-slate-50 flex items-center justify-between bg-slate-50/30">
                    <h3 class="text-lg font-black text-slate-900">Recent Expenses</h3>
                    <div class="flex items-center gap-2">
                        <a href="/BudgetX/public/expenses/create"
                            class="p-2 bg-accent-50 text-accent-600 rounded-xl hover:bg-accent-100 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                            </svg>
                        </a>
                        <a href="/BudgetX/public/expenses"
                            class="text-xs font-bold text-brand-600 hover:underline px-2">View all</a>
                    </div>
                </div>
                <div class="divide-y divide-slate-50">
                    <?php if (empty($recentExpenses)): ?>
                        <div class="p-12 text-center">
                            <p class="text-sm font-bold text-slate-300 uppercase tracking-widest">No entries yet</p>
                        </div>
                    <?php else: ?>
                        <?php foreach (array_slice($recentExpenses, 0, 5) as $expense): ?>
                            <div class="flex items-center justify-between p-6 hover:bg-slate-50/50 transition-colors">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-accent-50 flex items-center justify-center text-accent-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-black text-slate-900">
                                            <?php echo htmlspecialchars($expense['label']); ?>
                                        </p>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                                            <?php echo htmlspecialchars($expense['category']); ?> •
                                            <?php echo date('M d, Y', strtotime($expense['date'])); ?>
                                        </p>
                                    </div>
                                </div>
                                <span
                                    class="text-sm font-black text-accent-600">-<?php echo $currency_symbol . number_format($expense['amount'], 2); ?></span>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('expensesChart').getContext('2d');
    const expensesData = <?php echo json_encode($expensesByCategory); ?>;

    const labels = expensesData.map(item => item.category);
    const data = expensesData.map(item => item.total);

    // New refined color palette
    const backgroundColors = [
        '#0284c7', // brand-600
        '#7c3aed', // accent-600
        '#059669', // emerald-600
        '#f59e0b', // amber-500
        '#dc2626', // red-600
        '#2563eb', // blue-600
        '#475569'  // slate-600
    ];

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: backgroundColors,
                borderWidth: 4,
                borderColor: '#ffffff',
                hoverOffset: 15,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '75%',
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'circle',
                        padding: 20,
                        font: {
                            family: 'Outfit',
                            size: 12,
                            weight: '600'
                        },
                        color: '#64748b'
                    }
                },
                tooltip: {
                    backgroundColor: '#1e293b',
                    padding: 12,
                    titleFont: { family: 'Outfit', size: 14, weight: 'bold' },
                    bodyFont: { family: 'Outfit', size: 13 },
                    cornerRadius: 12,
                    displayColors: false
                }
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    });
</script>

<?php require_once 'footer.php'; ?>