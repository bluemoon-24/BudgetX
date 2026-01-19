<?php require_once '../app/Views/partials/header.php'; ?>

<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-900">
                <?php echo htmlspecialchars($goal['name']); ?>
            </h1>
            <div>
                <a href="/BudgetX/public/shared_goals/add_funds?id=<?php echo $goal['id']; ?>"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium mr-2">
                    Add Funds
                </a>
                <a href="/BudgetX/public/shared_goals/add_member?id=<?php echo $goal['id']; ?>"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                    Invite Collaborator
                </a>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-6 mb-8">
            <h2 class="text-lg leading-6 font-medium text-gray-900 mb-4">Progress</h2>
            <?php
            $percentage = 0;
            if ($goal['target_amount'] > 0) {
                $percentage = ($goal['current_amount'] / $goal['target_amount']) * 100;
                $percentage = min(100, $percentage);
            }
            ?>
            <div class="flex justify-between text-sm font-medium text-gray-900 mb-1">
                <span>$
                    <?php echo number_format($goal['current_amount'], 2); ?>
                </span>
                <span>$
                    <?php echo number_format($goal['target_amount'], 2); ?>
                </span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-4">
                <div class="bg-green-600 h-4 rounded-full transition-all duration-500"
                    style="width: <?php echo $percentage; ?>%"></div>
            </div>
            <p class="mt-2 text-right text-sm text-gray-500">
                <?php echo number_format($percentage, 0); ?>% Funded
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Contributors -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Contributors</h3>
                <ul class="divide-y divide-gray-200">
                    <?php if (empty($contributors)): ?>
                        <li class="py-4 text-sm text-gray-500">No contributions yet.</li>
                    <?php else: ?>
                        <?php foreach ($contributors as $contributor): ?>
                            <li class="py-4 flex justify-between items-center">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">
                                        <?php echo htmlspecialchars($contributor['full_name'] ?: $contributor['username']); ?>
                                    </p>
                                </div>
                                <div class="text-sm font-semibold text-green-600">
                                    $
                                    <?php echo number_format($contributor['total_contribution'], 2); ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Chart -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Contribution History</h3>
                <div class="relative h-64 w-full">
                    <canvas id="contributionChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('contributionChart').getContext('2d');
    const historyData = <?php echo json_encode($history); ?>;

    // Group by date for easier visualization if needed, or just list occurrences
    // For simplicity, lets just show chronological contributions
    const labels = historyData.map(item => item.date);
    const data = historyData.map(item => item.amount);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Contribution Amount',
                data: data,
                backgroundColor: '#10B981',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>

<?php require_once '../app/Views/partials/footer.php'; ?>