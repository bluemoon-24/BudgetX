<?php require_once 'header.php'; ?>

<div class="min-h-screen flex flex-col lg:flex-row bg-white">
    <!-- Brand Side (Right on Desktop) -->
    <div
        class="hidden lg:flex lg:w-1/2 bg-slate-900 p-16 flex-col justify-between relative overflow-hidden lg:order-last">
        <!-- Abstract gradient overlays -->
        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-brand-600/20 rounded-full blur-[120px] -ml-64 -mt-64">
        </div>
        <div
            class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-accent-600/20 rounded-full blur-[120px] -mr-64 -mb-64">
        </div>

        <div class="relative z-10 text-right">
            <div class="flex items-center justify-end gap-3 mb-12">
                <span class="text-2xl font-black text-white tracking-tight">BudgetX</span>
                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-lg">
                    <span class="text-slate-900 font-black text-2xl">B</span>
                </div>
            </div>

            <h1 class="text-6xl font-black text-white leading-tight mb-8">
                Elevate your <span class="text-brand-400">Financial IQ</span>.
            </h1>
            <p class="text-slate-400 text-xl max-w-lg ml-auto leading-relaxed">
                Join our elite community of high-net-worth individuals and smart savers. Registration takes under 2
                minutes.
            </p>
        </div>

        <div class="relative z-10">
            <div class="bg-white/5 backdrop-blur-md rounded-[2.5rem] p-8 border border-white/10 max-w-md ml-auto">
                <div class="flex items-center gap-2 mb-6">
                    <div class="flex -space-x-3">
                        <div class="w-10 h-10 rounded-full border-2 border-slate-900 bg-slate-700"></div>
                        <div class="w-10 h-10 rounded-full border-2 border-slate-900 bg-slate-600"></div>
                        <div class="w-10 h-10 rounded-full border-2 border-slate-900 bg-slate-500"></div>
                    </div>
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-widest">+500 joining today</p>
                </div>
                <p class="text-white text-lg font-medium leading-relaxed mb-4 italic">"Finally, a dashboard that speaks
                    the language of modern money. Simply indispensable."</p>
                <p class="text-brand-400 font-bold">Elite Tier Access</p>
            </div>
        </div>
    </div>

    <!-- Form Side (Left on Desktop) -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 lg:p-24 overflow-y-auto">
        <div class="max-w-md w-full py-12">
            <div class="mb-10">
                <h2 class="text-4xl font-black text-slate-900 tracking-tight mb-4">Create Account</h2>
                <p class="text-slate-500 font-medium">
                    Already part of the community?
                    <a href="/BudgetX/public/login"
                        class="text-brand-600 hover:text-brand-500 font-bold underline decoration-brand-200 underline-offset-4">Sign
                        in here</a>
                </p>
            </div>

            <?php if (isset($error)): ?>
                <div
                    class="mb-8 rounded-[1.5rem] bg-red-50 p-4 border border-red-100 flex items-center gap-3 animate-shake">
                    <svg class="w-5 h-5 text-red-500 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="text-sm font-bold text-red-700"><?php echo htmlspecialchars($error); ?></p>
                </div>
            <?php endif; ?>

            <form class="space-y-6" action="/BudgetX/public/register" method="POST">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="first_name"
                            class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">First
                            Name</label>
                        <input id="first_name" name="first_name" type="text" required
                            class="input-premium w-full !rounded-2xl" placeholder="John">
                    </div>
                    <div>
                        <label for="last_name"
                            class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Last
                            Name</label>
                        <input id="last_name" name="last_name" type="text" required
                            class="input-premium w-full !rounded-2xl" placeholder="Doe">
                    </div>
                </div>

                <div>
                    <label for="username"
                        class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Username</label>
                    <input id="username" name="username" type="text" required class="input-premium w-full !rounded-2xl"
                        placeholder="johndoe">
                </div>

                <div>
                    <label for="email"
                        class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Work
                        Email</label>
                    <input id="email" name="email" type="email" required class="input-premium w-full !rounded-2xl"
                        placeholder="name@company.com">
                </div>

                <div>
                    <label for="currency"
                        class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Primary
                        Currency</label>
                    <div class="relative">
                        <select id="currency" name="currency"
                            class="input-premium w-full !rounded-2xl appearance-none cursor-pointer pr-10">
                            <option value="USD">USD ($) - US Dollar</option>
                            <option value="EUR">EUR (€) - Euro</option>
                            <option value="GBP">GBP (£) - British Pound</option>
                            <option value="INR">INR (₹) - Indian Rupee</option>
                            <option value="LKR">LKR (Rs) - Sri Lankan Rupee</option>
                            <option value="JPY">JPY (¥) - Japanese Yen</option>
                            <option value="CAD">CAD ($) - Canadian Dollar</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="password"
                        class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Secure
                        Password</label>
                    <input id="password" name="password" type="password" required
                        class="input-premium w-full !rounded-2xl" placeholder="••••••••" minlength="6"
                        oninput="checkPasswordStrength(this.value)">
                    <div class="mt-3 flex items-center gap-2">
                        <div id="strength-bar" class="h-1.5 flex-1 bg-slate-100 rounded-full overflow-hidden">
                            <div id="strength-progress" class="h-full w-0 transition-all duration-300"></div>
                        </div>
                        <span id="strength-text"
                            class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Weak</span>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="btn-primary w-full py-4 text-sm font-black uppercase tracking-widest shadow-xl shadow-brand-500/20 active:scale-[0.98] transition-transform">
                        Establish Account
                    </button>
                </div>

                <p class="text-center text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-relaxed">
                    By proceeding, you verify compliance with our
                    <a href="#" class="text-slate-600 underline">Agreements</a> and
                    <a href="#" class="text-slate-600 underline">Privacy Systems</a>.
                </p>
            </form>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>

<script>
    function checkPasswordStrength(password) {
        const progress = document.getElementById('strength-progress');
        const text = document.getElementById('strength-text');
        let strength = 0;

        if (password.length >= 6) strength += 25;
        if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength += 25;
        if (password.match(/\d/)) strength += 25;
        if (password.match(/[^a-zA-Z\d]/)) strength += 25;

        progress.style.width = strength + '%';

        if (strength <= 25) {
            progress.className = 'h-full bg-red-500 transition-all duration-300';
            text.innerText = 'Weak';
            text.className = 'text-[10px] font-bold text-red-500 uppercase tracking-wider';
        } else if (strength <= 50) {
            progress.className = 'h-full bg-amber-500 transition-all duration-300';
            text.innerText = 'Fair';
            text.className = 'text-[10px] font-bold text-amber-500 uppercase tracking-wider';
        } else if (strength <= 75) {
            progress.className = 'h-full bg-blue-500 transition-all duration-300';
            text.innerText = 'Good';
            text.className = 'text-[10px] font-bold text-blue-500 uppercase tracking-wider';
        } else {
            progress.className = 'h-full bg-emerald-500 transition-all duration-300';
            text.innerText = 'Strong';
            text.className = 'text-[10px] font-bold text-emerald-500 uppercase tracking-wider';
        }
    }
</script>