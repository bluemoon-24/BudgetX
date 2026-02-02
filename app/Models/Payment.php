<?php

namespace App\Models;

use App\Core\Database;

class Payment
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function add($userId, $stripeChargeId, $amount, $status)
    {
        $sql = "INSERT INTO payments (user_id, stripe_charge_id, amount, status) VALUES (:user_id, :stripe_id, :amount, :status)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':stripe_id', $stripeChargeId);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }

    public function getHistory($userId)
    {
        $sql = "SELECT * FROM payments WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
