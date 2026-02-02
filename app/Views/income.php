<?php require_once 'header.php'; ?>

<div class="min-h-screen bg-slate-50/50 pb-20 pt-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
            <div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight">Income Records</h1>
                <p class="text-slate-500 font-medium">Manage your inflows and maintain a healthy balance.</p>
            </div>
            <a href="/BudgetX/public/income/create"
                class="btn-primary py-3 px-8 text-sm font-bold shadow-lg shadow-brand-500/20">
                Add New Income
            </a>
        </div>

        <div class="card-bento overflow-hidden p-0">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-8 py-5 text-xs font-black text-slate-500 uppercase tracking-widest">Source &
                                Date</th>
                            <th
                                class="px-8 py-5 text-xs font-black text-slate-500 uppercase tracking-widest text-right">
                                Amount</th>
                            <th
                                class="px-8 py-5 text-xs font-black text-slate-500 uppercase tracking-widest text-right">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php if (empty($incomes)): ?>
                            <tr>
                                <td colspan="3" class="px-8 py-12 text-center text-slate-400 font-medium">No income records
                                    found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($incomes as $income): ?>
                                <tr class="hover:bg-slate-50/50 transition-colors group">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center group-hover:bg-white group-hover:shadow-sm transition-all text-sm font-bold">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 4v16m8-8H4" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-black text-slate-900">
                                                    <?php echo htmlspecialchars($income['source']); ?>
                                                </p>
                                                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">
                                                    <?php echo date('M d, Y', strtotime($income['date'])); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <span
                                            class="text-sm font-black text-emerald-600">+<?php echo $currency_symbol . number_format($income['amount'], 2); ?></span>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <div
                                            class="flex items-center justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <a href="/BudgetX/public/income/edit?id=<?php echo $income['id']; ?>"
                                                class="p-2 text-slate-400 hover:text-brand-600 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="/BudgetX/public/income/delete" method="POST"
                                                onsubmit="return confirm('Remove this record?');">
                                                <input type="hidden" name="id" value="<?php echo $income['id']; ?>">
                                                <button type="submit"
                                                    class="p-2 text-slate-400 hover:text-accent-600 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>