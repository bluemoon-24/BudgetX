<?php require_once '../app/Views/partials/header.php'; ?>

<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="max-w-md mx-auto bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Add Funds to Shared Goal</h3>
            </div>
            <div class="border-t border-gray-200">
                <form action="/BudgetX/public/shared_goals/store_funds" method="POST"
                    class="px-4 py-5 sm:p-6 space-y-6">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($goal['id']); ?>">

                    <div class="text-sm text-gray-500 mb-4">
                        Current: $
                        <?php echo number_format($goal['current_amount'], 2); ?> / $
                        <?php echo number_format($goal['target_amount'], 2); ?>
                    </div>

                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700">Amount to Add</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>
                            <input type="number" name="amount" id="amount" step="0.01" required
                                class="focus:ring-green-500 focus:border-green-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md"
                                placeholder="0.00">
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Confirm Payment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/Views/partials/footer.php'; ?>