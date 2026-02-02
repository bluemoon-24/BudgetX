<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Models\ActivityLog;

class AuthController extends Controller
{
    public function login()
    {
        $this->view('login');
    }

    public function authenticate()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $userModel = new User();
        $user = $userModel->login($email, $password);

        if ($user) {
            if ($user['status'] !== 'active') {
                $this->view('login', ['error' => 'Account is inactive or banned.']);
                return;
            }

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['currency'] = $user['currency'];
            $_SESSION['profile_pic'] = $user['profile_pic'];

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
            $this->view('login', ['error' => 'Invalid credentials']);
        }
    }

    public function register()
    {
        $this->view('register');
    }

    public function store()
    {
        $username = $_POST['username'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $full_name = trim($first_name . ' ' . $last_name);
        $email = $_POST['email'];
        $password = $_POST['password'];
        $currency = $_POST['currency'];

        $userModel = new User();
        if ($userModel->register($username, $full_name, $email, $password, $currency)) {
            $this->redirect('/BudgetX/public/login');
        } else {
            $this->view('register', ['error' => 'Registration failed. Email or username might be taken.']);
        }
    }

    public function logout()
    {
        session_destroy();
        $this->redirect('/BudgetX/public/');
    }
}


