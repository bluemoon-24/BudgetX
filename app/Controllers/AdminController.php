<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\ActivityLog;
use App\Models\Admin;

class AdminController extends Controller
{
    public function index()
    {
        // Enforce Admin Role
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            $this->redirect('/BudgetX/public/login');
        }

        $adminModel = new Admin();
        $logModel = new ActivityLog();

        $stats = $adminModel->getUserStats();
        $revenue = $adminModel->getTotalRevenue();
        $users = $adminModel->getAllUsers();
        $logs = $logModel->getAll();

        $this->view('admin/dashboard', [
            'stats' => $stats,
            'revenue' => $revenue,
            'users' => $users,
            'logs' => $logs
        ]);
    }

    public function updateUserStatus()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            $this->redirect('/BudgetX/public/login');
        }

        $userId = $_POST['user_id'];
        $status = $_POST['status'];

        $adminModel = new Admin();
        $adminModel->updateUserStatus($userId, $status);

        $this->redirect('/BudgetX/public/admin/dashboard');
    }

    public function updateUserRole()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            $this->redirect('/BudgetX/public/login');
        }

        $userId = $_POST['user_id'];
        $role = $_POST['role'];

        $adminModel = new Admin();
        $adminModel->updateUserRole($userId, $role);

        $this->redirect('/BudgetX/public/admin/dashboard');
    }
}
