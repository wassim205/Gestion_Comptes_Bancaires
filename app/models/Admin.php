<?php 
require_once(__DIR__.'/../config/db.php');
class Admin extends User {

public function __construct()
{
    parent::__construct();
}


public function getUsers(){
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


public function changeStatus($userId, $status) {
    try {
        $stmt = $this->conn->prepare("UPDATE users SET status = ? WHERE id = ?");
        $stmt->execute([$status, $userId]);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

}