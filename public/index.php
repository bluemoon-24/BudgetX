<?php

require_once '../app/Core/Database.php';
require_once '../app/Core/Controller.php';
require_once '../app/Core/Router.php';

// Simple autoloader if needed or use manual requires for now to ensure stability
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/../app/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

use App\Core\Router;

session_start();

// Load environment variables
\App\Core\Env::load(__DIR__ . '/../.env');

$router = new Router();

// Define routes
$router->add('GET', '/', 'HomeController', 'index');
$router->add('GET', '/login', 'AuthController', 'login');
$router->add('POST', '/login', 'AuthController', 'authenticate');
$router->add('GET', '/logout', 'AuthController', 'logout');
$router->add('GET', '/register', 'AuthController', 'register');
$router->add('POST', '/register', 'AuthController', 'store');
$router->add('GET', '/dashboard', 'DashboardController', 'index');
$router->add('GET', '/user/dashboard_basic', 'DashboardController', 'basic');
$router->add('GET', '/user/dashboard_premium', 'DashboardController', 'premium');
$router->add('POST', '/profile/upload', 'UserController', 'uploadProfilePic');

$router->add('GET', '/goals', 'GoalController', 'index');
$router->add('GET', '/goals/create', 'GoalController', 'create');
$router->add('POST', '/goals/store', 'GoalController', 'store');
$router->add('GET', '/goals/add_funds', 'GoalController', 'add_funds');
$router->add('POST', '/goals/store_funds', 'GoalController', 'store_funds');
$router->add('POST', '/goals/accept_invitation', 'GoalController', 'acceptInvitation');
$router->add('POST', '/goals/decline_invitation', 'GoalController', 'declineInvitation');
$router->add('GET', '/goals/edit', 'GoalController', 'edit');
$router->add('POST', '/goals/update', 'GoalController', 'update');
$router->add('POST', '/goals/delete', 'GoalController', 'delete');
$router->add('GET', '/admin', 'AdminController', 'index');
$router->add('POST', '/admin/update_status', 'AdminController', 'updateUserStatus');
$router->add('POST', '/admin/update_role', 'AdminController', 'updateUserRole');

$router->add('GET', '/income', 'IncomeController', 'index');
$router->add('GET', '/income/create', 'IncomeController', 'create');
$router->add('POST', '/income/store', 'IncomeController', 'store');
$router->add('GET', '/income/edit', 'IncomeController', 'edit');
$router->add('POST', '/income/update', 'IncomeController', 'update');
$router->add('POST', '/income/delete', 'IncomeController', 'delete');

$router->add('GET', '/expenses', 'ExpenseController', 'index');
$router->add('GET', '/expenses/create', 'ExpenseController', 'create');
$router->add('POST', '/expenses/store', 'ExpenseController', 'store');
$router->add('GET', '/expenses/edit', 'ExpenseController', 'edit');
$router->add('POST', '/expenses/update', 'ExpenseController', 'update');
$router->add('POST', '/expenses/delete', 'ExpenseController', 'delete');

$router->add('GET', '/shared_goals', 'SharedGoalController', 'index');
$router->add('GET', '/shared_goals/create', 'SharedGoalController', 'create');
$router->add('POST', '/shared_goals/store', 'SharedGoalController', 'store');
$router->add('GET', '/shared_goals/view', 'SharedGoalController', 'viewGoal');
$router->add('GET', '/shared_goals/add_member', 'SharedGoalController', 'add_member');
$router->add('POST', '/shared_goals/store_member', 'SharedGoalController', 'store_member');
$router->add('GET', '/shared_goals/add_funds', 'SharedGoalController', 'add_funds');
$router->add('POST', '/shared_goals/store_funds', 'SharedGoalController', 'store_funds');
$router->add('GET', '/shared_goals/edit', 'SharedGoalController', 'edit');
$router->add('POST', '/shared_goals/update', 'SharedGoalController', 'update');
$router->add('POST', '/shared_goals/delete', 'SharedGoalController', 'delete');
$router->add('POST', '/shared_goals/leave', 'SharedGoalController', 'leave');

$router->add('GET', '/upgrade', 'PaymentController', 'upgrade');
$router->add('GET', '/payments/process', 'PaymentController', 'process');
$router->add('GET', '/payments/checkout', 'PaymentController', 'checkout');
$router->add('GET', '/payments/success', 'PaymentController', 'success');
$router->add('GET', '/payments/cancel', 'PaymentController', 'cancel');

// Route for "Dashboard" which redirects based on role
$router->add('GET', '/dashboard', 'DashboardController', 'index');
$router->add('GET', '/user/dashboard_basic', 'DashboardController', 'basic');
$router->add('GET', '/user/dashboard_premium', 'DashboardController', 'premium');

// Dispatch
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
