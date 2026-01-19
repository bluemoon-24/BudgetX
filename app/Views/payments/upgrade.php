<?php require_once '../app/Views/partials/header.php'; ?>

<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:flex-col sm:align-center">
        <h1 class="text-5xl font-extrabold text-gray-900 sm:text-center">Upgrade to BudgetX Premium</h1>
        <p class="mt-5 text-xl text-gray-500 sm:text-center">Unlock advanced analytics, shared goals, and more!</p>
    </div>
    <div
        class="mt-12 space-y-4 sm:mt-16 sm:space-y-0 sm:grid sm:grid-cols-2 sm:gap-6 lg:max-w-4xl lg:mx-auto xl:max-w-none xl:mx-0 xl:grid-cols-2">

        <!-- Basic (Current) -->
        <div class="border border-gray-200 rounded-lg shadow-sm divide-y divide-gray-200">
            <div class="p-6">
                <h2 class="text-lg leading-6 font-medium text-gray-900">Basic</h2>
                <p class="mt-4 text-sm text-gray-500">Essential budgeting features for individuals.</p>
                <p class="mt-8">
                    <span class="text-4xl font-extrabold text-gray-900">Free</span>
                </p>
                <a href="/BudgetX/public/user/dashboard_basic"
                    class="mt-8 block w-full bg-gray-50 border border-gray-200 rounded-md py-2 text-sm font-semibold text-gray-900 text-center hover:bg-gray-100">
                    Your Current Plan
                </a>
            </div>
        </div>

        <!-- Premium -->
        <div
            class="border border-indigo-200 rounded-lg shadow-sm divide-y divide-gray-200 bg-white ring-2 ring-indigo-500">
            <div class="p-6">
                <h2 class="text-lg leading-6 font-medium text-gray-900">Premium</h2>
                <p class="mt-4 text-sm text-gray-500">Advanced tools for serious financial tracking & collaboration.</p>
                <p class="mt-8">
                    <span class="text-4xl font-extrabold text-gray-900">$9.99</span>
                    <span class="text-base font-medium text-gray-500">/mo</span>
                </p>

                <!-- Simulated Checkout Button -->
                <a href="/BudgetX/public/payments/process"
                    class="mt-8 block w-full bg-indigo-600 border border-transparent rounded-md py-2 text-sm font-semibold text-white text-center hover:bg-indigo-700">
                    Upgrade Now
                </a>

                <p class="mt-2 text-xs text-center text-gray-400">Secured by Stripe (Simulated)</p>
            </div>
            <div class="pt-6 pb-8 px-6">
                <h3 class="text-xs font-medium text-gray-900 tracking-wide uppercase">What's included</h3>
                <ul class="mt-6 space-y-4">
                    <li class="flex space-x-3">
                        <svg class="flex-shrink-0 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm text-gray-500">Shared Goals</span>
                    </li>
                    <li class="flex space-x-3">
                        <svg class="flex-shrink-0 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm text-gray-500">Advanced Analytics</span>
                    </li>
                    <li class="flex space-x-3">
                        <svg class="flex-shrink-0 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm text-gray-500">Overspending Alerts</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/Views/partials/footer.php'; ?>