<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Expense
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllByUserId($userId, $category = null, $date = null)
    {
        $sql = "SELECT * FROM expenses WHERE user_id = :user_id";
        $params = [':user_id' => $userId];

        if ($category) {
            $sql .= " AND category = :category";
            $params[':category'] = $category;
        }

        if ($date) {
            $sql .= " AND date = :date";
            $params[':date'] = $date;
        }

        $sql .= " ORDER BY date DESC";

        $stmt = $this->db->prepare($sql);
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add($userId, $amount, $category, $label, $date, $description = '')
    {
        $sql = "INSERT INTO expenses (user_id, amount, category, label, date, description) VALUES (:user_id, :amount, :category, :label, :date, :description)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':label', $label);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':description', $description);
        return $stmt->execute();
    }

    public function getById($id, $userId)
    {
        $sql = "SELECT * FROM expenses WHERE id = :id AND user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $userId, $amount, $category, $label, $date, $description = '')
    {
        $sql = "UPDATE expenses SET amount = :amount, category = :category, label = :label, date = :date, description = :description WHERE id = :id AND user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':label', $label);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':user_id', $userId);
        return $stmt->execute();
    }

    public function delete($id, $userId)
    {
        $sql = "DELETE FROM expenses WHERE id = :id AND user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':user_id', $userId);
        return $stmt->execute();
    }

    public function getTotalByUserId($userId)
    {
        $sql = "SELECT SUM(amount) as total FROM expenses WHERE user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    public function getExpensesByCategory($userId)
    {
        $sql = "SELECT category, SUM(amount) as total FROM expenses WHERE user_id = :user_id GROUP BY category";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMonthlyExpenses($userId)
    {
        $sql = "SELECT DATE_FORMAT(date, '%Y-%m') as month, SUM(amount) as total 
                FROM expenses 
                WHERE user_id = :user_id 
                GROUP BY month 
                ORDER BY month DESC 
                LIMIT 12";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSpendingTrends($userId)
    {
        // Get last 6 months data for charts
        $sql = "SELECT DATE_FORMAT(date, '%Y-%m') as month, SUM(amount) as total 
                FROM expenses 
                WHERE user_id = :user_id 
                GROUP BY month 
                ORDER BY month ASC 
                LIMIT 6";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalByMonth($userId, $month)
    {
        $sql = "SELECT SUM(amount) as total 
                FROM expenses 
                WHERE user_id = :user_id AND DATE_FORMAT(date, '%Y-%m') = :month";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':month', $month);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }
}
