<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class SharedGoal
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function create($ownerId, $name, $targetAmount, $deadline)
    {
        $sql = "INSERT INTO shared_goals (owner_id, name, target_amount, deadline) VALUES (:owner_id, :name, :target_amount, :deadline)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':owner_id', $ownerId);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':target_amount', $targetAmount);
        $stmt->bindParam(':deadline', $deadline);

        if ($stmt->execute()) {
            // Add owner as a member automatically
            $goalId = $this->db->lastInsertId();
            $this->addMember($goalId, $ownerId);
            return $goalId;
        }
        return false;
    }

    public function addMember($sharedGoalId, $userId)
    {
        $sql = "INSERT INTO shared_goal_members (shared_goal_id, user_id) VALUES (:goal_id, :user_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':goal_id', $sharedGoalId);
        $stmt->bindParam(':user_id', $userId);
        return $stmt->execute();
    }

    public function getGoalsByUserId($userId)
    {
        $sql = "SELECT sg.*, u.username as owner_name 
                FROM shared_goals sg 
                JOIN shared_goal_members sgm ON sg.id = sgm.shared_goal_id 
                JOIN users u ON sg.owner_id = u.id
                WHERE sgm.user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM shared_goals WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addMemberByEmail($sharedGoalId, $email)
    {
        // Find user by email first
        $sql = "SELECT id FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return $this->addMember($sharedGoalId, $user['id']);
        }
        return false;
    }

    public function updateProgress($id, $userId, $amount)
    {
        $this->db->beginTransaction();
        try {
            // Update Shared Goal
            $goal = $this->getById($id);
            $newAmount = $goal['current_amount'] + $amount;

            $sql = "UPDATE shared_goals SET current_amount = :amount WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':amount', $newAmount);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Record Payment
            $sql = "INSERT INTO shared_goal_payments (shared_goal_id, user_id, amount, date) VALUES (:goal_id, :user_id, :amount, NOW())";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':goal_id', $id);
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':amount', $amount);
            $stmt->execute();

            $this->db->commit();
            return true;
        } catch (\Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function getContributors($id)
    {
        $sql = "SELECT u.username, u.full_name, SUM(sgp.amount) as total_contribution 
                FROM shared_goal_payments sgp 
                JOIN users u ON sgp.user_id = u.id 
                WHERE sgp.shared_goal_id = :id 
                GROUP BY sgp.user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getContributionHistory($id)
    {
        $sql = "SELECT u.username, sgp.amount, sgp.date 
                FROM shared_goal_payments sgp 
                JOIN users u ON sgp.user_id = u.id 
                WHERE sgp.shared_goal_id = :id 
                ORDER BY sgp.date ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
