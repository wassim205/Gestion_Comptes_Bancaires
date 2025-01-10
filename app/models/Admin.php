<?php
require_once(__DIR__ . '/../config/db.php');
class Admin extends User
{

    public function __construct()
    {
        parent::__construct();
    }


    public function getUsers()
    {
        $query = "SELECT users.*, 
    GROUP_CONCAT(accounts.account_type SEPARATOR ', ') AS account_types, COUNT(accounts.id) as account_count FROM users 
    LEFT JOIN accounts ON users.id = accounts.user_id 
    WHERE users.role != 'admin' 
GROUP BY users.id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    public function getUserId($id)
    {
        $query = "SELECT users.*, 
    GROUP_CONCAT(accounts.account_type SEPARATOR ', ') AS account_types, COUNT(accounts.id) as account_count FROM users 
LEFT JOIN accounts ON users.id = accounts.user_id 
WHERE users.role != 'admin' AND users.id = ? GROUP BY users.id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        $users = $stmt->fetch(PDO::FETCH_ASSOC);
        return $users;
    }


    public function changeStatus($userId, $status)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE users SET status = ? WHERE id = ?");
            $stmt->execute([$status, $userId]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function deleteUser($userId)
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM users WHERE id = ?");
            $stmt->execute([$userId]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function AddUser($name, $email, $password, $accountType)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT));
            $stmt->execute();
            $userId = $this->conn->lastInsertId();

            $accountTypes = ($accountType === "both") ? ["courant", "epargne"] : [$accountType];

            foreach ($accountTypes as $type) {
                $stmt = $this->conn->prepare("INSERT INTO accounts (user_id, account_type) VALUES (:user_id, :account_type)");
                $stmt->bindParam(':user_id', $userId);
                $stmt->bindParam(':account_type', $type);
                $stmt->execute();
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateUser($id, $name, $email)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
            $stmt->execute([$name, $email, $id]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getUserAccounts($userIds)
    {
        $query = "SELECT account_type FROM accounts WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$userIds]);
        $userAccounts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $userAccounts ? $userAccounts : [];
    }
    public function getUserAccountsBalance($userIds)
    {
        $query = "SELECT balance FROM accounts WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$userIds]);
        $userAccounts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $userAccounts ? $userAccounts : [];
    }
}
