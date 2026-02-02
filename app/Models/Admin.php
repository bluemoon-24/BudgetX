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

        // Simulated Trends for UI aesthetics (as seen in reference image)
        $stats['total_trend'] = '+12%';
        $stats['basic_trend'] = '+8%';
        $stats['premium_trend'] = '+23%';
        $stats['revenue_trend'] = '+18%';

        return $stats;
    }

    public function getRecentActivity($limit = 5)
    {
        $sql = "SELECT a.*, u.username, u.email 
                FROM activity_logs a 
                LEFT JOIN users u ON a.user_id = u.id 
                ORDER BY a.created_at DESC 
                LIMIT :limit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalRevenue()
    {
        // Current month's revenue from completed payments
        $sql = "SELECT SUM(amount) as total FROM payments 
                WHERE status = 'completed' 
                AND MONTH(created_at) = MONTH(CURRENT_DATE()) 
                AND YEAR(created_at) = YEAR(CURRENT_DATE())";
        $result = $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    public function getAllUsers($search = null)
    {
        if ($search) {
            $sql = "SELECT * FROM users 
                    WHERE username LIKE :search 
                    OR email LIKE :search 
                    ORDER BY created_at DESC";
            $stmt = $this->db->prepare($sql);
            $searchTerm = "%$search%";
            $stmt->bindParam(':search', $searchTerm);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
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
