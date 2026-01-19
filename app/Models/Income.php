<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Income
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllByUserId($userId)
    {
        $sql = "SELECT * FROM income WHERE user_id = :user_id ORDER BY date DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add($userId, $amount, $source, $date)
    {
        $sql = "INSERT INTO income (user_id, amount, source, date) VALUES (:user_id, :amount, :source, :date)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':source', $source);
        $stmt->bindParam(':date', $date);
        return $stmt->execute();
    }

    public function getById($id, $userId)
    {
        $sql = "SELECT * FROM income WHERE id = :id AND user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $userId, $amount, $source, $date)
    {
        $sql = "UPDATE income SET amount = :amount, source = :source, date = :date WHERE id = :id AND user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':source', $source);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':user_id', $userId);
        return $stmt->execute();
    }

    public function delete($id, $userId)
    {
        $sql = "DELETE FROM income WHERE id = :id AND user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':user_id', $userId);
        return $stmt->execute();
    }

    public function getTotalByUserId($userId)
    {
        $sql = "SELECT SUM(amount) as total FROM income WHERE user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }
}
