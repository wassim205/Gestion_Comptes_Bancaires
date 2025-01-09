<?php 
require_once(__DIR__.'/../config/db.php');
class Client extends Db {

public function __construct()
{
    parent::__construct();
}


public function getClient($userId){
    
    try {
        $result = $this->conn->prepare("SELECT * FROM users WHERE id=?");
        $result->execute([$userId]);
        $user = $result->fetch(PDO::FETCH_ASSOC);
        if($user){
           return  $user ;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

public function modifierPass($userId , $newPassword) {
    try {
        $stmt = $this->conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->execute([$newPassword, $userId]);
        return true;
    }
    catch (Exception $e) {
        
        return "Erreur : " . $e->getMessage();
    }
}

public function modifierProfil( $userId , $newName , $newEmail) {
    try {
        $stmt = $this->conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
        $stmt->execute([$newName, $newEmail, $userId]);
        return true;
    }
    catch (Exception $e) {
        return "Erreur : " . $e->getMessage();
    }
}


public function getAccountDetails($userId){

        $stmt = $this->conn->prepare("SELECT balance , id , created_at FROM accounts WHERE user_id = ? and account_type = 'courant' ");
        $stmt->execute([$userId]);
        $accountCourant = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = $this->conn->prepare("SELECT balance , id , created_at FROM accounts WHERE user_id = ? and account_type = 'epargne' ");
        $stmt->execute([$userId]);
        $accountEpargne = $stmt->fetch(PDO::FETCH_ASSOC);
        $account = [];
        if($accountCourant){
            $account['courant'] = $accountCourant;
        }
        if($accountEpargne){
            $account['epargne'] = $accountEpargne;
        }
        return $account;



}


}