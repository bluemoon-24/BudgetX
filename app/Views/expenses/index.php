<?php require_once '../app/Views/partials/header.php'; ?>

<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Expenses</h1>

            <a href="/BudgetX/public/expenses/create"
                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                Add New Expense
            </a>
        </div>

        <!-- Filters -->
        <div class="bg-white shadow rounded-lg p-4 mb-6">
            <form action="/BudgetX/public/expenses" method="GET"
                class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                    <select name="category" id="category"
                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md">
                        <option value="">All Categories</option>
                        <option value="Food" <?php echo ($categoryFilter == 'Food') ? 'selected' : ''; ?>>Food</option>
                        <option value="Transport" <?php echo ($categoryFilter == 'Transport') ? 'selected' : ''; ?>>
                            Transport</option>
                        <option value="Utilities" <?php echo ($categoryFilter == 'Utilities') ? 'selected' : ''; ?>>
                            Utilities</option>
                        <option value="Entertainment" <?php echo ($categoryFilter == 'Entertainment') ? 'selected' : ''; ?>>Entertainment</option>
                        <option value="Health" <?php echo ($categoryFilter == 'Health') ? 'selected' : ''; ?>>Health
                        </option>
                        <option value="Shopping" <?php echo ($categoryFilter == 'Shopping') ? 'selected' : ''; ?>>Shopping
                        </option>
                        <option value="Other" <?php echo ($categoryFilter == 'Other') ? 'selected' : ''; ?>>Other</option>
                    </select>
                </div>
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                    <input type="date" name="date" id="date" value="<?php echo htmlspecialchars($dateFilter); ?>"
                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md">
                </div>
                <div>
                    <button type="submit"
                        class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Filter
                    </button>
                </div>
                <div>
                    <a href="/BudgetX/public/expenses"
                        class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <ul class="divide-y divide-gray-200">
                <?php if (empty($expenses)): ?>
                    <li class="px-4 py-4 text-sm text-gray-500 text-center">No expense records found.</li>
                <?php else: ?>
                    <?php foreach ($expenses as $expense): ?>
                        <li class="px-4 py-4 flex items-center justify-between hover:bg-gray-50">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">
                                    <?php echo htmlspecialchars($expense['category']); ?>
                                    <span class="text-gray-500 font-normal">-
                                        <?php echo htmlspecialchars($expense['label']); ?></span>
                                </p>
                                <p class="text-sm text-gray-500">
                                    <?php echo htmlspecialchars($expense['date']); ?>
                                </p>
                                <?php if (!empty($expense['description'])): ?>
                                    <p class="text-xs text-gray-400 mt-1"><?php echo htmlspecialchars($expense['description']); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="text-sm text-red-600 font-semibold">-$
                                    <?php echo number_format($expense['amount'], 2); ?>
                                </div>
                                <a href="/BudgetX/public/expenses/edit?id=<?php echo $expense['id']; ?>"
                                    class="text-indigo-600 hover:text-indigo-900 text-sm">Edit</a>
                                <form action="/BudgetX/public/expenses/delete" method="POST"
                                    onsubmit="return confirm('Are you sure?');">
                                    <input type="hidden" name="id" value="<?php echo $expense['id']; ?>">
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