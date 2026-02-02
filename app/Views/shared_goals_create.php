<?php require_once 'header.php'; ?>

<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="max-w-md mx-auto bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Create Shared Goal</h3>
            </div>
            <div class="border-t border-gray-200">
                <form action="/BudgetX/public/shared_goals/store" method="POST" class="px-4 py-5 sm:p-6 space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Goal Name</label>
                        <input type="text" name="name" id="name" required
                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label for="target_amount" class="block text-sm font-medium text-gray-700">Target Amount</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm"><?php echo $currency_symbol; ?></span>
                            </div>
                            <input type="number" name="target_amount" id="target_amount" required
                                class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md"
                                placeholder="0.00">
                        </div>
                    </div>
                    <div>
                        <label for="deadline" class="block text-sm font-medium text-gray-700">Deadline</label>
                        <input type="date" name="deadline" id="deadline"
                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <button type="submit"
                        class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                        Create
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>