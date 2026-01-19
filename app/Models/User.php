<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function register($username, $full_name, $email, $password, $currency = 'USD')
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, full_name, email, password, role, status, currency) VALUES (:username, :full_name, :email, :password, 'basic', 'active', :currency)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':full_name', $full_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hash);
        $stmt->bindParam(':currency', $currency);

        try {
            return $stmt->execute();
        } catch (\PDOException $e) {
            throw $e; // Throw for debugging
        }
    }

    public function login($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        } else {
            return false;
        }
    }

    public function getUserById($id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateRole($id, $role)
    {
        $sql = "UPDATE users SET role = :role WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
