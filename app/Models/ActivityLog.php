<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class ActivityLog
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function log($userId, $action, $details = null)
    {
        $sql = "INSERT INTO activity_logs (user_id, action, details, ip_address) VALUES (:user_id, :action, :details, :ip)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':action', $action);
        $stmt->bindParam(':details', $details);
        $ip = $_SERVER['REMOTE_ADDR'] ?? null;
        $stmt->bindParam(':ip', $ip);
        return $stmt->execute();
    }

    public function getAll()
    {
        $sql = "SELECT a.*, u.username FROM activity_logs a LEFT JOIN users u ON a.user_id = u.id ORDER BY created_at DESC";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
