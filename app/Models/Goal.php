<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Goal
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllByUserId($userId)
    {
        $sql = "SELECT * FROM goals WHERE user_id = :user_id ORDER BY deadline ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add($userId, $name, $targetAmount, $deadline)
    {
        $sql = "INSERT INTO goals (user_id, name, target_amount, deadline) VALUES (:user_id, :name, :target_amount, :deadline)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':target_amount', $targetAmount);
        $stmt->bindParam(':deadline', $deadline);
        return $stmt->execute();
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM goals WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProgress($id, $userId, $amount)
    {
        $this->db->beginTransaction();
        try {
            // Update Goal
            $goal = $this->getById($id);
            $newAmount = $goal['current_amount'] + $amount;

            // Check status
            $status = $goal['status'];
            if ($newAmount >= $goal['target_amount']) {
                $status = 'completed';
            }

            $sql = "UPDATE goals SET current_amount = :amount, status = :status WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':amount', $newAmount);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Record Payment in goal_payments
            $sql = "INSERT INTO goal_payments (goal_id, user_id, amount, date) VALUES (:goal_id, :user_id, :amount, NOW())";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':goal_id', $id);
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':amount', $amount);
            $stmt->execute();

            // Deduct from Balance by adding an Expense record
            $expenseSql = "INSERT INTO expenses (user_id, amount, category, label, date, description) 
                          VALUES (:user_id, :amount, 'Goal Contribution', :label, CURDATE(), :description)";
            $stmt = $this->db->prepare($expenseSql);
            $goalName = $goal['name'];
            $label = "Goal: $goalName";
            $description = "Automatic deduction for goal funding";
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':amount', $amount);
            $stmt->bindParam(':label', $label);
            $stmt->bindParam(':description', $description);
            $stmt->execute();

            $this->db->commit();
            return true;
        } catch (\Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
    public function update($id, $userId, $name, $targetAmount, $deadline)
    {
        $sql = "UPDATE goals SET name = :name, target_amount = :target_amount, deadline = :deadline WHERE id = :id AND user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':target_amount', $targetAmount);
        $stmt->bindParam(':deadline', $deadline);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':user_id', $userId);
        return $stmt->execute();
    }

    public function delete($id, $userId)
    {
        $this->db->beginTransaction();
        try {
            // Delete payments first
            $sql = "DELETE FROM goal_payments WHERE goal_id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Delete the goal
            $sql = "DELETE FROM goals WHERE id = :id AND user_id = :user_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();

            $this->db->commit();
            return true;
        } catch (\Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
}
