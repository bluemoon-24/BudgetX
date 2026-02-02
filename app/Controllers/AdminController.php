<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\ActivityLog;
use App\Models\Admin;

class AdminController extends Controller
{
    /**
     * Admin Dashboard Index
     * Aggregates platform-wide statistics for oversight.
     */
    public function index()
    {
        // Enforce Admin Role
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            $this->redirect('/BudgetX/public/login');
        }

        $adminModel = new Admin();
        $logModel = new ActivityLog();

        $search = $_GET['search'] ?? null;

        $stats = $adminModel->getUserStats();
        $revenue = $adminModel->getTotalRevenue();
        $users = $adminModel->getAllUsers($search);
        $activity = $adminModel->getRecentActivity(5);

        $this->view('admin_dashboard', [
            'stats' => $stats,
            'revenue' => $revenue,
            'users' => $users,
            'activity' => $activity,
            'search' => $search
        ]);
    }

    /**
     * Update User Status
     * Allows admins to active, deactivate, or ban accounts for safety.
     */
    public function updateUserStatus()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            $this->redirect('/BudgetX/public/login');
        }

        $userId = $_POST['user_id'];
        $status = $_POST['status'];

        $adminModel = new Admin();
        $adminModel->updateUserStatus($userId, $status);

        $this->redirect('/BudgetX/public/admin');
    }

    /**
     * Update User Role
     * Feature: Privilege Management
     * Enables granular control over user roles (Basic, Premium, Admin).
     */
    public function updateUserRole()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            $this->redirect('/BudgetX/public/login');
        }

        $userId = $_POST['user_id'];
        $role = $_POST['role'];

        $adminModel = new Admin();
        $adminModel->updateUserRole($userId, $role);

        $this->redirect('/BudgetX/public/admin');
    }
}


