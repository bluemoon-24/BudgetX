<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Admin
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getUserStats()
    {
        $stats = [];

        // Total Users
        $sql = "SELECT COUNT(*) as count FROM users";
        $stats['total'] = $this->db->query($sql)->fetch(PDO::FETCH_ASSOC)['count'];

        // Free (Basic) Users
        $sql = "SELECT COUNT(*) as count FROM users WHERE role = 'basic'";
        $stats['basic'] = $this->db->query($sql)->fetch(PDO::FETCH_ASSOC)['count'];

        // Premium Users
        $sql = "SELECT COUNT(*) as count FROM users WHERE role = 'premium'";
        $stats['premium'] = $this->db->query($sql)->fetch(PDO::FETCH_ASSOC)['count'];

        return $stats;
    }

    public function getTotalRevenue()
    {
        $sql = "SELECT SUM(amount) as total FROM payments WHERE status = 'completed'";
        $result = $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    public function getAllUsers()
    {
        $sql = "SELECT * FROM users ORDER BY created_at DESC";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateUserStatus($userId, $status)
    {
        $sql = "UPDATE users SET status = :status WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $userId);
        return $stmt->execute();
    }

    public function updateUserRole($userId, $role)
    {
        $sql = "UPDATE users SET role = :role WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':id', $userId);
        return $stmt->execute();
    }
}
