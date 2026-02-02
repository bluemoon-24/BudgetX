<?php
require_once 'header.php';
?>

<div class="min-h-screen bg-slate-50/50 pb-20 pt-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Top Header -->
        <header class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 mb-12">
            <div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight">Admin Dashboard</h1>
                <p class="text-slate-500 font-medium">Platform-wide statistics and oversight.</p>
            </div>
            <div class="flex items-center gap-3">
                <span
                    class="text-[10px] font-black text-brand-600 uppercase tracking-widest px-2 py-1 bg-brand-50 rounded-md">Live
                    Oversight</span>
            </div>
        </header>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-12">
            <!-- Total Users -->
            <div class="card-bento p-6 relative overflow-hidden group">
                <div class="flex items-start justify-between mb-4">
                    <div
                        class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 transition-transform group-hover:scale-110">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 005.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <span
                        class="text-xs font-black text-green-600 bg-green-50 px-2 py-1 rounded-lg"><?php echo $stats['total_trend']; ?></span>
                </div>
                <h3 class="text-3xl font-black text-slate-900 mb-1"><?php echo number_format($stats['total']); ?></h3>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Users</p>
            </div>

            <!-- Free Users -->
            <div class="card-bento p-6 relative overflow-hidden group">
                <div class="flex items-start justify-between mb-4">
                    <div
                        class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 transition-transform group-hover:scale-110">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <span
                        class="text-xs font-black text-green-600 bg-green-50 px-2 py-1 rounded-lg"><?php echo $stats['basic_trend']; ?></span>
                </div>
                <h3 class="text-3xl font-black text-slate-900 mb-1"><?php echo number_format($stats['basic']); ?></h3>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Free Users</p>
            </div>

            <!-- Premium Users -->
            <div class="card-bento p-6 relative overflow-hidden group">
                <div class="flex items-start justify-between mb-4">
                    <div
                        class="w-12 h-12 bg-violet-50 rounded-2xl flex items-center justify-center text-violet-600 transition-transform group-hover:scale-110">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                    <span
                        class="text-xs font-black text-green-600 bg-green-50 px-2 py-1 rounded-lg"><?php echo $stats['premium_trend']; ?></span>
                </div>
                <h3 class="text-3xl font-black text-slate-900 mb-1"><?php echo number_format($stats['premium']); ?></h3>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Premium Users</p>
            </div>

            <!-- Revenue -->
            <div class="card-bento p-6 relative overflow-hidden group">
                <div class="flex items-start justify-between mb-4">
                    <div
                        class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 transition-transform group-hover:scale-110">
                        <span class="text-xl font-black italic">Rs</span>
                    </div>
                    <span
                        class="text-xs font-black text-green-600 bg-green-50 px-2 py-1 rounded-lg"><?php echo $stats['revenue_trend']; ?></span>
                </div>
                <h3 class="text-3xl font-black text-slate-900 mb-1"><?php echo number_format($revenue, 2); ?></h3>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Monthly Revenue (Rs.)</p>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-12 gap-8">
            <!-- Recent Activity -->
            <div class="xl:col-span-4 card-bento p-8">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-xl font-black text-slate-900 tracking-tight">Recent Activity</h3>
                    <a href="#"
                        class="text-[10px] font-black text-brand-600 uppercase tracking-widest hover:underline">View
                        All</a>
                </div>
                <div class="space-y-8">
                    <?php if (empty($activity)): ?>
                        <p class="text-slate-400 text-xs font-medium italic">No recent actions recorded.</p>
                    <?php else: ?>
                        <?php foreach ($activity as $act): ?>
                            <div class="flex gap-4 relative">
                                <div
                                    class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center flex-shrink-0 z-10 border border-slate-100">
                                    <?php
                                    $icon_color = 'text-indigo-600';
                                    if (strpos($act['action'], 'Premium') !== false)
                                        $icon_color = 'text-violet-600';
                                    if (strpos($act['action'], 'Payment') !== false)
                                        $icon_color = 'text-amber-600';
                                    if (strpos($act['action'], 'Failed') !== false)
                                        $icon_color = 'text-red-600';
                                    ?>
                                    <svg class="w-5 h-5 <?php echo $icon_color; ?>" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-black text-slate-900 leading-tight">
                                        <?php echo htmlspecialchars($act['action']); ?>
                                    </p>
                                    <p class="text-[10px] font-bold text-slate-400 truncate max-w-[180px]">
                                        <?php echo htmlspecialchars($act['email'] ?? 'system@budgetx.com'); ?>
                                    </p>
                                    <p class="text-[9px] font-bold text-slate-300 mt-1 uppercase">
                                        <?php echo date('M d, H:i', strtotime($act['created_at'])); ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- User Management -->
            <div class="xl:col-span-8 card-bento p-8">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                    <h3 class="text-xl font-black text-slate-900 tracking-tight">User Management</h3>
                    <div class="flex items-center gap-3">
                        <form action="/BudgetX/public/admin" method="GET" class="relative">
                            <input type="text" name="search" placeholder="Search users..."
                                value="<?php echo htmlspecialchars($search ?? ''); ?>"
                                class="bg-slate-50/50 border border-slate-100 rounded-xl px-4 py-2 text-xs font-bold w-full sm:w-48 focus:ring-2 focus:ring-brand-500/20 outline-none">
                            <button type="submit"
                                class="absolute right-3 top-2.5 text-slate-300 hover:text-brand-500 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left">
                                <th class="text-[10px] font-black text-slate-400 uppercase tracking-widest pb-4">Name
                                </th>
                                <th
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest pb-4 text-center">
                                    Role</th>
                                <th
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest pb-4 text-center">
                                    Status</th>
                                <th
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest pb-4 text-right">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            <?php foreach ($users as $u): ?>
                                <tr class="group hover:bg-slate-50/50 transition-colors">
                                    <td class="py-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-[10px] font-black text-slate-400 overflow-hidden">
                                                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($u['username']); ?>&background=random"
                                                    alt="">
                                            </div>
                                            <div>
                                                <p class="text-xs font-black text-slate-900">
                                                    <?php echo htmlspecialchars($u['username']); ?>
                                                </p>
                                                <p class="text-[10px] font-bold text-slate-400">
                                                    <?php echo htmlspecialchars($u['email']); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 text-center">
                                        <?php
                                        $role_class = 'text-slate-400 bg-slate-100';
                                        if ($u['role'] === 'premium')
                                            $role_class = 'text-brand-600 bg-brand-50';
                                        if ($u['role'] === 'admin')
                                            $role_class = 'text-amber-600 bg-amber-50';
                                        ?>
                                        <span
                                            class="text-[9px] font-black uppercase tracking-widest px-2 py-1 rounded-lg <?php echo $role_class; ?>">
                                            <?php echo $u['role']; ?>
                                        </span>
                                    </td>
                                    <td class="py-4 text-center">
                                        <?php
                                        $status_class = 'text-emerald-500 bg-emerald-50';
                                        if ($u['status'] === 'suspended' || $u['status'] === 'banned' || $u['status'] === 'inactive')
                                            $status_class = 'text-red-500 bg-red-50';
                                        ?>
                                        <span
                                            class="text-[9px] font-black uppercase tracking-widest px-2 py-1 rounded-lg <?php echo $status_class; ?>">
                                            <?php echo $u['status'] ?: 'Active'; ?>
                                        </span>
                                    </td>
                                    <td class="py-4 text-right">
                                        <div class="flex items-center justify-end gap-2 text-xs">
                                            <form action="/BudgetX/public/admin/update_status" method="POST"
                                                class="inline-block">
                                                <input type="hidden" name="user_id" value="<?php echo $u['id']; ?>">
                                                <select name="status" onchange="this.form.submit()"
                                                    class="text-[10px] font-bold bg-slate-50 border-none rounded-lg focus:ring-0 cursor-pointer">
                                                    <option value="active" <?php echo $u['status'] === 'active' ? 'selected' : ''; ?>>Active</option>
                                                    <option value="inactive" <?php echo $u['status'] === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                                                    <option value="banned" <?php echo $u['status'] === 'banned' ? 'selected' : ''; ?>>Banned</option>
                                                </select>
                                            </form>
                                            <form action="/BudgetX/public/admin/update_role" method="POST"
                                                class="inline-block">
                                                <input type="hidden" name="user_id" value="<?php echo $u['id']; ?>">
                                                <select name="role" onchange="this.form.submit()"
                                                    class="text-[10px] font-bold bg-slate-50 border-none rounded-lg focus:ring-0 cursor-pointer">
                                                    <option value="basic" <?php echo $u['role'] === 'basic' ? 'selected' : ''; ?>>Basic</option>
                                                    <option value="premium" <?php echo $u['role'] === 'premium' ? 'selected' : ''; ?>>Premium</option>
                                                    <option value="admin" <?php echo $u['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                                                </select>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="mt-8 flex items-center justify-between">
                    <p class="text-[10px] font-bold text-slate-400">Showing 1 to <?php echo count($users); ?> of
                        <?php echo $stats['total']; ?> users
                    </p>
                    <div class="flex gap-2">
                        <button
                            class="w-8 h-8 rounded-lg border border-slate-100 flex items-center justify-center text-slate-400 hover:bg-slate-50">1</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>