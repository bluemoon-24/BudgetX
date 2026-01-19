<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Income;
use App\Models\Expense;

class DashboardController extends Controller
{
    public function index()
    {
        // Default fallback or redirect
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

    public function basic()
    {
        $this->loadDashboard('dashboard/basic');
    }

    public function premium()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        if ($_SESSION['role'] !== 'premium') {
            $this->redirect('/BudgetX/public/user/dashboard_basic');
        }

        $userId = $_SESSION['user_id'];
        $expenseModel = new Expense();
        $incomeModel = new Income();

        // Basic Data
        $totalIncome = $incomeModel->getTotalByUserId($userId);
        $totalExpenses = $expenseModel->getTotalByUserId($userId);
        $balance = $totalIncome - $totalExpenses;
        $recentIncome = $incomeModel->getAllByUserId($userId);
        $recentExpenses = $expenseModel->getAllByUserId($userId);
        $expensesByCategory = $expenseModel->getExpensesByCategory($userId);

        // Premium Data
        $monthlyExpenses = $expenseModel->getMonthlyExpenses($userId);
        $spendingTrends = $expenseModel->getSpendingTrends($userId);

        // Overspending Logic (Simple: compare current month vs prev month)
        $currentMonth = date('Y-m');
        $prevMonth = date('Y-m', strtotime('-1 month'));

        $currentMonthTotal = $expenseModel->getTotalByMonth($userId, $currentMonth);
        $prevMonthTotal = $expenseModel->getTotalByMonth($userId, $prevMonth);

        $overspendingAlert = false;
        if ($prevMonthTotal > 0 && $currentMonthTotal > $prevMonthTotal) {
            $overspendingAlert = true;
        }

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
            'overspendingAlert' => $overspendingAlert
        ];

        $this->view('dashboard/premium', $data);
    }

    private function loadDashboard($viewName)
    {
        // Authentication Check
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        $userId = $_SESSION['user_id'];

        $incomeModel = new Income();
        $expenseModel = new Expense();

        $totalIncome = $incomeModel->getTotalByUserId($userId);
        $totalExpenses = $expenseModel->getTotalByUserId($userId);
        $balance = $totalIncome - $totalExpenses;

        $recentIncome = $incomeModel->getAllByUserId($userId);
        $recentExpenses = $expenseModel->getAllByUserId($userId);

        $expensesByCategory = $expenseModel->getExpensesByCategory($userId);

        $data = [
            'totalIncome' => $totalIncome,
            'totalExpenses' => $totalExpenses,
            'balance' => $balance,
            'recentIncome' => $recentIncome,
            'recentExpenses' => $recentExpenses,
            'expensesByCategory' => $expensesByCategory
        ];

        $this->view($viewName, $data);
    }
}
