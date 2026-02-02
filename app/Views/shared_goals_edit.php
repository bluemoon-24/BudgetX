<?php require_once 'header.php'; ?>

<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="max-w-md mx-auto bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Shared Goal</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Update collective savings parameters.</p>
                </div>
                <form action="/BudgetX/public/shared_goals/delete" method="POST" onsubmit="return confirm('WARNING: Deleting this shared goal will remove all members, invitations, and contribution history. This cannot be undone. Proceed?');">
                    <input type="hidden" name="id" value="<?php echo $goal['id']; ?>">
                    <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium">Delete Goal</button>
                </form>
            </div>
            <div class="border-t border-gray-200">
                <form action="/BudgetX/public/shared_goals/update" method="POST" class="px-4 py-5 sm:p-6 space-y-6">
                    <input type="hidden" name="id" value="<?php echo $goal['id']; ?>">
                    
                    <?php if(isset($error)): ?>
                        <div class="text-red-600 text-sm"><?php echo $error; ?></div>
                    <?php endif; ?>
                    
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Goal Name</label>
                        <div class="mt-1">
                            <input type="text" name="name" id="name" required value="<?php echo htmlspecialchars($goal['name']); ?>" 
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div>
                        <label for="target_amount" class="block text-sm font-medium text-gray-700">Target Amount</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm"><?php echo $currency_symbol; ?></span>
                            </div>
                            <input type="number" name="target_amount" id="target_amount" step="0.01" required value="<?php echo $goal['target_amount']; ?>"
                                class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div>
                        <label for="deadline" class="block text-sm font-medium text-gray-700">Deadline</label>
                        <div class="mt-1">
                            <input type="date" name="deadline" id="deadline" value="<?php echo $goal['deadline']; ?>"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div class="pt-4 flex gap-3">
                        <a href="/BudgetX/public/shared_goals/view?id=<?php echo $goal['id']; ?>" class="flex-1 inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit" class="flex-1 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>
