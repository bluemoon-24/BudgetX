<?php require_once 'header.php'; ?>

<div class="bg-slate-50 overflow-x-hidden">
    <!-- Hero Section -->
    <section class="relative pt-20 pb-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left: Text Content -->
                <div>
                    <h1 class="text-5xl md:text-6xl font-black text-slate-900 tracking-tight mb-6 leading-[1.1]">
                        Take Control of
                        <span
                            class="bg-clip-text text-transparent bg-gradient-to-r from-brand-600 via-brand-500 to-accent-600">Your
                            Finances with BudgetX</span>
                    </h1>
                    <p class="text-lg text-slate-600 font-medium mb-10 leading-relaxed">
                        Track income, manage expenses, and achieve your financial goals with our intuitive budgeting
                        platform. Join thousands of users today.
                    </p>
                    <div class="flex flex-col sm:flex-row items-start gap-4">
                        <a href="/BudgetX/public/register" class="btn-primary py-4 px-10 text-base">Get Started Free</a>
                        <a href="/BudgetX/public/login" class="btn-secondary py-4 px-10 text-base">Login</a>
                    </div>
                </div>

                <!-- Right: Hero Image -->
                <div class="hidden lg:block">
                    <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?w=800&h=600&fit=crop"
                        alt="Team working on financial planning"
                        class="rounded-3xl shadow-2xl w-full h-auto object-cover">
                </div>
            </div>
        </div>

        <!-- Background Blobs -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-[800px] pointer-events-none -z-10">
            <div class="absolute top-0 left-1/4 w-[500px] h-[500px] bg-brand-200/30 rounded-full blur-[120px]"></div>
            <div class="absolute top-1/2 right-1/4 w-[500px] h-[500px] bg-accent-200/20 rounded-full blur-[120px]">
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="card-bento text-center hover:-translate-y-1 transition-transform">
                    <p class="text-4xl font-black text-brand-600 mb-1">$45M+</p>
                    <p class="text-slate-400 font-bold text-xs uppercase tracking-widest">Transactions Tracked</p>
                </div>
                <div class="card-bento text-center hover:-translate-y-1 transition-transform">
                    <p class="text-4xl font-black text-brand-600 mb-1">99.9%</p>
                    <p class="text-slate-400 font-bold text-xs uppercase tracking-widest">Insights Accuracy</p>
                </div>
                <div class="card-bento text-center hover:-translate-y-1 transition-transform">
                    <p class="text-4xl font-black text-brand-600 mb-1">10k+</p>
                    <p class="text-slate-400 font-bold text-xs uppercase tracking-widest">Shared Goals Completed</p>
                </div>
                <div class="card-bento text-center hover:-translate-y-1 transition-transform">
                    <p class="text-4xl font-black text-brand-600 mb-1">4.9/5</p>
                    <p class="text-slate-400 font-bold text-xs uppercase tracking-widest">User Satisfaction</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Bento Features -->
    <section id="features" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-16">
                <span class="text-brand-600 font-bold tracking-widest uppercase text-sm">Capabilities</span>
                <h2 class="text-4xl font-black text-slate-900 mt-2 tracking-tight leading-tight">Everything you need to
                    <br />master your money.
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                <!-- Large Feature Card -->
                <div
                    class="md:col-span-8 group relative overflow-hidden bg-slate-900 rounded-[2.5rem] p-10 text-white border border-slate-800 flex flex-col justify-between shadow-2xl">
                    <div>
                        <div
                            class="w-14 h-14 bg-white/10 rounded-2xl flex items-center justify-center mb-8 border border-white/5">
                            <svg class="w-7 h-7 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                        <h3 class="text-4xl font-bold mb-6">Advanced Analytics</h3>
                        <p class="text-slate-400 text-xl max-w-sm leading-relaxed">Visualize your spending patterns
                            across categories and months with precision-engineered charts.</p>
                    </div>
                    <div class="mt-12">
                        <div
                            class="w-full h-48 bg-gradient-to-t from-brand-600/20 to-transparent rounded-2xl border border-white/5 relative overflow-hidden">
                            <div class="absolute bottom-6 left-10 right-10 flex items-end justify-between h-24">
                                <div class="w-8 bg-brand-500/30 rounded-t-lg h-12"></div>
                                <div class="w-8 bg-brand-500/40 rounded-t-lg h-20"></div>
                                <div class="w-8 bg-brand-500/50 rounded-t-lg h-16"></div>
                                <div class="w-8 bg-brand-600 rounded-t-lg h-24 shadow-[0_0_20px_rgba(14,140,225,0.4)]">
                                </div>
                                <div class="w-8 bg-brand-500/50 rounded-t-lg h-14"></div>
                                <div class="w-8 bg-brand-500/40 rounded-t-lg h-18"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Small Feature Card -->
                <div
                    class="md:col-span-4 bg-gradient-to-br from-brand-600 to-accent-700 rounded-[2.5rem] p-10 text-white flex flex-col justify-between shadow-xl">
                    <div>
                        <h3 class="text-3xl font-bold mb-6">Family Shared Goals</h3>
                        <p class="text-brand-100 text-lg leading-relaxed">Collaborate with partners and family to save
                            for vacations, houses, or emergencies.</p>
                    </div>
                    <div class="relative h-20 pt-10">
                        <div class="flex -space-x-4">
                            <div class="w-14 h-14 rounded-full border-4 border-brand-600 bg-slate-200"></div>
                            <div class="w-14 h-14 rounded-full border-4 border-brand-600 bg-slate-300"></div>
                            <div class="w-14 h-14 rounded-full border-4 border-brand-600 bg-slate-400"></div>
                            <div
                                class="w-14 h-14 rounded-full border-4 border-brand-600 bg-brand-100 flex items-center justify-center font-bold text-brand-600">
                                +</div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Feature 1 -->
                <div
                    class="md:col-span-4 bg-slate-50 border border-slate-200 rounded-[2.5rem] p-8 group hover:bg-white transition-all duration-300">
                    <div
                        class="w-12 h-12 bg-white rounded-xl shadow-sm border border-slate-100 flex items-center justify-center mb-6 text-brand-600 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3">Bank-Level Security</h3>
                    <p class="text-slate-500">Your financial data is encrypted and secure. We never sell your data.</p>
                </div>

                <!-- Bottom Feature 2 -->
                <div
                    class="md:col-span-8 bg-brand-50 border border-brand-100 rounded-[2.5rem] p-10 flex items-center justify-between group overflow-hidden relative">
                    <div class="max-w-md relative z-10">
                        <h3 class="text-3xl font-bold text-slate-900 mb-4 tracking-tight">Smart Budgeting</h3>
                        <p class="text-slate-600 text-lg leading-relaxed font-medium">Auto-category detection and smart
                            alerts help you stay under budget without thinking about it.</p>
                    </div>
                    <div
                        class="hidden lg:block w-40 h-40 bg-white rounded-3xl shadow-lg border border-brand-100 rotate-12 -mr-10 group-hover:rotate-0 transition-transform duration-700">
                    </div>
                    <div class="absolute -right-20 -top-20 w-64 h-64 bg-brand-200/20 rounded-full blur-3xl"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing -->
    <section class="py-24 bg-slate-50 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-20">
                <h2 class="text-5xl font-black text-slate-900 mb-6">Transparent Pricing</h2>
                <p class="text-slate-500 text-xl font-medium">Choose the plan that fits your ambition.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-5xl mx-auto">
                <!-- Basic -->
                <div
                    class="bg-white rounded-[3rem] p-12 border border-slate-100 shadow-xl flex flex-col justify-between hover:scale-[1.02] transition-transform duration-300">
                    <div>
                        <header>
                            <p class="text-slate-400 font-bold uppercase tracking-widest text-xs mb-4">Personal</p>
                            <h3 class="text-4xl font-black mb-2">Basic</h3>
                            <div class="flex items-baseline mb-10">
                                <span class="text-6xl font-black text-slate-900">$0</span>
                                <span class="text-slate-400 font-bold ml-2">/ month</span>
                            </div>
                        </header>
                        <ul class="space-y-5 mb-12">
                            <li class="flex items-center text-slate-600 font-medium">
                                <svg class="w-6 h-6 text-emerald-500 mr-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Income & Expense Tracking
                            </li>
                            <li class="flex items-center text-slate-600 font-medium">
                                <svg class="w-6 h-6 text-emerald-500 mr-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Basic Goal Setting
                            </li>
                            <li class="flex items-center text-slate-300 font-medium line-through">
                                <svg class="w-6 h-6 text-slate-200 mr-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Shared Family Goals
                            </li>
                        </ul>
                    </div>
                    <a href="/BudgetX/public/register" class="btn-secondary w-full text-center py-5 text-xl">Get Started
                        Free</a>
                </div>

                <!-- Premium -->
                <div class="relative group">
                    <div
                        class="absolute -inset-1.5 bg-gradient-to-r from-brand-600 to-accent-600 rounded-[3.2rem] blur opacity-30 group-hover:opacity-60 transition duration-1000">
                    </div>
                    <div
                        class="relative bg-white rounded-[3rem] p-12 border border-brand-100 shadow-2xl h-full flex flex-col justify-between hover:scale-[1.02] transition-transform duration-300">
                        <div class="absolute top-10 right-10">
                            <span
                                class="bg-brand-500 text-white px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest shadow-lg shadow-brand-500/30">Value</span>
                        </div>
                        <div>
                            <header>
                                <p class="text-brand-600 font-bold uppercase tracking-widest text-xs mb-4">Unlimited</p>
                                <h3 class="text-4xl font-black mb-2">Premium</h3>
                                <div class="flex items-baseline mb-10">
                                    <span class="text-6xl font-black text-slate-900">$29</span>
                                    <span class="text-slate-400 font-bold ml-2">/ lifetime</span>
                                </div>
                            </header>
                            <ul class="space-y-5 mb-12">
                                <li class="flex items-center text-slate-800 font-bold">
                                    <svg class="w-6 h-6 text-emerald-500 mr-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Shared Family Goals
                                </li>
                                <li class="flex items-center text-slate-800 font-bold">
                                    <svg class="w-6 h-6 text-emerald-500 mr-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Advanced ROI Insights
                                </li>
                                <li class="flex items-center text-slate-600 font-medium">
                                    <svg class="w-6 h-6 text-emerald-500 mr-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Priority Support
                                </li>
                            </ul>
                        </div>
                        <a href="/BudgetX/public/register" class="btn-primary w-full text-center py-5 text-xl">Unlock
                            Lifetime Access</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php require_once 'footer.php'; ?>