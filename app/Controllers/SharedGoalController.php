<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\SharedGoal;
use App\Models\User;

class SharedGoalController extends Controller
{
    /**
     * Controller constructor for initializing sessions and authentication
     */
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        // Allow basic users to view shared goals they're invited to
    }

    /**
     * Display all shared goals for the current user (Premium Feature)
     */
    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        // Basic users can only view shared goals they have been invited to
        // They are allowed to see the index to check for participation status

        $userId = $_SESSION['user_id'];
        $model = new SharedGoal();
        $goals = $model->getGoalsByUserId($userId);

        $this->view('shared_goals', ['goals' => $goals]);
    }

    /**
     * Show creation form for a new shared goal
     */
    public function create()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }
        $this->view('shared_goals_create');
    }

    /**
     * Store a new shared goal and initialize it
     */
    public function store()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        $userId = $_SESSION['user_id'];
        $model = new SharedGoal();

        // Feature: Shared Wealth Creation
        // Owners can create space for collaborative financial targets
        if ($model->create($userId, $_POST['name'], $_POST['target_amount'], $_POST['deadline'])) {
            $this->redirect('/BudgetX/public/shared_goals');
        } else {
            $this->view('shared_goals_create', ['error' => 'Failed to create shared goal']);
        }
    }

    /**
     * View detailed status of a shared goal including contributors and growth chart
     */
    public function viewGoal()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect('/BudgetX/public/shared_goals');
        }

        $model = new SharedGoal();
        $goal = $model->getById($id);

        // Feature: Collective Growth Analytics
        // Fetches individual member contributions to display on the progress chart
        $contributors = $model->getContributors($id);
        $members = $model->getMembers($id);
        $history = $model->getContributionHistory($id);
        $pending_invitations = $model->getPendingInvitationsByGoal($id);

        $this->view('shared_goals_view', [
            'goal' => $goal,
            'contributors' => $contributors,
            'members' => $members,
            'history' => $history,
            'pending_invitations' => $pending_invitations
        ]);
    }

    /**
     * Show form to invite a member to a goal
     */
    public function add_member()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        // Basic users cannot invite others
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'basic') {
            $this->redirect('/BudgetX/public/shared_goals');
        }

        $id = $_GET['id'] ?? null;
        $this->view('shared_goals_add_member', ['id' => $id]);
    }

    /**
     * Process member invitation via email
     */
    public function store_member()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        // Basic users cannot invite others
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'basic') {
            $this->redirect('/BudgetX/public/shared_goals');
        }

        $id = $_POST['id'];
        $email = $_POST['email'];

        $model = new SharedGoal();

        // Feature: Network Effects
        // Links users together by email to collaborate on financial targets
        if ($model->addMemberByEmail($id, $email)) {
            $this->redirect('/BudgetX/public/shared_goals/view?id=' . $id);
        } else {
            $this->redirect('/BudgetX/public/shared_goals/view?id=' . $id);
        }
    }

    /**
     * Show form to contribute funds to a shared goal
     */
    public function add_funds()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }
        $id = $_GET['id'] ?? null;
        $model = new SharedGoal();
        $goal = $model->getById($id);
        $this->view('shared_goals_add_funds', ['goal' => $goal]);
    }

    /**
     * Process fund contribution (Shared Goal Progress)
     */
    public function store_funds()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        $userId = $_SESSION['user_id'];
        $id = $_POST['id'];
        $amount = $_POST['amount'];

        $model = new SharedGoal();

        // Feature: Milestone Velocity
        // Progressively updates the collective target based on individual member inputs
        if ($model->updateProgress($id, $userId, $amount)) {
            $this->redirect('/BudgetX/public/shared_goals/view?id=' . $id);
        } else {
            $this->redirect('/BudgetX/public/shared_goals/view?id=' . $id);
        }
    }
    public function edit()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect('/BudgetX/public/shared_goals');
        }

        $userId = $_SESSION['user_id'];
        $model = new SharedGoal();
        $goal = $model->getById($id);

        if (!$goal || $goal['owner_id'] != $userId) {
            // Only owner can edit
            $this->redirect('/BudgetX/public/shared_goals');
        }

        $this->view('shared_goals_edit', ['goal' => $goal]);
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

        $model = new SharedGoal();
        $goal = $model->getById($id);

        if (!$goal || $goal['owner_id'] != $userId) {
            $this->redirect('/BudgetX/public/shared_goals');
        }

        if ($model->update($id, $userId, $name, $targetAmount, $deadline)) {
            $this->redirect('/BudgetX/public/shared_goals/view?id=' . $id);
        } else {
            $this->view('shared_goals_edit', ['goal' => $goal, 'error' => 'Failed to update goal']);
        }
    }

    public function delete()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        $userId = $_SESSION['user_id'];
        $id = $_POST['id'];

        $model = new SharedGoal();
        $goal = $model->getById($id);

        if (!$goal || $goal['owner_id'] != $userId) {
            $this->redirect('/BudgetX/public/shared_goals');
        }

        $model->delete($id, $userId);
        $this->redirect('/BudgetX/public/shared_goals');
    }

    public function leave()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        $userId = $_SESSION['user_id'];
        $id = $_POST['id'];

        $model = new SharedGoal();
        $goal = $model->getById($id);

        if (!$goal) {
            $this->redirect('/BudgetX/public/shared_goals');
        }

        // Owners cannot "leave", they must delete or transfer
        if ($goal['owner_id'] == $userId) {
            $this->redirect('/BudgetX/public/shared_goals');
        }

        $model->removeMember($id, $userId);
        $this->redirect('/BudgetX/public/shared_goals');
    }
}


