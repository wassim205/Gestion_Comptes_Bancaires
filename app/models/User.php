<?php 
require_once(__DIR__.'/../config/db.php');
class User extends Db {

public function __construct()
{
    parent::__construct();
}


public function login($userData){
    
    try {
        $result = $this->conn->prepare("SELECT * FROM users WHERE email=?");
        $result->execute([$userData[0]]);
        $user = $result->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($userData[1], $user["password"])){
           return  $user ;
           
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


}