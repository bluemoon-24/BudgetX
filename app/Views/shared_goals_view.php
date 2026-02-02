<?php require_once 'header.php'; ?>

<div class="min-h-screen bg-slate-50/50 pb-20 pt-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Goal Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
            <div class="flex items-center gap-6">
                <a href="/BudgetX/public/shared_goals"
                    class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-slate-400 hover:text-brand-600 shadow-sm border border-slate-100 transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-4xl font-black text-slate-900 tracking-tight">
                        <?php echo htmlspecialchars($goal['name']); ?>
                    </h1>
                    <p class="text-slate-500 font-medium mt-1 uppercase tracking-widest text-[10px] font-black">Shared
                        Savings Hub</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'premium'): ?>
                    <a href="/BudgetX/public/shared_goals/add_member?id=<?php echo $goal['id']; ?>"
                        class="btn-secondary py-3 px-6 text-sm font-bold flex items-center shadow-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Invite
                    </a>
                <?php endif; ?>
                <a href="/BudgetX/public/shared_goals/add_funds?id=<?php echo $goal['id']; ?>"
                    class="btn-primary py-3 px-8 text-sm font-bold flex items-center shadow-lg shadow-brand-500/20">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Funds
                </a>
                <?php if ($goal['owner_id'] == $_SESSION['user_id']): ?>
                    <a href="/BudgetX/public/shared_goals/edit?id=<?php echo $goal['id']; ?>"
                        class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-slate-400 hover:text-brand-600 shadow-sm border border-slate-100 transition-all"
                        title="Edit Shared Goal">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </a>
                    <form action="/BudgetX/public/shared_goals/delete" method="POST"
                        onsubmit="return confirm('WARNING: Deleting this shared goal will remove all members, invitations, and contribution history. This cannot be undone. Proceed?');"
                        class="inline">
                        <input type="hidden" name="id" value="<?php echo $goal['id']; ?>">
                        <button type="submit"
                            class="w-12 h-12 bg-red-50 rounded-2xl flex items-center justify-center text-red-400 hover:text-red-600 shadow-sm border border-red-100 transition-all"
                            title="Delete Shared Goal">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </form>
                <?php else: ?>
                    <form action="/BudgetX/public/shared_goals/leave" method="POST"
                        onsubmit="return confirm('Are you sure you want to leave this shared goal?');" class="inline">
                        <input type="hidden" name="id" value="<?php echo $goal['id']; ?>">
                        <button type="submit"
                            class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 hover:text-slate-600 shadow-sm border border-slate-100 transition-all"
                            title="Leave Shared Goal">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Progress Module -->
            <div class="lg:col-span-12 card-bento relative overflow-hidden group">
                <div
                    class="absolute -right-20 -top-20 w-64 h-64 bg-brand-50 rounded-full blur-3xl opacity-50 group-hover:opacity-80 transition-opacity">
                </div>
                <h3 class="text-sm font-black text-slate-400 uppercase tracking-widest mb-10">Funding Velocity</h3>

                <?php
                $percentage = 0;
                if ($goal['target_amount'] > 0) {
                    $percentage = ($goal['current_amount'] / $goal['target_amount']) * 100;
                    $percentage = min(100, $percentage);
                }
                ?>

                <div class="relative z-10">
                    <div class="flex justify-between items-end mb-4">
                        <div>
                            <span
                                class="text-5xl font-black text-slate-900"><?php echo $currency_symbol . number_format($goal['current_amount'], 2); ?></span>
                            <span class="text-lg font-bold text-slate-400 ml-2">collected</span>
                        </div>
                        <div class="text-right">
                            <span
                                class="text-2xl font-black text-brand-600"><?php echo number_format($percentage, 1); ?>%</span>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">of
                                <?php echo $currency_symbol . number_format($goal['target_amount'], 2); ?> target
                            </p>
                        </div>
                    </div>

                    <div class="h-4 bg-slate-100 rounded-full overflow-hidden shadow-inner">
                        <div class="h-full bg-gradient-to-r from-brand-600 via-brand-500 to-brand-400 rounded-full transition-all duration-1000 relative"
                            style="width: <?php echo $percentage; ?>%">
                            <div class="absolute inset-0 bg-white/20 animate-pulse"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Members List -->
            <div class="lg:col-span-4 card-bento">
                <h3 class="text-lg font-black text-slate-900 mb-8 tracking-tight">Active Members</h3>
                <div class="space-y-4">
                    <?php if (empty($members)): ?>
                        <div class="p-8 text-center bg-slate-50 rounded-3xl border-2 border-dashed border-slate-200">
                            <p class="text-slate-400 text-sm font-medium">No members found.</p>
                        </div>
                    <?php else: ?>
                        <?php
                        // Map contributions to user IDs for easy lookup
                        $contributionMap = [];
                        foreach ($contributors as $c) {
                            $contributionMap[$c['id']] = $c['total_contribution'];
                        }
                        ?>
                        <?php foreach ($members as $member): ?>
                            <?php $contribution = $contributionMap[$member['id']] ?? 0; ?>
                            <div
                                class="flex items-center justify-between p-4 bg-slate-50/50 hover:bg-white hover:shadow-sm rounded-2xl transition-all border border-transparent hover:border-slate-100">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-[10px] font-black text-slate-400 border border-slate-200 shadow-sm">
                                        <?php echo substr($member['username'], 0, 1); ?>
                                    </div>
                                    <div>
                                        <p class="text-xs font-black text-slate-900 leading-tight">
                                            <?php echo htmlspecialchars($member['full_name']); ?>
                                        </p>
                                        <div class="flex items-center gap-1.5 mt-0.5">
                                            <span
                                                class="text-[9px] font-black text-brand-600 uppercase tracking-widest px-1.5 py-0.5 bg-brand-50 rounded-md"><?php echo ucfirst($member['role']); ?></span>
                                            <?php if ($member['id'] == $goal['owner_id']): ?>
                                                <span
                                                    class="text-[9px] font-black text-amber-600 uppercase tracking-widest px-1.5 py-0.5 bg-amber-50 rounded-md">Proprietor</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs font-black text-slate-900">
                                        <?php echo $currency_symbol . number_format($contribution, 2); ?>
                                    </p>
                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Added</p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- Pending Invitations -->
                <?php if (!empty($pending_invitations)): ?>
                    <div class="mt-8 pt-8 border-t border-slate-100">
                        <h4 class="text-sm font-black text-slate-400 uppercase tracking-widest mb-4">Pending Invitations
                        </h4>
                        <div class="space-y-3">
                            <?php foreach ($pending_invitations as $inv): ?>
                                <div
                                    class="flex items-center justify-between p-3 bg-amber-50/50 rounded-xl border border-amber-100">
                                    <span
                                        class="text-sm font-medium text-slate-700"><?php echo htmlspecialchars($inv['invitee_email']); ?></span>
                                    <span class="text-xs font-bold text-amber-600 uppercase tracking-wider">Pending</span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Chart Module -->
            <div class="lg:col-span-8 card-bento">
                <h3 class="text-lg font-black text-slate-900 mb-8 tracking-tight">Contribution History</h3>
                <div class="h-80 w-full">
                    <canvas id="contributionChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    Chart.defaults.font.family = 'Outfit';
    Chart.defaults.color = '#64748b';

    const ctx = document.getElementById('contributionChart').getContext('2d');
    const historyData = <?php echo json_encode($history); ?>;
    const labels = historyData.map(item => {
        const d = new Date(item.date);
        return d.toLocaleDateString('default', { month: 'short', day: 'numeric' });
    });
    const data = historyData.map(item => item.amount);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Contribution',
                data: data,
                backgroundColor: '#0ea5e9',
                borderRadius: 8,
                maxBarThickness: 40
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#0f172a',
                    padding: 16,
                    cornerRadius: 16,
                    displayColors: false
                }
            },
            scales: {
                y: { grid: { borderDash: [5, 5], color: '#e2e8f0' }, ticks: { callback: v => '<?php echo $currency_symbol; ?>' + v } },
                x: { grid: { display: false } }
            }
        }
    });
</script>

<?php require_once 'footer.php'; ?>