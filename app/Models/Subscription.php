<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Subscription
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getStatus($userId)
    {
        $sql = "SELECT id, username, subscription_status, subscription_start_date, subscription_end_date, role 
                FROM users WHERE id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateSubscription($userId, $status, $startDate = null, $endDate = null)
    {
        $sql = "UPDATE users SET subscription_status = :status, 
                subscription_start_date = :start_date, 
                subscription_end_date = :end_date";

        if ($status === 'ACTIVE') {
            $sql .= ", role = 'premium'";
        } else {
            $sql .= ", role = 'basic'";
        }

        $sql .= " WHERE id = :user_id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':start_date', $startDate);
        $stmt->bindParam(':end_date', $endDate);
        $stmt->bindParam(':user_id', $userId);
        return $stmt->execute();
    }

    public function cancel($userId)
    {
        $sql = "UPDATE users SET subscription_status = 'CANCELLED' WHERE id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        return $stmt->execute();
    }

    public function logWebhook($eventType, $payload)
    {
        $sql = "INSERT INTO webhooks_log (event_type, payload) VALUES (:type, :payload)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':type', $eventType);
        $stmt->bindParam(':payload', $payload);
        return $stmt->execute();
    }
}
