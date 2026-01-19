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

<body class="bg-gray-50 font-sans text-slate-800">
    <nav class="bg-white shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="/BudgetX/public/" class="text-2xl font-bold text-blue-600">BudgetX</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                            <a href="/BudgetX/public/admin"
                                class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Admin
                                Panel</a>
                        <?php else: ?>
                            <a href="/BudgetX/public/dashboard"
                                class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                            <a href="/BudgetX/public/income"
                                class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Income</a>
                            <a href="/BudgetX/public/expenses"
                                class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Expenses</a>
                            <a href="/BudgetX/public/goals"
                                class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Goals</a>
                            <a href="/BudgetX/public/shared_goals"
                                class="text-gray-600 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium">Shared
                                (Premium)</a>
                            <a href="/BudgetX/public/upgrade"
                                class="text-yellow-600 hover:text-yellow-700 px-3 py-2 rounded-md text-sm font-medium">Upgrade</a>
                        <?php endif; ?>
                        <a href="/BudgetX/public/logout"
                            class="text-gray-600 hover:text-red-500 px-3 py-2 rounded-md text-sm font-medium">Logout</a>
                    <?php else: ?>
                        <a href="/BudgetX/public/login"
                            class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Login</a>
                        <a href="/BudgetX/public/register"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">Get
                            Started</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
    <main>