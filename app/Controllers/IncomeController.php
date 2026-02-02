<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Income;

class IncomeController extends Controller
{
    /**
     * Display all income records for the current user
     */
    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        $userId = $_SESSION['user_id'];
        $incomeModel = new Income();
        $incomes = $incomeModel->getAllByUserId($userId);

        $this->view('income', ['incomes' => $incomes]);
    }

    /**
     * Show form to add new income
     */
    public function create()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }
        $this->view('income_create');
    }

    /**
     * Store a new income record in the database
     */
    public function store()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        $userId = $_SESSION['user_id'];
        $amount = $_POST['amount'];
        $source = $_POST['source'];
        $date = $_POST['date'];

        // Validation logic
        if ($amount <= 0) {
            $this->view('income_create', ['error' => 'Amount must be greater than 0']);
            return;
        }

        if (strtotime($date) > time()) {
            $this->view('income_create', ['error' => 'Date cannot be in the future']);
            return;
        }

        // Feature: Capital Inflow Implementation
        // Records individual income sources and updates user liquid assets
        $incomeModel = new Income();
        if ($incomeModel->add($userId, $amount, $source, $date)) {
            $this->redirect('/BudgetX/public/income');
        } else {
            $this->view('income_create', ['error' => 'Failed to add income']);
        }
    }

    /**
     * Show form to edit an existing income record
     */
    public function edit()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect('/BudgetX/public/income');
        }

        $incomeModel = new Income();
        $income = $incomeModel->getById($id, $_SESSION['user_id']);

        if (!$income) {
            $this->redirect('/BudgetX/public/income');
        }

        $this->view('income_edit', ['income' => $income]);
    }

    /**
     * Update an existing income record
     */
    public function update()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        $id = $_POST['id'];
        $amount = $_POST['amount'];
        $source = $_POST['source'];
        $date = $_POST['date'];

        // Validation - Ideally pass error back to edit view
        if ($amount <= 0 || strtotime($date) > time()) {
            $this->redirect('/BudgetX/public/income'); // Fail safe
            return;
        }

        $incomeModel = new Income();
        if ($incomeModel->update($id, $_SESSION['user_id'], $amount, $source, $date)) {
            $this->redirect('/BudgetX/public/income');
        } else {
            $this->redirect('/BudgetX/public/income');
        }
    }

    /**
     * Delete an income record (securely scoped to current user)
     */
    public function delete()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        $id = $_POST['id'] ?? null;

        if ($id) {
            $incomeModel = new Income();
            $incomeModel->delete($id, $_SESSION['user_id']);
        }

        $this->redirect('/BudgetX/public/income');
    }
}


