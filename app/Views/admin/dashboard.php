<?php require_once '../app/Views/partials/header.php'; ?>

<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Admin Dashboard</h1>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-4 mb-8">
            <div class="bg-white overflow-hidden shadow rounded-lg px-4 py-5 sm:p-6">
                <dt class="text-sm font-medium text-gray-500 truncate">Total Users</dt>
                <dd class="mt-1 text-3xl font-semibold text-gray-900"><?php echo $stats['total']; ?></dd>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg px-4 py-5 sm:p-6">
                <dt class="text-sm font-medium text-gray-500 truncate">Free Users</dt>
                <dd class="mt-1 text-3xl font-semibold text-gray-900"><?php echo $stats['basic']; ?></dd>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg px-4 py-5 sm:p-6">
                <dt class="text-sm font-medium text-gray-500 truncate">Premium Users</dt>
                <dd class="mt-1 text-3xl font-semibold text-indigo-600"><?php echo $stats['premium']; ?></dd>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg px-4 py-5 sm:p-6">
                <dt class="text-sm font-medium text-gray-500 truncate">Total Revenue</dt>
                <dd class="mt-1 text-3xl font-semibold text-green-600">$<?php echo number_format($revenue, 2); ?></dd>
            </div>
        </div>

        <!-- User Management -->
        <div class="bg-white shadow rounded-lg mb-8 overflow-hidden">
            <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">User Management</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                User</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Role</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                <?php echo htmlspecialchars($user['username']); ?></div>
                                            <div class="text-sm text-gray-500">
                                                <?php echo htmlspecialchars($user['email']); ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo $user['role'] === 'premium' ? 'bg-indigo-100 text-indigo-800' : 'bg-gray-100 text-gray-800'; ?>">
                                        <?php echo ucfirst($user['role']); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo $user['status'] === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                        <?php echo ucfirst($user['status']); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <form action="/BudgetX/public/admin/update_status" method="POST"
                                        class="inline-block mr-2">
                                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                        <select name="status" onchange="this.form.submit()"
                                            class="text-xs border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                            <option value="active" <?php echo $user['status'] === 'active' ? 'selected' : ''; ?>>Active</option>
                                            <option value="inactive" <?php echo $user['status'] === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                                            <option value="banned" <?php echo $user['status'] === 'banned' ? 'selected' : ''; ?>>Banned</option>
                                        </select>
                                    </form>
                                    <form action="/BudgetX/public/admin/update_role" method="POST" class="inline-block">
                                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                        <select name="role" onchange="this.form.submit()"
                                            class="text-xs border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                            <option value="basic" <?php echo $user['role'] === 'basic' ? 'selected' : ''; ?>>
                                                Basic</option>
                                            <option value="premium" <?php echo $user['role'] === 'premium' ? 'selected' : ''; ?>>Premium</option>
                                            <option value="admin" <?php echo $user['role'] === 'admin' ? 'selected' : ''; ?>>
                                                Admin</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Activity Logs -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Activity Logs</h3>
            </div>
            <div class="overflow-x-auto max-h-96">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                User</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Action</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Details</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Time</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($logs as $log): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <?php echo htmlspecialchars($log['username'] ?? 'Unknown'); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo htmlspecialchars($log['action']); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo htmlspecialchars($log['details']); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo $log['created_at']; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/Views/partials/footer.php'; ?>