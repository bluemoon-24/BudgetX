<?php require_once 'header.php'; ?>

<div class="min-h-screen bg-slate-50/50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20">
            <h1 class="text-5xl md:text-6xl font-black text-slate-900 tracking-tight mb-6">Elevate Your Strategy</h1>
            <p class="text-xl text-slate-500 font-medium max-w-2xl mx-auto leading-relaxed">
                Join our elite tier and unlock advanced analytics, shared goal systems, and real-time capital insights.
            </p>
        </div>

        <!-- Features Grid -->
        <div class="mb-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div
                    class="card-bento !p-6 bg-white border-slate-100 hover:border-brand-500 transition-all hover:-translate-y-1">
                    <div class="w-10 h-10 rounded-xl bg-brand-50 flex items-center justify-center text-brand-600 mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <h4 class="text-lg font-black text-slate-900 mb-2">Alpha Analytics</h4>
                    <p class="text-sm font-medium text-slate-500 leading-relaxed">Advanced trend spotting and
                        monthly velocity reports for maximum ROI.</p>
                </div>

                <div
                    class="card-bento !p-6 bg-white border-slate-100 hover:border-accent-500 transition-all hover:-translate-y-1">
                    <div
                        class="w-10 h-10 rounded-xl bg-accent-50 flex items-center justify-center text-accent-600 mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h4 class="text-lg font-black text-slate-900 mb-2">Private Hubs</h4>
                    <p class="text-sm font-medium text-slate-500 leading-relaxed">Co-manage wealth with trusted partners
                        securely.</p>
                </div>

                <div
                    class="card-bento !p-6 bg-white border-slate-100 hover:border-emerald-500 transition-all hover:-translate-y-1">
                    <div
                        class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600 mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h4 class="text-lg font-black text-slate-900 mb-2">Encrypted Vaults</h4>
                    <p class="text-sm font-medium text-slate-500 leading-relaxed">Military-grade protection for your
                        financial data.</p>
                </div>

                <div
                    class="card-bento !p-6 bg-white border-slate-100 hover:border-amber-500 transition-all hover:-translate-y-1">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center text-amber-600 mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                    </div>
                    <h4 class="text-lg font-black text-slate-900 mb-2">Infinite History</h4>
                    <p class="text-sm font-medium text-slate-500 leading-relaxed">No cap on recorded transactions ever.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Form -->
    <div class="max-w-2xl mx-auto">
        <div class="card-bento bg-slate-900 text-white !p-12 border-slate-800 shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-brand-500/10 rounded-full blur-3xl"></div>

            <div class="relative z-10">
                <div class="flex items-start justify-between mb-12">
                    <div>
                        <p class="text-brand-400 font-black uppercase tracking-[0.2em] text-xs mb-2">BudgetX Premium</p>
                        <h3 class="text-4xl font-black mb-1">Membership</h3>
                        <p class="text-slate-500 text-sm font-medium">Unlock full potential</p>
                    </div>
                </div>

                <form id="payment-form" class="space-y-6">
                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <div>
                            <input type="radio" name="plan_type" value="MONTHLY" id="plan-monthly" class="hidden peer"
                                checked>
                            <label for="plan-monthly"
                                class="block p-6 bg-white/5 border-2 border-white/10 rounded-2xl cursor-pointer hover:border-brand-500/50 transition-all relative">
                                <!-- Checkmark indicator -->
                                <div class="checkmark-indicator absolute top-3 right-3 w-5 h-5 rounded-full border-2 border-brand-500 bg-brand-500 flex items-center justify-center opacity-0 transition-all">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">Monthly
                                </p>
                                <p class="text-2xl font-black">Rs. 550</p>
                            </label>
                        </div>
                        <div>
                            <input type="radio" name="plan_type" value="ANNUAL" id="plan-annual" class="hidden peer">
                            <label for="plan-annual"
                                class="block p-6 bg-white/5 border-2 border-white/10 rounded-2xl cursor-pointer hover:border-brand-500/50 transition-all relative">
                                <!-- Checkmark indicator -->
                                <div class="checkmark-indicator absolute top-3 right-3 w-5 h-5 rounded-full border-2 border-brand-500 bg-brand-500 flex items-center justify-center opacity-0 transition-all">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">Annual
                                </p>
                                <p class="text-2xl font-black">Rs. 6000</p>
                            </label>
                        </div>
                    </div>

                    <div id="card-element"
                        class="bg-white/5 border border-white/10 rounded-2xl px-5 py-6 text-white transition-all">
                        <!-- Simulated Stripe card element -->
                        <div class="flex flex-col gap-4">
                            <input type="text" id="card-number" placeholder="Card Number (4242 4242 4242 4242)"
                                class="bg-transparent border-none focus:ring-0 text-white placeholder-white/20 font-mono">
                            <div class="flex gap-4">
                                <input type="text" id="card-expiry" placeholder="MM / YY"
                                    class="w-1/2 bg-transparent border-none focus:ring-0 text-white placeholder-white/20 font-mono">
                                <input type="text" id="card-cvc" placeholder="CVC"
                                    class="w-1/2 bg-transparent border-none focus:ring-0 text-white placeholder-white/20 font-mono">
                            </div>
                        </div>
                    </div>

                    <div id="payment-message" class="hidden p-4 rounded-xl text-xs font-bold mb-4"></div>

                    <button type="submit" id="submit-button"
                        class="w-full bg-brand-500 text-white py-5 px-8 rounded-[2rem] font-black text-base uppercase tracking-widest hover:scale-105 active:scale-95 transition-all shadow-xl shadow-brand-500/20 mt-8">
                        Process Upgrade
                    </button>
                </form>

                <div class="mt-10 pt-8 border-t border-white/10 flex items-center justify-center gap-4 opacity-50">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Secured by</span>
                    <span class="text-xs font-black text-slate-300">STRIPE SANDBOX</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Plan selection visual feedback
    const planRadios = document.querySelectorAll('input[name="plan_type"]');
    
    function updatePlanSelection() {
        planRadios.forEach(radio => {
            const label = document.querySelector(`label[for="${radio.id}"]`);
            const checkmark = label.querySelector('.checkmark-indicator');
            const labelText = label.querySelectorAll('p');
            
            if (radio.checked) {
                // Selected state
                label.classList.add('!border-brand-500', '!bg-brand-500/20', 'shadow-lg', 'shadow-brand-500/20');
                label.classList.remove('border-white/10', 'bg-white/5');
                checkmark.classList.remove('opacity-0');
                checkmark.classList.add('opacity-100');
                labelText.forEach(p => p.classList.add('!text-brand-400'));
            } else {
                // Unselected state
                label.classList.remove('!border-brand-500', '!bg-brand-500/20', 'shadow-lg', 'shadow-brand-500/20');
                label.classList.add('border-white/10', 'bg-white/5');
                checkmark.classList.add('opacity-0');
                checkmark.classList.remove('opacity-100');
                labelText.forEach(p => p.classList.remove('!text-brand-400'));
            }
        });
    }
    
    // Initialize on page load
    updatePlanSelection();
    
    // Update on change
    planRadios.forEach(radio => {
        radio.addEventListener('change', updatePlanSelection);
    });

    document.getElementById('payment-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        const btn = document.getElementById('submit-button');
        const msg = document.getElementById('payment-message');

        btn.disabled = true;
        btn.innerHTML = 'Processing...';

        // Simulate tokenization
        const token = 'tok_' + Math.random().toString(36).substr(2, 9);
        const planType = document.querySelector('input[name="plan_type"]:checked').value;

        try {
            const response = await fetch('/BudgetX/api/payments/create-charge.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({
                    'stripe_token': token,
                    'plan_type': planType
                })
            });

            const result = await response.json();

            if (result.status === 'success') {
                msg.className = 'p-4 rounded-xl text-xs font-bold mb-4 bg-emerald-500/10 text-emerald-400';
                msg.innerHTML = 'Success! Your account has been upgraded. Redirecting...';
                msg.classList.remove('hidden');

                setTimeout(() => {
                    window.location.href = '/BudgetX/public/dashboard';
                }, 2000);
            } else {
                msg.className = 'p-4 rounded-xl text-xs font-bold mb-4 bg-red-500/10 text-red-400';
                msg.innerHTML = result.message || 'Payment failed. Please try again.';
                msg.classList.remove('hidden');
                btn.disabled = false;
                btn.innerHTML = 'Process Upgrade';
            }
        } catch (err) {
            msg.className = 'p-4 rounded-xl text-xs font-bold mb-4 bg-red-500/10 text-red-400';
            msg.innerHTML = 'Connection error. Please try again.';
            msg.classList.remove('hidden');
            btn.disabled = false;
            btn.innerHTML = 'Process Upgrade';
        }
    });
</script>

<?php require_once 'footer.php'; ?>