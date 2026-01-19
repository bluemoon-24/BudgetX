<?php require_once '../app/Views/partials/header.php'; ?>

<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Income Records</h1>
            <a href="/BudgetX/public/income/create"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                Add New Income
            </a>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <ul class="divide-y divide-gray-200">
                <?php if (empty($incomes)): ?>
                    <li class="px-4 py-4 text-sm text-gray-500 text-center">No income records found.</li>
                <?php else: ?>
                    <?php foreach ($incomes as $income): ?>
                        <li class="px-4 py-4 flex items-center justify-between hover:bg-gray-50">
                            <div>
                                <div class="text-sm font-medium text-gray-900">
                                    <?php echo htmlspecialchars($income['source']); ?>
                                </div>
                                <div class="text-sm text-gray-500">
                                    <?php echo htmlspecialchars($income['date']); ?>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="text-sm text-green-600 font-semibold">+$
                                    <?php echo number_format($income['amount'], 2); ?>
                                </div>
                                <a href="/BudgetX/public/income/edit?id=<?php echo $income['id']; ?>"
                                    class="text-indigo-600 hover:text-indigo-900 text-sm">Edit</a>
                                <form action="/BudgetX/public/income/delete" method="POST"
                                    onsubmit="return confirm('Are you sure?');">
                                    <input type="hidden" name="id" value="<?php echo $income['id']; ?>">
                                    <button type="submit" class="text-red-600 hover:text-red-900 text-sm">Delete</button>
                                </form>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>

<?php require_once '../app/Views/partials/footer.php'; ?>