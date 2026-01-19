<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Goal;

class GoalController extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        $userId = $_SESSION['user_id'];
        $goalModel = new Goal();
        $goals = $goalModel->getAllByUserId($userId);

        $this->view('goals/index', ['goals' => $goals]);
    }

    public function create()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }
        $this->view('goals/create');
    }

    public function store()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        $userId = $_SESSION['user_id'];
        $name = $_POST['name'];
        $targetAmount = $_POST['target_amount'];
        $deadline = $_POST['deadline'];

        if ($targetAmount <= 0) {
            $this->view('goals/create', ['error' => 'Target amount must be positive']);
            return;
        }

        if (strtotime($deadline) < time()) {
            $this->view('goals/create', ['error' => 'Deadline must be in the future']);
            return;
        }

        $goalModel = new Goal();
        if ($goalModel->add($userId, $name, $targetAmount, $deadline)) {
            $this->redirect('/BudgetX/public/goals');
        } else {
            // Handle error
            $this->view('goals/create', ['error' => 'Failed to create goal']);
        }
    }
    public function add_funds()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect('/BudgetX/public/goals');
        }

        $goalModel = new Goal();
        $goal = $goalModel->getById($id);

        $this->view('goals/add_funds', ['goal' => $goal]);
    }

    public function store_funds()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        $userId = $_SESSION['user_id'];
        $id = $_POST['id'];
        $amount = $_POST['amount'];

        $goalModel = new Goal();
        if ($goalModel->updateProgress($id, $userId, $amount)) {
            $this->redirect('/BudgetX/public/goals');
        } else {
            $this->redirect('/BudgetX/public/goals');
        }
    }
}
