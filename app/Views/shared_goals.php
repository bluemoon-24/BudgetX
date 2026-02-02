<?php require_once 'header.php'; ?>

<div class="min-h-screen bg-slate-50/50 pb-20 pt-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex items-center justify-between mb-12">
            <div>
                <h1 class="text-5xl font-black text-slate-900 tracking-tight mb-3">Shared Goals</h1>
                <p class="text-lg text-slate-500 font-medium">Collaborative savings with family and friends.</p>
            </div>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'premium'): ?>
                <a href="/BudgetX/public/shared_goals/create"
                    class="btn-primary py-3 px-8 text-sm font-bold shadow-lg shadow-brand-500/20">
                    New Shared Goal
                </a>
            <?php endif; ?>
        </div>

        <?php if (empty($goals)): ?>
            <div class="card-bento p-20 text-center flex flex-col items-center justify-center">
                <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mb-6 text-slate-300">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-black text-slate-900 mb-2">No active hubs found</h3>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'premium'): ?>
                    <p class="text-slate-500 font-medium mb-8 max-w-sm">Collaboration is a premium privilege. Create your first
                        goal to start saving with your peers.</p>
                    <a href="/BudgetX/public/shared_goals/create" class="btn-secondary py-3 px-10">Initiate First Goal</a>
                <?php else: ?>
                    <p class="text-slate-500 font-medium mb-8 max-w-sm">Shared goals allow groups to save together. Upgrade to
                        Premium to start your own collaborative hub.</p>
                    <a href="/BudgetX/public/upgrade" class="btn-primary py-3 px-10 shadow-lg shadow-brand-500/20">Upgrade
                        Now</a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($goals as $goal): ?>
                    <?php
                    $percentage = ($goal['target_amount'] > 0) ? min(100, ($goal['current_amount'] / $goal['target_amount']) * 100) : 0;
                    ?>
                    <div class="card-bento group hover:-translate-y-2 transition-all duration-300 relative overflow-hidden">
                        <div
                            class="absolute -right-4 -top-4 w-20 h-20 bg-brand-50 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity">
                        </div>

                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h3 class="text-xl font-black text-slate-900 group-hover:text-brand-600 transition-colors">
                                    <?php echo htmlspecialchars($goal['name']); ?>
                                </h3>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Initiated by
                                    <?php echo htmlspecialchars($goal['owner_name']); ?>
                                </p>
                            </div>
                            <div class="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center text-slate-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 005.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                        </div>

                        <div class="space-y-2 mb-8">
                            <div class="flex items-center justify-between text-xs font-black uppercase tracking-widest">
                                <span class="text-slate-400">Progress</span>
                                <span class="text-brand-600"><?php echo number_format($percentage, 0); ?>%</span>
                            </div>
                            <div class="h-2.5 bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-brand-600 to-brand-400 rounded-full transition-all duration-1000 shadow-sm"
                                    style="width: <?php echo $percentage; ?>%"></div>
                            </div>
                            <div class="flex items-center justify-between pt-2">
                                <p class="text-sm font-black text-slate-900">
                                    <?php echo $currency_symbol . number_format($goal['current_amount'], 2); ?>
                                </p>
                                <p class="text-xs font-bold text-slate-400">Target
                                    <?php echo $currency_symbol . number_format($goal['target_amount'], 2); ?>
                                </p>
                            </div>
                        </div>

                        <a href="/BudgetX/public/shared_goals/view?id=<?php echo $goal['id']; ?>"
                            class="btn-secondary w-full text-center py-3 text-sm font-bold block group-hover:bg-slate-900 group-hover:text-white transition-all">
                            Manage Contributions
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once 'footer.php'; ?>