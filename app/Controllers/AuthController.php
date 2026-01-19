<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Models\ActivityLog;

class AuthController extends Controller
{
    public function login()
    {
        $this->view('auth/login');
    }

    public function authenticate()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $userModel = new User();
        $user = $userModel->login($email, $password);

        if ($user) {
            if ($user['status'] !== 'active') {
                $this->view('auth/login', ['error' => 'Account is inactive or banned.']);
                return;
            }

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['currency'] = $user['currency'];

            $logger = new ActivityLog();
            $logger->log($user['id'], 'Login', 'User logged in successfully');

            if ($user['role'] === 'admin') {
                $this->redirect('/BudgetX/public/admin');
            } elseif ($user['role'] === 'premium') {
                $this->redirect('/BudgetX/public/user/dashboard_premium');
            } else {
                $this->redirect('/BudgetX/public/user/dashboard_basic');
            }
        } else {
            $this->view('auth/login', ['error' => 'Invalid credentials']);
        }
    }

    public function register()
    {
        $this->view('auth/register');
    }

    public function store()
    {
        $username = $_POST['username'];
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $currency = $_POST['currency'];

        $userModel = new User();
        if ($userModel->register($username, $full_name, $email, $password, $currency)) {
            $this->redirect('/BudgetX/public/login');
        } else {
            $this->view('auth/register', ['error' => 'Registration failed. Email or username might be taken.']);
        }
    }

    public function logout()
    {
        session_destroy();
        $this->redirect('/BudgetX/public/');
    }
}
