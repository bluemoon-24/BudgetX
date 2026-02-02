<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Income;
use App\Models\Expense;

class DashboardController extends Controller
{
    /**
     * Main index route for /dashboard
     * Redirects users to their specific dashboard based on their role
     */
    public function index()
    {
        // Authentication Check
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] === 'premium') {
                $this->premium();
            } else {
                $this->basic();
            }
        }
    }

    /**
     * Display the Basic User Dashboard
     * Shows limited analytics and standard transaction logs
     */
    public function basic()
    {
        $this->loadDashboard('dashboard_basic');
    }

    /**
     * Display the Premium User Dashboard
     * Includes advanced analytics like spending trends, monthly velocity, and overspending alerts
     */
    public function premium()
    {
        // Authentication Check
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        // Authorization Check: Ensure only premium users can access this
        if ($_SESSION['role'] !== 'premium') {
            $this->redirect('/BudgetX/public/user/dashboard_basic');
        }

        $userId = $_SESSION['user_id'];
        $expenseModel = new Expense();
        $incomeModel = new Income();

        // Fetch fundamental data
        $totalIncome = $incomeModel->getTotalByUserId($userId);
        $totalExpenses = $expenseModel->getTotalByUserId($userId);
        $balance = $totalIncome - $totalExpenses;
        $recentIncome = $incomeModel->getAllByUserId($userId);
        $recentExpenses = $expenseModel->getAllByUserId($userId);
        $expensesByCategory = $expenseModel->getExpensesByCategory($userId);

        // Feature: Advanced Premium Analytics
        // Fetches historical data for trend analysis and velocity tracking
        $monthlyExpenses = $expenseModel->getMonthlyExpenses($userId);
        $spendingTrends = $expenseModel->getSpendingTrends($userId);

        // Feature: Overspending Intelligence 
        // Logic: Compare current month total expenses against the previous month
        $currentMonth = date('Y-m');
        $prevMonth = date('Y-m', strtotime('-1 month'));

        $currentMonthTotal = $expenseModel->getTotalByMonth($userId, $currentMonth);
        $prevMonthTotal = $expenseModel->getTotalByMonth($userId, $prevMonth);

        $overspendingAlert = false;
        if ($prevMonthTotal > 0 && $currentMonthTotal > $prevMonthTotal) {
            $overspendingAlert = true;
        }

        $subscriptionModel = new \App\Models\Subscription();
        $subscription = $subscriptionModel->getStatus($userId);

        $data = [
            'totalIncome' => $totalIncome,
            'totalExpenses' => $totalExpenses,
            'balance' => $balance,
            'recentIncome' => $recentIncome,
            'recentExpenses' => $recentExpenses,
            'expensesByCategory' => $expensesByCategory,
            'monthlyExpenses' => $monthlyExpenses,
            'spendingTrends' => $spendingTrends,
            'currentMonthTotal' => $currentMonthTotal,
            'prevMonthTotal' => $prevMonthTotal,
            'overspendingAlert' => $overspendingAlert,
            'subscription' => $subscription
        ];

        $this->view('dashboard_premium', $data);
    }

    /**
     * Shared logic for loading standard dashboard data
     * Used mainly by the basic dashboard view
     */
    private function loadDashboard($viewName)
    {
        // Authentication Check
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        $userId = $_SESSION['user_id'];

        $incomeModel = new Income();
        $expenseModel = new Expense();

        // Calculate Overview Stats
        $totalIncome = $incomeModel->getTotalByUserId($userId);
        $totalExpenses = $expenseModel->getTotalByUserId($userId);
        $balance = $totalIncome - $totalExpenses;

        // Fetch Recent Transactions
        $recentIncome = $incomeModel->getAllByUserId($userId);
        $recentExpenses = $expenseModel->getAllByUserId($userId);

        // Categorize Expenses for Charts
        $expensesByCategory = $expenseModel->getExpensesByCategory($userId);

        $subscriptionModel = new \App\Models\Subscription();
        $subscription = $subscriptionModel->getStatus($userId);

        $data = [
            'totalIncome' => $totalIncome,
            'totalExpenses' => $totalExpenses,
            'balance' => $balance,
            'recentIncome' => $recentIncome,
            'recentExpenses' => $recentExpenses,
            'expensesByCategory' => $expensesByCategory,
            'subscription' => $subscription
        ];

        $this->view($viewName, $data);
    }
}


