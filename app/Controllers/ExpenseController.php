<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Expense;

class ExpenseController extends Controller
{
    /**
     * Display all expense records with optional category and date filtering
     */
    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        $userId = $_SESSION['user_id'];

        // Extraction of Filter parameters
        $category = $_GET['category'] ?? null;
        $date = $_GET['date'] ?? null;
        if ($category === '')
            $category = null;
        if ($date === '')
            $date = null;

        $expenseModel = new Expense();
        $expenses = $expenseModel->getAllByUserId($userId, $category, $date);

        $this->view('expenses', [
            'expenses' => $expenses,
            'categoryFilter' => $category,
            'dateFilter' => $date
        ]);
    }

    /**
     * Show form to record a new expense
     */
    public function create()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }
        $this->view('expenses_create');
    }

    /**
     * Store a new expense record and associate it with a category
     */
    public function store()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        $userId = $_SESSION['user_id'];
        $amount = $_POST['amount'];
        $category = $_POST['category'];
        $label = $_POST['label'];
        $date = $_POST['date'];
        $description = $_POST['description'];

        // Validation: Positive amount and no future spending allowed
        if ($amount <= 0) {
            $this->view('expenses_create', ['error' => 'Amount must be greater than 0']);
            return;
        }

        if (strtotime($date) > time()) {
            $this->view('expenses_create', ['error' => 'Date cannot be in the future']);
            return;
        }

        // Feature: Capital Outflow Tracking
        // Categorizes financial leaks to help users identify saving opportunities
        $expenseModel = new Expense();
        if ($expenseModel->add($userId, $amount, $category, $label, $date, $description)) {
            $this->redirect('/BudgetX/public/expenses');
        } else {
            $this->view('expenses_create', ['error' => 'Failed to add expense']);
        }
    }

    /**
     * Show form to edit an existing expense record
     */
    public function edit()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect('/BudgetX/public/expenses');
        }

        $expenseModel = new Expense();
        $expense = $expenseModel->getById($id, $_SESSION['user_id']);

        if (!$expense) {
            $this->redirect('/BudgetX/public/expenses');
        }

        $this->view('expenses_edit', ['expense' => $expense]);
    }

    /**
     * Update existing expense details
     */
    public function update()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        $id = $_POST['id'];
        $amount = $_POST['amount'];
        $category = $_POST['category'];
        $label = $_POST['label'];
        $date = $_POST['date'];
        $description = $_POST['description'];

        if ($amount <= 0 || strtotime($date) > time()) {
            $this->redirect('/BudgetX/public/expenses');
            return;
        }

        $expenseModel = new Expense();
        if ($expenseModel->update($id, $_SESSION['user_id'], $amount, $category, $label, $date, $description)) {
            $this->redirect('/BudgetX/public/expenses');
        } else {
            $this->redirect('/BudgetX/public/expenses');
        }
    }

    /**
     * Securely delete an expense record
     */
    public function delete()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        $id = $_POST['id'] ?? null;
        if ($id) {
            $expenseModel = new Expense();
            $expenseModel->delete($id, $_SESSION['user_id']);
        }

        $this->redirect('/BudgetX/public/expenses');
    }
}


