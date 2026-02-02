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

    public function removeMember($sharedGoalId, $userId)
    {
        $sql = "DELETE FROM shared_goal_members WHERE shared_goal_id = :goal_id AND user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':goal_id', $sharedGoalId);
        $stmt->bindParam(':user_id', $userId);
        return $stmt->execute();
    }

    public function getGoalsByUserId($userId)
    {
        $sql = "SELECT sg.*, COALESCE(NULLIF(u.full_name, ''), u.username) as owner_name 
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
            // Create invitation instead of adding directly
            return $this->createInvitation($sharedGoalId, $_SESSION['user_id'], $email, $user['id']);
        }
        return false;
    }

    public function createInvitation($goalId, $inviterId, $email, $inviteeId = null)
    {
        $sql = "INSERT INTO shared_goal_invitations (shared_goal_id, inviter_id, invitee_email, invitee_id) 
                VALUES (:goal_id, :inviter_id, :email, :invitee_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':goal_id', $goalId);
        $stmt->bindParam(':inviter_id', $inviterId);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':invitee_id', $inviteeId);
        return $stmt->execute();
    }

    public function getPendingInvitations($userId)
    {
        $sql = "SELECT sgi.*, sg.name as goal_name, COALESCE(NULLIF(u.full_name, ''), u.username) as inviter_name 
                FROM shared_goal_invitations sgi
                JOIN shared_goals sg ON sgi.shared_goal_id = sg.id
                JOIN users u ON sgi.inviter_id = u.id
                WHERE sgi.invitee_id = :user_id AND sgi.status = 'pending'";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function acceptInvitation($invitationId, $userId)
    {
        $this->db->beginTransaction();
        try {
            // Get invitation details
            $sql = "SELECT * FROM shared_goal_invitations WHERE id = :id AND invitee_id = :user_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $invitationId);
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();
            $invitation = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$invitation) {
                return false;
            }

            // Add user as member
            $this->addMember($invitation['shared_goal_id'], $userId);

            // Update invitation status
            $sql = "UPDATE shared_goal_invitations SET status = 'accepted', responded_at = NOW() WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $invitationId);
            $stmt->execute();

            $this->db->commit();
            return true;
        } catch (\Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function declineInvitation($invitationId, $userId)
    {
        $sql = "UPDATE shared_goal_invitations SET status = 'declined', responded_at = NOW() 
                WHERE id = :id AND invitee_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $invitationId);
        $stmt->bindParam(':user_id', $userId);
        return $stmt->execute();
    }

    public function getPendingInvitationsByGoal($goalId)
    {
        $sql = "SELECT * FROM shared_goal_invitations 
                WHERE shared_goal_id = :goal_id AND status = 'pending'";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':goal_id', $goalId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

            // Record Payment in shared_goal_payments
            $sql = "INSERT INTO shared_goal_payments (shared_goal_id, user_id, amount, date) VALUES (:goal_id, :user_id, :amount, NOW())";
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
            $label = "Shared Goal: $goalName";
            $description = "Automatic deduction for shared goal funding";
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

    public function getContributors($id)
    {
        $sql = "SELECT u.id, u.username, COALESCE(NULLIF(u.full_name, ''), u.username) as full_name, SUM(sgp.amount) as total_contribution 
                FROM shared_goal_payments sgp 
                JOIN users u ON sgp.user_id = u.id 
                WHERE sgp.shared_goal_id = :id 
                GROUP BY sgp.user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMembers($id)
    {
        $sql = "SELECT u.id, u.username, COALESCE(NULLIF(u.full_name, ''), u.username) as full_name, u.role
                FROM users u
                JOIN shared_goal_members sgm ON u.id = sgm.user_id
                WHERE sgm.shared_goal_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getContributionHistory($id)
    {
        $sql = "SELECT COALESCE(NULLIF(u.full_name, ''), u.username) as username, sgp.amount, sgp.date 
                FROM shared_goal_payments sgp 
                JOIN users u ON sgp.user_id = u.id 
                WHERE sgp.shared_goal_id = :id 
                ORDER BY sgp.date ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function update($id, $ownerId, $name, $targetAmount, $deadline)
    {
        $sql = "UPDATE shared_goals SET name = :name, target_amount = :target_amount, deadline = :deadline WHERE id = :id AND owner_id = :owner_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':target_amount', $targetAmount);
        $stmt->bindParam(':deadline', $deadline);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':owner_id', $ownerId);
        return $stmt->execute();
    }

    public function delete($id, $ownerId)
    {
        $this->db->beginTransaction();
        try {
            // Delete invitations
            $sql = "DELETE FROM shared_goal_invitations WHERE shared_goal_id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Delete members
            $sql = "DELETE FROM shared_goal_members WHERE shared_goal_id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Delete payments
            $sql = "DELETE FROM shared_goal_payments WHERE shared_goal_id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Delete the goal itself
            $sql = "DELETE FROM shared_goals WHERE id = :id AND owner_id = :owner_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':owner_id', $ownerId);
            $stmt->execute();

            $this->db->commit();
            return true;
        } catch (\Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
}
