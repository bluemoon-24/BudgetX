<?php require_once 'header.php'; ?>

<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Financial Goals</h1>
            <a href="/BudgetX/public/goals/create"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                Add New Goal
            </a>
        </div>

        <!-- Pending Shared Goal Invitations -->
        <?php if (!empty($invitations)): ?>
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Shared Goal Invitations</h2>
                <div class="space-y-4">
                    <?php foreach ($invitations as $invitation): ?>
                        <div class="bg-white overflow-hidden shadow rounded-lg border-2 border-brand-200">
                            <div class="px-6 py-5">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <p class="text-base font-medium text-gray-900">
                                            You've been invited to
                                            <strong
                                                class="text-brand-600"><?php echo htmlspecialchars($invitation['goal_name']); ?></strong>
                                            by <strong><?php echo htmlspecialchars($invitation['inviter_name']); ?></strong>
                                        </p>
                                        <p class="mt-1 text-sm text-gray-500">
                                            Invited on <?php echo date('M d, Y', strtotime($invitation['created_at'])); ?>
                                        </p>
                                    </div>
                                    <div class="flex gap-3 ml-6">
                                        <form action="/BudgetX/public/goals/accept_invitation" method="POST" class="inline">
                                            <input type="hidden" name="invitation_id" value="<?php echo $invitation['id']; ?>">
                                            <button type="submit"
                                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                                                Accept
                                            </button>
                                        </form>
                                        <form action="/BudgetX/public/goals/decline_invitation" method="POST" class="inline">
                                            <input type="hidden" name="invitation_id" value="<?php echo $invitation['id']; ?>">
                                            <button type="submit"
                                                class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                                                Decline
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Collaborative Goals -->
        <?php if (!empty($sharedGoals)): ?>
            <div class="mb-12">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-8 h-8 rounded-lg bg-brand-600 flex items-center justify-center text-white shadow-lg">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 005.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-black text-slate-900 tracking-tight">Collaborative Goals</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach ($sharedGoals as $sg): ?>
                        <?php $sg_percentage = ($sg['target_amount'] > 0) ? min(100, ($sg['current_amount'] / $sg['target_amount']) * 100) : 0; ?>
                        <div
                            class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 hover:shadow-xl transition-all group overflow-hidden relative">
                            <div
                                class="absolute -right-6 -top-6 w-24 h-24 bg-brand-50 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity">
                            </div>

                            <div class="flex justify-between items-start mb-6 relative z-10">
                                <div>
                                    <h3 class="text-lg font-black text-slate-900 group-hover:text-brand-600 transition-colors">
                                        <?php echo htmlspecialchars($sg['name']); ?>
                                    </h3>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Shared with
                                        Peers</p>
                                </div>
                                <div class="px-2 py-1 bg-brand-50 rounded-lg">
                                    <span
                                        class="text-[10px] font-black text-brand-600 uppercase tracking-widest"><?php echo number_format($sg_percentage, 0); ?>%</span>
                                </div>
                            </div>

                            <div class="space-y-3 mb-8 relative z-10">
                                <div class="h-2 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-brand-600 rounded-full transition-all duration-1000"
                                        style="width: <?php echo $sg_percentage; ?>%"></div>
                                </div>
                                <div class="flex justify-between items-baseline">
                                    <span
                                        class="text-sm font-black text-slate-900"><?php echo $currency_symbol . number_format($sg['current_amount'], 2); ?></span>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Target
                                        <?php echo $currency_symbol . number_format($sg['target_amount'], 2); ?></span>
                                </div>
                            </div>

                            <div class="flex gap-2 relative z-10 mt-6">
                                <a href="/BudgetX/public/shared_goals/view?id=<?php echo $sg['id']; ?>"
                                    class="flex-1 text-center py-2.5 bg-slate-900 text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-brand-600 transition-colors shadow-sm active:scale-95 duration-200">
                                    View
                                </a>
                                <?php if ($sg['owner_id'] == $_SESSION['user_id']): ?>
                                    <a href="/BudgetX/public/shared_goals/edit?id=<?php echo $sg['id']; ?>"
                                        class="px-3 flex items-center justify-center bg-slate-100 text-slate-600 rounded-xl hover:bg-slate-200 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form action="/BudgetX/public/shared_goals/delete" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this shared goal? This will remove it for all participants.');"
                                        class="inline">
                                        <input type="hidden" name="id" value="<?php echo $sg['id']; ?>">
                                        <button type="submit"
                                            class="p-2.5 bg-red-50 text-red-500 rounded-xl hover:bg-red-100 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <form action="/BudgetX/public/shared_goals/leave" method="POST"
                                        onsubmit="return confirm('Are you sure you want to leave this shared goal?');"
                                        class="inline">
                                        <input type="hidden" name="id" value="<?php echo $sg['id']; ?>">
                                        <button type="submit"
                                            class="p-2.5 bg-slate-50 text-slate-500 rounded-xl hover:bg-slate-100 transition-colors"
                                            title="Leave Goal">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if (empty($goals) && empty($sharedGoals)): ?>
            <div class="bg-white overflow-hidden shadow rounded-lg p-6 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No goals defined</h3>
                <p class="mt-1 text-sm text-gray-500">Get started by creating a new financial goal.</p>
                <div class="mt-6">
                    <a href="/BudgetX/public/goals/create"
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        Create Goal
                    </a>
                </div>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <?php foreach ($goals as $goal): ?>
                    <?php
                    $percentage = ($goal['current_amount'] / $goal['target_amount']) * 100;
                    $percentage = min(100, $percentage);

                    $badge = '';
                    $badgeColor = 'bg-gray-100 text-gray-800';
                    if ($percentage >= 100) {
                        $badge = 'Champion 🏆';
                        $badgeColor = 'bg-yellow-100 text-yellow-800 border-yellow-200';
                    } elseif ($percentage >= 75) {
                        $badge = 'Gold 🥇';
                        $badgeColor = 'bg-yellow-50 text-yellow-600 border-yellow-100';
                    } elseif ($percentage >= 50) {
                        $badge = 'Silver 🥈';
                        $badgeColor = 'bg-gray-100 text-gray-600 border-gray-200';
                    } elseif ($percentage >= 25) {
                        $badge = 'Bronze 🥉';
                        $badgeColor = 'bg-orange-50 text-orange-600 border-orange-100';
                    }
                    ?>
                    <div class="bg-white overflow-hidden shadow rounded-lg border border-gray-100">
                        <div class="px-4 py-5 sm:p-6">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-lg font-medium text-gray-900 truncate"
                                    title="<?php echo htmlspecialchars($goal['name']); ?>">
                                    <?php echo htmlspecialchars($goal['name']); ?>
                                </h3>
                                <?php if (isset($goal['status']) && $goal['status'] === 'completed'): ?>
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                                <?php else: ?>
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <?php echo $goal['deadline'] ? date('M j', strtotime($goal['deadline'])) : 'No Deadline'; ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <?php if ($badge): ?>
                                <div class="mb-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border <?php echo $badgeColor; ?>">
                                        <?php echo $badge; ?>
                                    </span>
                                </div>
                            <?php endif; ?>

                            <div class="mt-4">
                                <div class="flex justify-between text-sm font-medium text-gray-900 mb-1">
                                    <span><?php echo $currency_symbol . number_format($goal['current_amount'], 2); ?></span>
                                    <span><?php echo $currency_symbol . number_format($goal['target_amount'], 2); ?></span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-blue-600 h-2.5 rounded-full transition-all duration-500"
                                        style="width: <?php echo $percentage; ?>%"></div>
                                </div>
                                <p class="mt-2 text-xs text-gray-500 text-right">
                                    <?php echo number_format($percentage, 0); ?>% achieved
                                </p>
                            </div>
                            <div class="mt-4 flex gap-2">
                                <a href="/BudgetX/public/goals/add_funds?id=<?php echo $goal['id']; ?>"
                                    class="flex-1 inline-flex justify-center items-center px-4 py-2 border border-blue-600 text-blue-600 shadow-sm text-sm font-medium rounded-md bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Add Funds
                                </a>
                                <a href="/BudgetX/public/goals/edit?id=<?php echo $goal['id']; ?>"
                                    class="px-3 flex items-center justify-center border border-gray-300 text-gray-400 rounded-md hover:bg-gray-50 transition-colors"
                                    title="Edit Goal">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <form action="/BudgetX/public/goals/delete" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this goal?');" class="inline">
                                    <input type="hidden" name="id" value="<?php echo $goal['id']; ?>">
                                    <button type="submit"
                                        class="px-3 py-2 border border-red-200 text-red-500 rounded-md hover:bg-red-50 transition-colors"
                                        title="Delete Goal">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once 'footer.php'; ?>