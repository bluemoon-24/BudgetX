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

    public function add($userId, $stripePaymentId, $amount, $status)
    {
        $sql = "INSERT INTO payments (user_id, stripe_payment_id, amount, status) VALUES (:user_id, :stripe_id, :amount, :status)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':stripe_id', $stripePaymentId);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }
}
