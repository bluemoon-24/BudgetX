<?php require_once '../app/Views/partials/header.php'; ?>

<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Financial Goals</h1>
            <a href="/BudgetX/public/goals/create"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                Add New Goal
            </a>
        </div>

        <?php if (empty($goals)): ?>
            <div class="bg-white overflow-hidden shadow rounded-lg p-6 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No goals defined</h3>
                <p class="mt-1 text-sm text-gray-500">Get started by creating a new financial goal.</p>
                <div class="mt-6">
                    <a href="/BudgetX/public/goals/create"
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        Create Goal
                    </a>
                </div>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <?php foreach ($goals as $goal): ?>
                    <?php
                    $percentage = ($goal['current_amount'] / $goal['target_amount']) * 100;
                    $percentage = min(100, $percentage);

                    $badge = '';
                    $badgeColor = 'bg-gray-100 text-gray-800';
                    if ($percentage >= 100) {
                        $badge = 'Champion 🏆';
                        $badgeColor = 'bg-yellow-100 text-yellow-800 border-yellow-200';
                    } elseif ($percentage >= 75) {
                        $badge = 'Gold 🥇';
                        $badgeColor = 'bg-yellow-50 text-yellow-600 border-yellow-100';
                    } elseif ($percentage >= 50) {
                        $badge = 'Silver 🥈';
                        $badgeColor = 'bg-gray-100 text-gray-600 border-gray-200';
                    } elseif ($percentage >= 25) {
                        $badge = 'Bronze 🥉';
                        $badgeColor = 'bg-orange-50 text-orange-600 border-orange-100';
                    }
                    ?>
                    <div class="bg-white overflow-hidden shadow rounded-lg border border-gray-100">
                        <div class="px-4 py-5 sm:p-6">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-lg font-medium text-gray-900 truncate"
                                    title="<?php echo htmlspecialchars($goal['name']); ?>">
                                    <?php echo htmlspecialchars($goal['name']); ?>
                                </h3>
                                <?php if (isset($goal['status']) && $goal['status'] === 'completed'): ?>
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                                <?php else: ?>
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <?php echo $goal['deadline'] ? date('M j', strtotime($goal['deadline'])) : 'No Deadline'; ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <?php if ($badge): ?>
                                <div class="mb-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border <?php echo $badgeColor; ?>">
                                        <?php echo $badge; ?>
                                    </span>
                                </div>
                            <?php endif; ?>

                            <div class="mt-4">
                                <div class="flex justify-between text-sm font-medium text-gray-900 mb-1">
                                    <span>$<?php echo number_format($goal['current_amount'], 2); ?></span>
                                    <span>$<?php echo number_format($goal['target_amount'], 2); ?></span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-blue-600 h-2.5 rounded-full transition-all duration-500"
                                        style="width: <?php echo $percentage; ?>%"></div>
                                </div>
                                <p class="mt-2 text-xs text-gray-500 text-right">
                                    <?php echo number_format($percentage, 0); ?>% achieved
                                </p>
                            </div>
                            <div class="mt-4">
                                <a href="/BudgetX/public/goals/add_funds?id=<?php echo $goal['id']; ?>"
                                    class="w-full inline-flex justify-center items-center px-4 py-2 border border-blue-600 text-blue-600 shadow-sm text-sm font-medium rounded-md bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Add Funds
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once '../app/Views/partials/footer.php'; ?>