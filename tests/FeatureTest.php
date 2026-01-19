<?php

// Basic Test Runner
echo "Starting BudgetX Feature Tests...\n\n";

// define app root
define('APPROOT', __DIR__ . '/../app');
require_once APPROOT . '/Core/Database.php';
require_once APPROOT . '/Models/User.php';
require_once APPROOT . '/Models/Income.php';
require_once APPROOT . '/Models/Expense.php';
require_once APPROOT . '/Models/Goal.php';
require_once APPROOT . '/Models/SharedGoal.php';
require_once APPROOT . '/Models/Admin.php';

use App\Models\User;
use App\Models\Income;
use App\Models\Expense;
use App\Models\Goal;
use App\Models\SharedGoal;
use App\Models\Admin;

$db = new \App\Core\Database();
// Clean up previous test data if exists
$db->query("DELETE FROM users WHERE email LIKE 'test_%@example.com'");
$db->query("DELETE FROM activity_logs"); // Optional cleanup

// 1. User Registration & Login
echo "[TEST] User Registration... ";
$userModel = new User();
$testEmail = 'test_' . uniqid() . '@example.com';
$testUser = 'testuser_' . uniqid();
try {
    $res = $userModel->register($testUser, 'Test User', $testEmail, 'password123');
    if ($res) {
        echo "PASS\n";
    } else {
        echo "FAIL (Register returned false)\n";
        exit;
    }
} catch (Exception $e) {
    echo "FAIL: " . $e->getMessage() . "\n";
    exit;
}

echo "[TEST] User Login... ";
$loggedInUser = $userModel->login($testEmail, 'password123');
if ($loggedInUser && $loggedInUser['username'] === $testUser) {
    echo "PASS\n";
} else {
    echo "FAIL (Login returned false or username mismatch)\n";
    exit;
}
$userId = $loggedInUser['id'];

// 2. Income CRUD
echo "[TEST] Add Income... ";
$incomeModel = new Income();
$res = $incomeModel->add($userId, 5000, 'Salary', date('Y-m-d'));
if ($res)
    echo "PASS\n";
else
    echo "FAIL\n";

echo "[TEST] Get Income... ";
$incomes = $incomeModel->getAllByUserId($userId);
if (count($incomes) > 0 && $incomes[0]['amount'] == 5000)
    echo "PASS\n";
else
    echo "FAIL\n";

// 3. Expense CRUD & Analytics
echo "[TEST] Add Expense... ";
$expenseModel = new Expense();
$res = $expenseModel->add($userId, 100, 'Food', 'Groceries', date('Y-m-d'), 'Weekly shopping');
if ($res)
    echo "PASS\n";
else
    echo "FAIL\n";

echo "[TEST] Expense Analytics (Monthly)... ";
$monthly = $expenseModel->getMonthlyExpenses($userId);
if (count($monthly) > 0)
    echo "PASS\n";
else
    echo "FAIL\n";

// 4. Goals & Progress
echo "[TEST] Create Goal... ";
$goalModel = new Goal();
$res = $goalModel->add($userId, 'New Car', 20000, date('Y-m-d', strtotime('+1 year')));
if ($res)
    echo "PASS\n";
else
    echo "FAIL\n";

// Get the goal ID
$goals = $goalModel->getAllByUserId($userId);
$goalId = $goals[0]['id'];

echo "[TEST] Add Funds to Goal... ";
$res = $goalModel->updateProgress($goalId, $userId, 5000);
if ($res)
    echo "PASS\n";
else
    echo "FAIL\n";

echo "[TEST] Check Goal Progress... ";
$updatedGoal = $goalModel->getById($goalId);
if ($updatedGoal['current_amount'] == 5000)
    echo "PASS\n";
else
    echo "FAIL\n";

// 5. Shared Goals (Premium Feature Simulation)
echo "[TEST] Create Shared Goal... ";
$sharedGoalModel = new SharedGoal();
$sharedGoalId = $sharedGoalModel->create($userId, 'Family Trip', 5000, date('Y-m-d'));
if ($sharedGoalId)
    echo "PASS\n";
else
    echo "FAIL\n";

echo "[TEST] Add Funds to Shared Goal... ";
$res = $sharedGoalModel->updateProgress($sharedGoalId, $userId, 100);
if ($res)
    echo "PASS\n";
else
    echo "FAIL\n";

// 6. Admin Stats
echo "[TEST] Admin Stats... ";
$adminModel = new Admin();
$stats = $adminModel->getUserStats();
if ($stats['total'] >= 1)
    echo "PASS\n";
else
    echo "FAIL\n";

echo "\nAll Tests Completed.\n";
