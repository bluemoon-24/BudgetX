<?php require_once '../app/Views/partials/header.php'; ?>

<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="max-w-md mx-auto bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Invite Collaborator</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Enter the email of the person you want to invite.</p>
            </div>
            <div class="border-t border-gray-200">
                <form action="/BudgetX/public/shared_goals/store_member" method="POST"
                    class="px-4 py-5 sm:p-6 space-y-6">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                        <input type="email" name="email" id="email" required
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Send Invitation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/Views/partials/footer.php'; ?>