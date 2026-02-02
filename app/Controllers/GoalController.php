<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Goal;
use App\Models\SharedGoal;

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

        // Get pending shared goal invitations
        $sharedGoalModel = new SharedGoal();
        $invitations = $sharedGoalModel->getPendingInvitations($userId);

        // Feature: Collaborative Goal Visibility
        // Ensures that goals the user has joined (even basic users) are visible
        $sharedGoals = $sharedGoalModel->getGoalsByUserId($userId);

        $this->view('goals', [
            'goals' => $goals,
            'invitations' => $invitations,
            'sharedGoals' => $sharedGoals
        ]);
    }

    public function create()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }
        $this->view('goals_create');
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
            $this->view('goals_create', ['error' => 'Target amount must be positive']);
            return;
        }

        if (strtotime($deadline) < time()) {
            $this->view('goals_create', ['error' => 'Deadline must be in the future']);
            return;
        }

        $goalModel = new Goal();
        if ($goalModel->add($userId, $name, $targetAmount, $deadline)) {
            $this->redirect('/BudgetX/public/goals');
        } else {
            // Handle error
            $this->view('goals_create', ['error' => 'Failed to create goal']);
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

        $this->view('goals_add_funds', ['goal' => $goal]);
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

    public function acceptInvitation()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        $userId = $_SESSION['user_id'];
        $invitationId = $_POST['invitation_id'] ?? null;

        if ($invitationId) {
            $sharedGoalModel = new SharedGoal();
            $sharedGoalModel->acceptInvitation($invitationId, $userId);
        }

        $this->redirect('/BudgetX/public/goals');
    }

    public function declineInvitation()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        $userId = $_SESSION['user_id'];
        $invitationId = $_POST['invitation_id'] ?? null;

        if ($invitationId) {
            $sharedGoalModel = new SharedGoal();
            $sharedGoalModel->declineInvitation($invitationId, $userId);
        }

        $this->redirect('/BudgetX/public/goals');
    }

    public function edit()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect('/BudgetX/public/goals');
        }

        $userId = $_SESSION['user_id'];
        $goalModel = new Goal();
        $goal = $goalModel->getById($id);

        if (!$goal || $goal['user_id'] != $userId) {
            $this->redirect('/BudgetX/public/goals');
        }

        $this->view('goals_edit', ['goal' => $goal]);
    }

    public function update()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        $userId = $_SESSION['user_id'];
        $id = $_POST['id'];
        $name = $_POST['name'];
        $targetAmount = $_POST['target_amount'];
        $deadline = $_POST['deadline'];

        $goalModel = new Goal();
        if ($goalModel->update($id, $userId, $name, $targetAmount, $deadline)) {
            $this->redirect('/BudgetX/public/goals');
        } else {
            $goal = $goalModel->getById($id);
            $this->view('goals_edit', ['goal' => $goal, 'error' => 'Failed to update goal']);
        }
    }

    public function delete()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        $userId = $_SESSION['user_id'];
        $id = $_POST['id'];

        $goalModel = new Goal();
        $goalModel->delete($id, $userId);
        $this->redirect('/BudgetX/public/goals');
    }
}


