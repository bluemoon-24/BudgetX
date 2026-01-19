<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\SharedGoal;
use App\Models\User;

class SharedGoalController extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        // Premium feature check could go here
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'basic') {
            // Redirect to upgrade page ideally, but for now just show index
        }

        $userId = $_SESSION['user_id'];
        $model = new SharedGoal();
        $goals = $model->getGoalsByUserId($userId);

        $this->view('shared_goals/index', ['goals' => $goals]);
    }

    public function create()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }
        $this->view('shared_goals/create');
    }

    public function store()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        $userId = $_SESSION['user_id'];
        $model = new SharedGoal();
        if ($model->create($userId, $_POST['name'], $_POST['target_amount'], $_POST['deadline'])) {
            $this->redirect('/BudgetX/public/shared_goals');
        } else {
            $this->view('shared_goals/create', ['error' => 'Failed to create shared goal']);
        }
    }

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
        $contributors = $model->getContributors($id);
        $history = $model->getContributionHistory($id);

        $this->view('shared_goals/view', [
            'goal' => $goal,
            'contributors' => $contributors,
            'history' => $history
        ]);
    }

    public function add_member()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }
        $id = $_GET['id'] ?? null;
        $this->view('shared_goals/add_member', ['id' => $id]);
    }

    public function store_member()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }
        $id = $_POST['id'];
        $email = $_POST['email'];

        $model = new SharedGoal();
        if ($model->addMemberByEmail($id, $email)) {
            $this->redirect('/BudgetX/public/shared_goals/view?id=' . $id);
        } else {
            // Error handling
            $this->redirect('/BudgetX/public/shared_goals/view?id=' . $id);
        }
    }

    public function add_funds()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }
        $id = $_GET['id'] ?? null;
        $model = new SharedGoal();
        $goal = $model->getById($id);
        $this->view('shared_goals/add_funds', ['goal' => $goal]);
    }

    public function store_funds()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/BudgetX/public/login');
        }

        $userId = $_SESSION['user_id'];
        $id = $_POST['id'];
        $amount = $_POST['amount'];

        $model = new SharedGoal();
        if ($model->updateProgress($id, $userId, $amount)) {
            $this->redirect('/BudgetX/public/shared_goals/view?id=' . $id);
        } else {
            $this->redirect('/BudgetX/public/shared_goals/view?id=' . $id);
        }
    }
}
