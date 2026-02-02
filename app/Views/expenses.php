<?php require_once 'header.php'; ?>

<div class="min-h-screen bg-slate-50/50 pb-20 pt-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
            <div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight">Expenses</h1>
                <p class="text-slate-500 font-medium">Track your spending and identify savings opportunities.</p>
            </div>
            <a href="/BudgetX/public/expenses/create"
                class="btn-primary py-3 px-8 text-sm font-bold shadow-lg shadow-brand-500/20">
                Add New Expense
            </a>
        </div>

        <!-- Filters Section -->
        <div class="card-bento mb-8">
            <h3 class="text-sm font-black text-slate-400 uppercase tracking-widest mb-6">Filter Records</h3>
            <form action="/BudgetX/public/expenses" method="GET"
                class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
                <div>
                    <label for="category"
                        class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Category</label>
                    <select name="category" id="category" class="input-premium w-full !py-2.5">
                        <option value="">All Categories</option>
                        <option value="Food" <?php echo ($categoryFilter == 'Food') ? 'selected' : ''; ?>>Food</option>
                        <option value="Transport" <?php echo ($categoryFilter == 'Transport') ? 'selected' : ''; ?>>
                            Transport</option>
                        <option value="Utilities" <?php echo ($categoryFilter == 'Utilities') ? 'selected' : ''; ?>>
                            Utilities</option>
                        <option value="Entertainment" <?php echo ($categoryFilter == 'Entertainment') ? 'selected' : ''; ?>>Entertainment</option>
                        <option value="Health" <?php echo ($categoryFilter == 'Health') ? 'selected' : ''; ?>>Health
                        </option>
                        <option value="Shopping" <?php echo ($categoryFilter == 'Shopping') ? 'selected' : ''; ?>>Shopping
                        </option>
                        <option value="Goal Contribution" <?php echo ($categoryFilter == 'Goal Contribution') ? 'selected' : ''; ?>>Goal Contribution</option>
                        <option value="Other" <?php echo ($categoryFilter == 'Other') ? 'selected' : ''; ?>>Other</option>
                    </select>
                </div>
                <div>
                    <label for="date"
                        class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Date</label>
                    <input type="date" name="date" id="date" value="<?php echo htmlspecialchars($dateFilter); ?>"
                        class="input-premium w-full !py-2.5">
                </div>
                <div>
                    <button type="submit"
                        class="btn-primary w-full py-2.5 text-sm font-bold !bg-slate-900 !from-slate-900 !to-slate-900">
                        Apply Filters
                    </button>
                </div>
                <div>
                    <a href="/BudgetX/public/expenses"
                        class="btn-secondary w-full py-2.5 text-sm font-bold text-center">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Transactions Table -->
        <div class="card-bento overflow-hidden p-0">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-8 py-5 text-xs font-black text-slate-500 uppercase tracking-widest">
                                Transaction Details</th>
                            <th
                                class="px-8 py-5 text-xs font-black text-slate-500 uppercase tracking-widest text-right">
                                Amount</th>
                            <th
                                class="px-8 py-5 text-xs font-black text-slate-500 uppercase tracking-widest text-right">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php if (empty($expenses)): ?>
                            <tr>
                                <td colspan="3" class="px-8 py-12 text-center text-slate-400 font-medium">No expense records
                                    found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($expenses as $expense): ?>
                                <tr class="hover:bg-slate-50/50 transition-colors group">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="w-10 h-10 bg-slate-100 text-slate-600 rounded-xl flex items-center justify-center group-hover:bg-white group-hover:shadow-sm transition-all text-sm font-bold">
                                                <?php echo substr($expense['category'], 0, 1); ?>
                                            </div>
                                            <div>
                                                <p class="text-sm font-black text-slate-900">
                                                    <?php echo htmlspecialchars($expense['label']); ?>
                                                </p>
                                                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">
                                                    <?php echo htmlspecialchars($expense['category']); ?> •
                                                    <?php echo date('M d, Y', strtotime($expense['date'])); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <span
                                            class="text-sm font-black text-accent-600">-<?php echo $currency_symbol . number_format($expense['amount'], 2); ?></span>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <div
                                            class="flex items-center justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <a href="/BudgetX/public/expenses/edit?id=<?php echo $expense['id']; ?>"
                                                class="p-2 text-slate-400 hover:text-brand-600 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="/BudgetX/public/expenses/delete" method="POST"
                                                onsubmit="return confirm('Archive this transaction?');">
                                                <input type="hidden" name="id" value="<?php echo $expense['id']; ?>">
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