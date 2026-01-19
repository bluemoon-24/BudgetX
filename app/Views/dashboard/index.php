<?php require_once '../app/Views/partials/header.php'; ?>

<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Dashboard</h1>

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

        <!-- Charts Section -->
        <div class="bg-white shadow rounded-lg p-6 mb-8">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Expenses by Category</h3>
            <div class="relative h-64 w-full">
                <canvas id="expensesChart"></canvas>
            </div>
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
    const ctx = document.getElementById('expensesChart').getContext('2d');
    const expensesData = <?php echo json_encode($expensesByCategory); ?>;

    // Process data for Chart.js
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
</script>

<?php require_once '../app/Views/partials/footer.php'; ?>