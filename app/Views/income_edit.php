<?php require_once 'header.php'; ?>

<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="max-w-md mx-auto bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Income</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Update your income details.</p>
                </div>
                <form action="/BudgetX/public/income/delete" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this income record?');">
                    <input type="hidden" name="id" value="<?php echo $income['id']; ?>">
                    <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium">Delete</button>
                </form>
            </div>

            <?php if (isset($_GET['error'])): ?>
                <div class="bg-red-50 border-l-4 border-red-400 p-4 m-4">
                    <p class="text-sm text-red-700">Invalid input. Check amount and date.</p>
                </div>
            <?php endif; ?>

            <div class="border-t border-gray-200">
                <form action="/BudgetX/public/income/update" method="POST" class="px-4 py-5 sm:p-6 space-y-6">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($income['id']); ?>">

                    <div>
                        <label for="source" class="block text-sm font-medium text-gray-700">Source</label>
                        <input type="text" name="source" id="source"
                            value="<?php echo htmlspecialchars($income['source']); ?>" required
                            class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm"><?php echo $currency_symbol; ?></span>
                            </div>
                            <input type="number" name="amount" id="amount" step="0.01"
                                value="<?php echo htmlspecialchars($income['amount']); ?>" required
                                class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                        <input type="date" name="date" id="date"
                            value="<?php echo htmlspecialchars($income['date']); ?>" max="<?php echo date('Y-m-d'); ?>"
                            required
                            class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <div class="pt-4 flex justify-between">
                        <a href="/BudgetX/public/income"
                            class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Update Income
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>