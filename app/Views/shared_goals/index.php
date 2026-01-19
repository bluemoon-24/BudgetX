<?php require_once '../app/Views/partials/header.php'; ?>

<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Shared Goals (Premium)</h1>
            <a href="/BudgetX/public/shared_goals/create"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                Create Shared Goal
            </a>
        </div>

        <?php if (empty($goals)): ?>
            <div class="bg-white overflow-hidden shadow rounded-lg p-6 text-center">
                <p class="text-gray-500">No shared goals found. Collaborate with friends!</p>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <?php foreach ($goals as $goal): ?>
                    <div
                        class="bg-white overflow-hidden shadow rounded-lg px-4 py-5 sm:p-6 hover:shadow-lg transition-shadow duration-200">
                        <a href="/BudgetX/public/shared_goals/view?id=<?php echo $goal['id']; ?>" class="block">
                            <h3 class="text-lg font-medium text-indigo-600 hover:text-indigo-900">
                                <?php echo htmlspecialchars($goal['name']); ?>
                            </h3>
                            <p class="text-xs text-gray-500 mt-1">Owner:
                                <?php echo htmlspecialchars($goal['owner_name']); ?>
                            </p>
                        </a>
                        <div class="mt-4 flex justify-between text-sm">
                            <span
                                class="font-semibold text-gray-900">$<?php echo number_format($goal['current_amount'], 2); ?></span>
                            <span class="text-gray-500">of $<?php echo number_format($goal['target_amount'], 2); ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once '../app/Views/partials/footer.php'; ?>