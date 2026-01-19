<?php require_once '../app/Views/partials/header.php'; ?>

<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Premium Dashboard</h1>
            <span
                class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                Premium Account
            </span>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-3 mb-8">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">Total Balance</dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">$
                        <?php echo number_format($balance, 2); ?>
                    </dd>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">Total Income</dt>
                    <dd class="mt-1 text-3xl font-semibold text-green-600">+$
                        <?php echo number_format($totalIncome, 2); ?>
                    </dd>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">Total Expenses</dt>
                    <dd class="mt-1 text-3xl font-semibold text-red-600">-$
                        <?php echo number_format($totalExpenses, 2); ?>
                    </dd>
                </div>
            </div>
        </div>

        <!-- Shared Goals Widget (Premium Feature) -->
        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg shadow-lg p-6 mb-8 text-white">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-bold">Collaborate on Goals</h3>
                    <p class="text-indigo-100 text-sm mt-1">You have access to Shared Goals. Plan together with friends
                        and family.</p>
                </div>
                <a href="/BudgetX/public/shared_goals"
                    class="bg-white text-indigo-600 px-4 py-2 rounded-lg font-medium hover:bg-indigo-50 transition-colors">
                    View Shared Goals
                </a>
            </div>
        </div>

        <!-- Overspending Alert -->
        <?php if (isset($overspendingAlert) && $overspendingAlert): ?>
            <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-8">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <!-- Heroicon name: solid/exclamation -->
                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">
                            Alert: Your spending this month ($<?php echo number_format($currentMonthTotal, 2); ?>) is higher than last month ($<?php echo number_format($prevMonthTotal, 2); ?>).
                        </p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Expenses by Category</h3>
                <div class="relative h-64 w-full">
                    <canvas id="expensesChart"></canvas>
                </div>
            </div>
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Spending Trends (Last 6 Months)</h3>
                <div class="relative h-64 w-full">
                    <canvas id="trendsChart"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Monthly Analytics Table -->
         <div class="bg-white shadow rounded-lg overflow-hidden mb-8">
            <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Monthly Expenses History</h3>
            </div>
            <ul class="divide-y divide-gray-200">
                <?php if (empty($monthlyExpenses)): ?>
                    <li class="px-4 py-4 text-sm text-gray-500">No history available.</li>
                <?php else: ?>
                    <?php foreach ($monthlyExpenses as $stat): ?>
                        <li class="px-4 py-4 flex items-center justify-between hover:bg-gray-50">
                            <div class="text-sm font-medium text-gray-900">
                                <?php echo htmlspecialchars(date('F Y', strtotime($stat['month']))); ?>
                            </div>
                            <div class="text-sm text-gray-500 font-semibold">
                                $<?php echo number_format($stat['total'], 2); ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Recent Transactions -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Income -->
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Recent Income</h3>
                </div>
                <ul class="divide-y divide-gray-200">
                    <?php if (empty($recentIncome)): ?>
                        <li class="px-4 py-4 text-sm text-gray-500">No recent income records.</li>
                    <?php else: ?>
                        <?php foreach (array_slice($recentIncome, 0, 5) as $income): ?>
                            <li class="px-4 py-4 flex items-center justify-between hover:bg-gray-50">
                                <div class="text-sm font-medium text-gray-900">
                                    <?php echo htmlspecialchars($income['source']); ?>
                                </div>
                                <div class="text-sm text-green-600 font-semibold">+$
                                    <?php echo number_format($income['amount'], 2); ?>
                                </div>
                                <div class="text-sm text-gray-500">
                                    <?php echo htmlspecialchars($income['date']); ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Recent Expenses -->
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Recent Expenses</h3>
                </div>
                <ul class="divide-y divide-gray-200">
                    <?php if (empty($recentExpenses)): ?>
                        <li class="px-4 py-4 text-sm text-gray-500">No recent expense records.</li>
                    <?php else: ?>
                        <?php foreach (array_slice($recentExpenses, 0, 5) as $expense): ?>
                            <li class="px-4 py-4 flex items-center justify-between hover:bg-gray-50">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">
                                        <?php echo htmlspecialchars($expense['category']); ?>
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        <?php echo htmlspecialchars($expense['label']); ?>
                                    </div>
                                </div>
                                <div class="text-sm text-red-600 font-semibold">-$
                                    <?php echo number_format($expense['amount'], 2); ?>
                                </div>
                                <div class="text-sm text-gray-500">
                                    <?php echo htmlspecialchars($expense['date']); ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Expenses Context
    const ctx = document.getElementById('expensesChart').getContext('2d');
    const expensesData = <?php echo json_encode($expensesByCategory); ?>;
    const labels = expensesData.map(item => item.category);
    const data = expensesData.map(item => item.total);
    const backgroundColors = [
        '#3B82F6', '#EF4444', '#10B981', '#F59E0B', '#6366F1', '#EC4899', '#8B5CF6'
    ];

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                label: 'Expenses',
                data: data,
                backgroundColor: backgroundColors,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });

    // Trends Context
    const trendsCtx = document.getElementById('trendsChart').getContext('2d');
    const trendsData = <?php echo json_encode($spendingTrends); ?>;
    const trendLabels = trendsData.map(item => item.month); // Format as needed JS side or PHP
    const trendValues = trendsData.map(item => item.total);

    new Chart(trendsCtx, {
        type: 'line',
        data: {
            labels: trendLabels,
            datasets: [{
                label: 'Monthly Spending',
                data: trendValues,
                borderColor: '#6366F1',
                backgroundColor: 'rgba(99, 102, 241, 0.2)',
                tension: 0.1,
                fill: true
            }]
        },
        options: {
             responsive: true,
             maintainAspectRatio: false,
             scales: {
                y: {
                    beginAtZero: true
                }
             }
        }
    });
</script>

<?php require_once '../app/Views/partials/footer.php'; ?>