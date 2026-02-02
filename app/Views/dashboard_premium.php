<?php require_once 'header.php'; ?>

<div class="min-h-screen bg-slate-50/50 pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
        <!-- Header & Elite Actions -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <h1 class="text-4xl font-black text-slate-900 tracking-tight">Premium Insights</h1>
                    <span
                        class="bg-gradient-to-r from-brand-600 to-accent-600 text-white text-[10px] font-black uppercase tracking-widest px-2 py-1 rounded-full shadow-lg shadow-brand-500/20">Elite</span>
                </div>
                <p class="text-slate-500 font-medium">Hello,
                    <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?>. Welcome to your elite financial
                    ecosystem.
                </p>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex flex-col items-end">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Subscription</p>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span class="text-xs font-bold text-slate-900">Renew:
                            <?php echo isset($subscription['subscription_end_date']) ? date('M d, Y', strtotime($subscription['subscription_end_date'])) : 'N/A'; ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Overspending Alert -->
        <?php if (isset($overspendingAlert) && $overspendingAlert): ?>
            <div class="mb-10 animate-shake">
                <div class="bg-accent-50/50 border border-accent-200 rounded-3xl p-6 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 bg-accent-100 text-accent-600 rounded-2xl flex items-center justify-center shadow-inner">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-accent-900 font-black text-lg">Spending Alert</h4>
                            <p class="text-accent-700/70 font-medium">Your current spending
                                (<?php echo $currency_symbol . number_format($currentMonthTotal, 2); ?>) has exceeded last
                                month's
                                performance.</p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Shared Goals Premium Widget -->
        <div class="relative group mb-10">
            <div
                class="absolute -inset-1 bg-gradient-to-r from-brand-600 to-accent-600 rounded-[2.5rem] blur opacity-25 group-hover:opacity-40 transition-opacity">
            </div>
            <div
                class="relative bg-white rounded-[2.4rem] p-8 md:p-10 border border-brand-100 flex flex-col md:flex-row items-center justify-between gap-8 shadow-xl">
                <div class="max-w-xl">
                    <h3 class="text-3xl font-black text-slate-900 mb-3 tracking-tight">Financial Collaboration</h3>
                    <p class="text-slate-500 font-medium text-lg leading-relaxed">Leverage the power of Shared Goals.
                        Build collective wealth with your associates, family, or friends in real-time.</p>
                </div>
                <div class="flex items-center gap-6">
                    <div class="hidden sm:flex -space-x-4">
                        <div class="w-12 h-12 rounded-full border-4 border-white bg-slate-100 shadow-sm"></div>
                        <div class="w-12 h-12 rounded-full border-4 border-white bg-slate-200 shadow-sm"></div>
                        <div class="w-12 h-12 rounded-full border-4 border-white bg-slate-300 shadow-sm"></div>
                    </div>
                    <a href="/BudgetX/public/shared_goals"
                        class="btn-primary py-4 px-8 text-base font-black shadow-brand-500/30">Go to Shared Hub</a>
                </div>
            </div>
        </div>

        <!-- Premium Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="card-bento bg-slate-900 border-slate-800 text-white relative overflow-hidden group">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-brand-500/20 rounded-full blur-3xl"></div>
                <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px] mb-3">Net Worth</p>
                <h3 class="text-4xl font-black tracking-tight text-white">
                    <?php echo $currency_symbol . number_format($balance, 2); ?>
                </h3>
                <div class="mt-6 flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-500 italic">Liquid Assets</span>
                    <span class="text-xs font-black text-brand-400">+2.4% vs last week</span>
                </div>
            </div>
            <div class="card-bento relative overflow-hidden group">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-emerald-100 rounded-full blur-3xl opacity-50"></div>
                <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px] mb-3">Gross Income</p>
                <h3 class="text-4xl font-black text-emerald-600">
                    +<?php echo $currency_symbol . number_format($totalIncome, 2); ?></h3>
                <div class="mt-6 flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-400 italic">Total Inflow</span>
                    <div class="h-1.5 w-24 bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-emerald-500 w-2/3"></div>
                    </div>
                </div>
            </div>
            <div class="card-bento relative overflow-hidden group">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-accent-100 rounded-full blur-3xl opacity-50"></div>
                <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px] mb-3">Total Outflow</p>
                <h3 class="text-4xl font-black text-accent-600">
                    -<?php echo $currency_symbol . number_format($totalExpenses, 2); ?></h3>
                <div class="mt-6 flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-400 italic">Retention Rate</span>
                    <span
                        class="text-xs font-black text-slate-900"><?php echo number_format(($totalIncome > 0) ? (1 - $totalExpenses / $totalIncome) * 100 : 0, 1); ?>%</span>
                </div>
            </div>
        </div>

        <!-- Main Content Bento Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-12">
            <!--支出分布圖 Chart -->
            <div class="lg:col-span-4 card-bento">
                <h3 class="text-xl font-bold text-slate-900 mb-8">Category Breakdown</h3>
                <div class="h-72 w-full">
                    <canvas id="expensesChart"></canvas>
                </div>
            </div>

            <!-- Spending Trends Chart -->
            <div class="lg:col-span-8 card-bento">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-xl font-bold text-slate-900">Velocity & Trends</h3>
                    <div class="flex items-center gap-2">
                        <span class="flex items-center gap-1.5 text-xs font-bold text-slate-500">
                            <span class="w-1.5 h-1.5 rounded-full bg-brand-500"></span> Current Flow
                        </span>
                    </div>
                </div>
                <div class="h-72 w-full">
                    <canvas id="trendsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Bottom Grid: History & Transactions -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Monthly History -->
            <div class="lg:col-span-1 card-bento">
                <h3 class="text-xl font-bold text-slate-900 mb-8">Deep History</h3>
                <div class="space-y-4">
                    <?php if (empty($monthlyExpenses)): ?>
                        <div class="p-8 text-center bg-slate-50 rounded-3xl border-2 border-dashed border-slate-200">
                            <p class="text-slate-400 text-sm font-medium">No history available.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($monthlyExpenses as $stat): ?>
                            <div
                                class="flex items-center justify-between p-4 bg-slate-50/50 rounded-2xl group hover:bg-slate-900 hover:text-white transition-all duration-300">
                                <span
                                    class="font-bold text-sm tracking-tight"><?php echo date('F Y', strtotime($stat['month'])); ?></span>
                                <span
                                    class="text-sm font-black group-hover:text-brand-400"><?php echo $currency_symbol . number_format($stat['total'], 2); ?></span>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Recent Transactions Table Style -->
            <div class="lg:col-span-2 card-bento overflow-hidden">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-xl font-bold text-slate-900">Capital Movements</h3>
                    <div class="flex items-center gap-3">
                        <a href="/BudgetX/public/income/create"
                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition-colors"
                            title="Add Income">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </a>
                        <a href="/BudgetX/public/expenses/create"
                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-accent-50 text-accent-600 hover:bg-accent-100 transition-colors"
                            title="Add Expense">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="divide-y divide-slate-100">
                    <!-- Mixed Recent Transactions -->
                    <?php
                    $allRecent = [];
                    foreach ($recentIncome as $i)
                        $allRecent[] = array_merge($i, ['type' => 'income']);
                    foreach ($recentExpenses as $e)
                        $allRecent[] = array_merge($e, ['type' => 'expense']);
                    usort($allRecent, function ($a, $b) {
                        return strtotime($b['date']) - strtotime($a['date']);
                    });
                    $displayTransactions = array_slice($allRecent, 0, 8);
                    ?>

                    <?php foreach ($displayTransactions as $tx): ?>
                        <div class="py-4 flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 rounded-xl flex items-center justify-center <?php echo $tx['type'] === 'income' ? 'bg-emerald-50 text-emerald-600' : 'bg-accent-50 text-accent-600'; ?>">
                                    <?php if ($tx['type'] === 'income'): ?>
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                    <?php else: ?>
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 12H4" />
                                        </svg>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-900">
                                        <?php echo htmlspecialchars($tx['type'] === 'income' ? $tx['source'] : $tx['label']); ?>
                                    </p>
                                    <p class="text-[10px] font-medium text-slate-400 uppercase tracking-widest">
                                        <?php echo date('M d, Y', strtotime($tx['date'])); ?>
                                    </p>
                                </div>
                            </div>
                            <span
                                class="text-sm font-black <?php echo $tx['type'] === 'income' ? 'text-emerald-600' : 'text-accent-600'; ?>">
                                <?php echo $tx['type'] === 'income' ? '+' : '-'; ?>
                                <?php echo $currency_symbol . number_format($tx['amount'], 2); ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Chart Defaults
    Chart.defaults.font.family = 'Outfit';
    Chart.defaults.color = '#64748b';

    // Expenses Chart
    const ctx = document.getElementById('expensesChart').getContext('2d');
    const expensesData = <?php echo json_encode($expensesByCategory); ?>;
    const labels = expensesData.map(item => item.category);
    const data = expensesData.map(item => item.total);
    const backgroundColors = ['#0284c7', '#7c3aed', '#059669', '#f59e0b', '#dc2626', '#2563eb', '#475569'];

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: backgroundColors,
                borderWidth: 6,
                borderColor: '#ffffff',
                hoverOffset: 20
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '80%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#0f172a',
                    padding: 16,
                    cornerRadius: 16,
                    titleFont: { size: 14, weight: 'bold' },
                    bodyFont: { size: 14 },
                    displayColors: false
                }
            }
        }
    });

    // Trends Chart
    const trendsCtx = document.getElementById('trendsChart').getContext('2d');
    const trendsData = <?php echo json_encode($spendingTrends); ?>;
    const trendLabels = trendsData.map(item => {
        const d = new Date(item.month + "-01");
        return d.toLocaleDateString('default', { month: 'short' });
    });
    const trendValues = trendsData.map(item => item.total);

    const gradient = trendsCtx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(12, 165, 233, 0.4)');
    gradient.addColorStop(1, 'rgba(12, 165, 233, 0)');

    new Chart(trendsCtx, {
        type: 'line',
        data: {
            labels: trendLabels,
            datasets: [{
                label: 'Monthly Velocity',
                data: trendValues,
                borderColor: '#0ea5e9',
                borderWidth: 4,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#0ea5e9',
                pointBorderWidth: 4,
                pointRadius: 6,
                pointHoverRadius: 8,
                tension: 0.4,
                fill: true,
                backgroundColor: gradient
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#0f172a',
                    padding: 16,
                    cornerRadius: 16,
                    titleFont: { size: 14, weight: 'bold' },
                    bodyFont: { size: 14 },
                    displayColors: false
                }
            },
            scales: {
                y: {
                    grid: { display: true, borderDash: [5, 5], color: '#e2e8f0' },
                    ticks: { callback: value => '<?php echo $currency_symbol; ?>' + value }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });
</script>

<?php require_once 'footer.php'; ?>