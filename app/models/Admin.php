<?php 
require_once(__DIR__.'/../config/db.php');
class Admin extends User {

public function __construct()
{
    parent::__construct();
}


public function getUsers(){
    $query = "SELECT * FROM users";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}


}