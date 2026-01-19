<?php require_once '../app/Views/partials/header.php'; ?>

<div class="bg-white">
    <!-- Hero Section -->
    <div class="relative overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2"
                    fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                    <polygon points="50,0 100,0 50,100 0,100" />
                </svg>

                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block xl:inline">Take Control of</span>
                            <span class="block text-indigo-600 xl:inline">Your Finances with BudgetX</span>
                        </h1>
                        <p
                            class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Track income, manage expenses, and achieve your financial goals with our intuitive budgeting
                            platform. Join thousands of users today.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <a href="/BudgetX/public/register"
                                    class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg">
                                    Get Started Free
                                </a>
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-3">
                                <a href="/BudgetX/public/login"
                                    class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 md:py-4 md:text-lg">
                                    Login
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full"
                src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2850&q=80"
                alt="Budget planning">
        </div>
    </div>

    <!-- Feature Highlights -->
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Features</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Everything you need to manage your money
                </p>
            </div>

            <div class="mt-10">
                <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                    <div class="relative">
                        <dt>
                            <div
                                class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <!-- Heroicon name: outline/chart-bar -->
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Track Income & Expenses</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Easily record your daily transactions and categorize them to see exactly where your money
                            goes.
                        </dd>
                    </div>

                    <div class="relative">
                        <dt>
                            <div
                                class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <!-- Heroicon name: outline/flag -->
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 21v-8a2 2 0 012-2h14a2 2 0 012 2v8M3 21h18M3 21l8-8 8 8M4 10V3a1 1 0 011-1h14a1 1 0 011 1v7" />
                                </svg>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Financial Goals</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Set savings targets and track your progress visually. Stay motivated as you reach your
                            milestones.
                        </dd>
                    </div>

                    <div class="relative">
                        <dt>
                            <div
                                class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <!-- Heroicon name: outline/lightning-bolt -->
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Monthly Insights (Premium)</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Get detailed analytics and visual reports to understand your spending habits and trends over
                            time.
                        </dd>
                    </div>

                    <div class="relative">
                        <dt>
                            <div
                                class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <!-- Heroicon name: outline/users -->
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Shared Goals (Premium)</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Collaborate on financial goals with friends or family. Perfect for vacations, shared
                            purchases, or group savings.
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    <!-- Pricing Section -->
    <div class="bg-gray-900">
        <div class="pt-12 sm:pt-16 lg:pt-24">
            <div class="max-w-7xl mx-auto text-center px-4 sm:px-6 lg:px-8">
                <div class="max-w-3xl mx-auto space-y-2 lg:max-w-none">
                    <h2 class="text-lg leading-6 font-semibold text-gray-300 uppercase tracking-wider">Pricing</h2>
                    <p class="text-3xl font-extrabold text-white sm:text-4xl lg:text-5xl">The right price for you,
                        whoever you are</p>
                </div>
            </div>
        </div>
        <div class="mt-8 pb-12 bg-gray-50 sm:mt-12 sm:pb-16 lg:mt-16 lg:pb-24">
            <div class="relative">
                <div class="absolute inset-0 h-3/4 bg-gray-900"></div>
                <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="max-w-md mx-auto space-y-4 lg:max-w-5xl lg:grid lg:grid-cols-2 lg:gap-5 lg:space-y-0">
                        <!-- Free Tier -->
                        <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                            <div class="px-6 py-8 bg-white sm:p-10 sm:pb-6">
                                <div>
                                    <h3 class="inline-flex px-4 py-1 rounded-full text-sm font-semibold tracking-wide uppercase bg-indigo-100 text-indigo-600"
                                        id="tier-standard">
                                        Free Plan
                                    </h3>
                                </div>
                                <div class="mt-4 flex items-baseline text-6xl font-extrabold text-gray-900">
                                    $0
                                    <span class="ml-1 text-2xl font-medium text-gray-500">/mo</span>
                                </div>
                                <p class="mt-5 text-lg text-gray-500">
                                    Basic budgeting tools for individuals.
                                </p>
                            </div>
                            <div
                                class="flex-1 flex flex-col justify-between px-6 pt-6 pb-8 bg-gray-50 space-y-6 sm:p-10 sm:pt-6">
                                <ul class="space-y-4">
                                    <li class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <!-- Heroicon name: outline/check -->
                                            <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                        <p class="ml-3 text-base text-gray-700">Track Income & Expenses</p>
                                    </li>
                                    <li class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                        <p class="ml-3 text-base text-gray-700">Basic Financial Goals</p>
                                    </li>
                                </ul>
                                <div class="rounded-md shadow">
                                    <a href="/BudgetX/public/register"
                                        class="flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700"
                                        aria-describedby="tier-standard">
                                        Get Started Free
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Premium Tier -->
                        <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                            <div class="px-6 py-8 bg-white sm:p-10 sm:pb-6">
                                <div>
                                    <h3 class="inline-flex px-4 py-1 rounded-full text-sm font-semibold tracking-wide uppercase bg-indigo-100 text-indigo-600"
                                        id="tier-premium">
                                        Premium Plan
                                    </h3>
                                </div>
                                <div class="mt-4 flex items-baseline text-6xl font-extrabold text-gray-900">
                                    $9.99
                                    <span class="ml-1 text-2xl font-medium text-gray-500">/mo</span>
                                </div>
                                <p class="mt-5 text-lg text-gray-500">
                                    Advanced features for collaborative growth.
                                </p>
                            </div>
                            <div
                                class="flex-1 flex flex-col justify-between px-6 pt-6 pb-8 bg-gray-50 space-y-6 sm:p-10 sm:pt-6">
                                <ul class="space-y-4">
                                    <li class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                        <p class="ml-3 text-base text-gray-700">Everything in Free</p>
                                    </li>
                                    <li class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                        <p class="ml-3 text-base text-gray-700">Advanced Analytics</p>
                                    </li>
                                    <li class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                        <p class="ml-3 text-base text-gray-700">Shared Goals</p>
                                    </li>
                                </ul>
                                <div class="rounded-md shadow">
                                    <a href="/BudgetX/public/register"
                                        class="flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700"
                                        aria-describedby="tier-premium">
                                        Get Started Free
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/Views/partials/footer.php'; ?>