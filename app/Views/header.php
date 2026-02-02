<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BudgetX - Smart Finance Tracking</title>
    <!-- Use the output CSS path relative to public -->
    <link href="/BudgetX/public/css/output.css" rel="stylesheet">
    <link rel="manifest" href="/BudgetX/public/manifest.json">
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/BudgetX/public/service-worker.js')
                    .then(registration => {
                        console.log('ServiceWorker registration successful with scope: ', registration.scope);
                    })
                    .catch(error => {
                        console.log('ServiceWorker registration failed: ', error);
                    });
            });
        }
    </script>
</head>

<body class="bg-slate-50 font-sans text-slate-900">
    <?php
    $current_uri = $_SERVER['REQUEST_URI'];
    $is_auth_page = strpos($current_uri, 'login') !== false || strpos($current_uri, 'register') !== false;

    // Currency Symbol Mapping
    $currency_symbols = [
        'USD' => '$',
        'EUR' => '€',
        'GBP' => '£',
        'INR' => '₹',
        'LKR' => 'Rs',
        'JPY' => '¥',
        'CAD' => '$',
        'AUD' => '$',
        'CHF' => 'Fr',
        'CNY' => '¥',
        'SEK' => 'kr',
        'NZD' => '$'
    ];
    $user_currency = $_SESSION['currency'] ?? 'USD';
    $currency_symbol = $currency_symbols[$user_currency] ?? '$';
    ?>

    <?php if (!isset($hide_nav) || !$hide_nav): ?>
        <nav class="sticky top-0 z-50 bg-white/70 backdrop-blur-xl border-b border-slate-200/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
                <div class="flex justify-between h-20">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center group cursor-pointer"
                            onclick="window.location.href='/BudgetX/public/'">
                            <div
                                class="w-10 h-10 sm:w-11 sm:h-11 bg-slate-900 rounded-2xl flex items-center justify-center shadow-2xl group-hover:scale-110 transition-transform duration-500">
                                <span class="text-white font-black text-lg sm:text-xl">B</span>
                            </div>
                            <span
                                class="ml-3 sm:ml-4 text-xl sm:text-2xl font-black bg-clip-text text-transparent bg-gradient-to-r from-slate-900 to-slate-600">BudgetX</span>
                        </div>
                    </div>

                    <!-- Mobile Hammer Menu -->
                    <div class="flex items-center md:hidden">
                        <button id="mobile-menu-button" class="p-2 text-slate-500 hover:text-slate-900 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M4 6h16M4 12h16m-7 6h7" />
                            </svg>
                        </button>
                    </div>

                    <div class="flex items-center gap-1">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <div class="hidden md:flex items-center gap-1 mr-6">
                                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                                    <a href="/BudgetX/public/admin" class="nav-link-premium">Admin Control</a>
                                <?php else: ?>
                                    <a href="/BudgetX/public/dashboard" class="nav-link-premium">Overview</a>
                                    <a href="/BudgetX/public/income" class="nav-link-premium">Income</a>
                                    <a href="/BudgetX/public/expenses" class="nav-link-premium">Expenses</a>
                                    <a href="/BudgetX/public/goals" class="nav-link-premium">Goals</a>
                                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'premium'): ?>
                                        <a href="/BudgetX/public/shared_goals" class="nav-link-premium !text-brand-600">Shared Goals</a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>

                            <div class="flex items-center gap-4 pl-6 border-l border-slate-100">
                                <div class="flex flex-col items-end">
                                    <span
                                        class="text-xs font-black text-slate-900 leading-none mb-1"><?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?></span>
                                    <span
                                        class="text-[9px] font-black text-brand-600 uppercase tracking-widest px-1.5 py-0.5 bg-brand-50 rounded-md"><?php echo ucfirst($_SESSION['role'] ?? 'Member'); ?></span>
                                </div>
                                <div class="relative group">
                                    <div
                                        class="w-10 h-10 rounded-2xl bg-slate-100 border border-slate-200 p-0.5 overflow-hidden shadow-inner group-hover:border-brand-500 transition-colors cursor-pointer">
                                        <?php if (isset($_SESSION['profile_pic'])): ?>
                                            <img src="/BudgetX/public/uploads/profile/<?php echo $_SESSION['profile_pic']; ?>"
                                                class="w-full h-full object-cover rounded-[14px]">
                                        <?php else: ?>
                                            <div
                                                class="w-full h-full bg-slate-200 rounded-[14px] flex items-center justify-center text-slate-400 font-black">
                                                <?php echo substr($_SESSION['username'] ?? 'U', 0, 1); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="relative inline-block text-left" id="user-dropdown-container">
                                    <button type="button" id="user-dropdown-button"
                                        class="p-2.5 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-2xl transition-all duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>

                                    <!-- Dropdown menu -->
                                    <div id="user-dropdown-menu"
                                        class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-2xl shadow-2xl bg-white ring-1 ring-black ring-opacity-5 divide-y divide-slate-100 focus:outline-none z-[60]"
                                        role="menu" aria-orientation="vertical" aria-labelledby="user-dropdown-button"
                                        tabindex="-1">
                                        <div class="py-2" role="none">
                                            <a href="/BudgetX/public/logout"
                                                class="flex items-center px-4 py-3 text-sm font-bold text-red-600 hover:bg-red-50 transition-colors"
                                                role="menuitem" tabindex="-1" id="user-dropdown-item-logout">
                                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                                </svg>
                                                Logout
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <a href="/BudgetX/public/login"
                                class="text-sm font-black text-slate-600 hover:text-slate-900 px-6 py-2 transition-colors">Login</a>
                            <a href="/BudgetX/public/register"
                                class="btn-primary !py-2.5 !px-6 !text-xs !font-black !rounded-2xl">Start Free Trial</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            </div>
            </div>

            <!-- Mobile Menu Dropdown -->
            <div id="mobile-menu" class="hidden md:hidden bg-white border-b border-slate-100 py-4 px-6 space-y-3">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <a href="/BudgetX/public/admin" class="block text-sm font-bold text-slate-600 py-2">Admin Control</a>
                    <?php else: ?>
                        <a href="/BudgetX/public/dashboard" class="block text-sm font-bold text-slate-600 py-2">Overview</a>
                        <a href="/BudgetX/public/income" class="block text-sm font-bold text-slate-600 py-2">Income</a>
                        <a href="/BudgetX/public/expenses" class="block text-sm font-bold text-slate-600 py-2">Expenses</a>
                        <a href="/BudgetX/public/goals" class="block text-sm font-bold text-slate-600 py-2">Goals</a>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'premium'): ?>
                            <a href="/BudgetX/public/shared_goals" class="block text-sm font-bold text-brand-600 py-2">Shared Goals</a>
                        <?php endif; ?>
                    <?php endif; ?>
                    <hr class="border-slate-100 my-2">
                    <a href="/BudgetX/public/logout" class="block text-sm font-bold text-red-600 py-2">Logout</a>
                <?php else: ?>
                    <a href="/BudgetX/public/login" class="block text-sm font-bold text-slate-600 py-2">Login</a>
                    <a href="/BudgetX/public/register" class="block btn-primary text-center py-3">Start Free Trial</a>
                <?php endif; ?>
            </div>
        </nav>
    <?php endif; ?>

    <script>
        // User Dropdown Logic
        const dropdownButton = document.getElementById('user-dropdown-button');
        const dropdownMenu = document.getElementById('user-dropdown-menu');

        if (dropdownButton && dropdownMenu) {
            dropdownButton.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdownMenu.classList.toggle('hidden');
                dropdownButton.classList.toggle('bg-slate-100');
                dropdownButton.classList.toggle('text-slate-900');
            });

            document.addEventListener('click', (e) => {
                if (!dropdownMenu.contains(e.target) && !dropdownButton.contains(e.target)) {
                    dropdownMenu.classList.add('hidden');
                    dropdownButton.classList.remove('bg-slate-100', 'text-slate-900');
                }
            });

            // Close on ESC
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    dropdownMenu.classList.add('hidden');
                    dropdownButton.classList.remove('bg-slate-100', 'text-slate-900');
                }
            });
        }

        // Mobile Menu Toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }
    </script>
    <main class="min-h-[calc(100vh-4.5rem)]">