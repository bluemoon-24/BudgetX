<?php require_once 'header.php'; ?>

<!-- Feature Implementation: Stripe Sandbox Page -->
<!-- This page simulates the Stripe hosted checkout environment for testing purposes -->

<div class="min-h-screen bg-[#F6F9FC] flex flex-col md:flex-row">
    <!-- Left Side: Order Summary (Stripe Style) -->
    <div
        class="md:w-1/2 p-8 md:p-20 bg-white md:bg-transparent flex flex-col justify-center items-center md:items-end border-b md:border-b-0 md:border-r border-slate-200">
        <div class="max-w-sm w-full">
            <a href="/BudgetX/public/upgrade"
                class="inline-flex items-center text-slate-500 hover:text-slate-800 transition-colors mb-12">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="text-sm font-bold">Back to BudgetX</span>
            </a>

            <div class="mb-10">
                <p class="text-slate-500 font-bold uppercase tracking-widest text-[10px] mb-2">Subscribe to</p>
                <h1 class="text-3xl font-black text-slate-900 mb-2">BudgetX Premium</h1>
                <div class="flex items-baseline gap-1">
                    <span class="text-5xl font-black text-slate-900">Rs. 650</span>
                    <span class="text-slate-500 font-medium">per month</span>
                </div>
            </div>

            <div class="space-y-6">
                <div class="flex justify-between items-center py-4 border-b border-slate-100">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-slate-900 rounded-xl flex items-center justify-center">
                            <span class="text-white font-black text-lg">B</span>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-900">Premium Membership</p>
                            <p class="text-xs text-slate-500">Qty 1</p>
                        </div>
                    </div>
                    <p class="text-sm font-bold text-slate-900">
                        Rs. 650.00
                    </p>
                </div>

                <div class="flex justify-between text-sm">
                    <span class="text-slate-500 font-medium">Subtotal</span>
                    <span class="text-slate-900 font-bold">
                        Rs. 650.00
                    </span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-slate-500 font-medium">Tax</span>
                    <span class="text-slate-900 font-bold">
                        <?php echo $currency_symbol; ?>0.00
                    </span>
                </div>
                <div class="flex justify-between text-lg pt-4 border-t border-slate-200">
                    <span class="text-slate-900 font-black">Total due today</span>
                    <span class="text-slate-900 font-black">
                        Rs. 650.00
                    </span>
                </div>
            </div>

            <div class="mt-20 opacity-40">
                <div class="flex items-center gap-2 mb-4">
                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Powered by</span>
                    <span class="text-xs font-black text-slate-500">STRIPE</span>
                </div>
                <p class="text-[10px] text-slate-400 font-medium">Terms | Privacy</p>
            </div>
        </div>
    </div>

    <!-- Right Side: Payment Form (Stripe Style) -->
    <div class="md:w-1/2 p-8 md:p-20 bg-white flex flex-col justify-center items-center md:items-start">
        <div class="max-w-md w-full">
            <h2 class="text-xl font-black text-slate-900 mb-8">Pay with card</h2>

            <form action="/BudgetX/public/payments/success" method="GET" class="space-y-6">
                <!-- Sandbox Badge -->
                <div class="bg-amber-50 border border-amber-100 rounded-xl p-4 flex items-center gap-3 mb-8">
                    <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center text-amber-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-xs font-bold text-amber-700">TEST MODE: You can use any card details to proceed.</p>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Email</label>
                    <input type="email" value="<?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?>" readonly
                        class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-slate-500 focus:outline-none focus:ring-2 focus:ring-[#635BFF] transition-all">
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Card information</label>
                    <div
                        class="border border-slate-200 rounded-lg overflow-hidden focus-within:ring-2 focus-within:ring-[#635BFF] transition-all">
                        <div class="relative">
                            <input type="text" placeholder="1234 5678 1234 5678" required
                                class="w-full px-4 py-3 border-b border-slate-200 focus:outline-none">
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 flex gap-1">
                                <span
                                    class="bg-slate-100 text-[8px] font-black px-1 py-0.5 rounded text-slate-400">VISA</span>
                                <span
                                    class="bg-slate-100 text-[8px] font-black px-1 py-0.5 rounded text-slate-400">MC</span>
                            </div>
                        </div>
                        <div class="flex">
                            <input type="text" placeholder="MM / YY" required
                                class="w-1/2 px-4 py-3 border-r border-slate-200 focus:outline-none">
                            <input type="text" placeholder="CVC" required class="w-1/2 px-4 py-3 focus:outline-none">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Name on card</label>
                    <input type="text" placeholder="Jane Doe" required
                        class="w-full border border-slate-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#635BFF] transition-all">
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Country or region</label>
                    <select
                        class="w-full border border-slate-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#635BFF] transition-all">
                        <option>United States</option>
                        <option>United Kingdom</option>
                        <option>Sri Lanka</option>
                        <option>India</option>
                    </select>
                </div>

                <div class="flex items-start gap-3 pt-4">
                    <input type="checkbox" id="saveInStripe" class="mt-1">
                    <label for="saveInStripe" class="text-xs text-slate-500 font-medium leading-relaxed">
                        Securely save my information for 1-click checkout with Link.
                    </label>
                </div>

                <button type="submit"
                    class="w-full bg-[#635BFF] hover:bg-[#0A2540] text-white py-4 px-8 rounded-lg font-black text-sm uppercase tracking-widest transition-all shadow-lg active:scale-[0.98] mt-4">
                    Subscribe
                </button>

                <p class="text-[10px] text-slate-400 text-center font-medium mt-6">
                    By confirming your subscription, you allow BudgetX to charge your card for this payment and future
                    payments in accordance with their terms.
                </p>
            </form>
        </div>
    </div>
</div>

<style>
    /* Stripe uses a specific font or similar looking ones */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

    body {
        font-family: 'Inter', sans-serif !important;
    }
</style>

<?php require_once 'footer.php'; ?>