<?php 
require_once (__DIR__.'/../models/User.php');

class AdminController extends BaseController {
    private $UserModel ;
    public function __construct(){

        $this->UserModel = new User();
  
        
     }

   public function index() {
      
      if(!isset($_SESSION['user_loged_in_id'])){
         header("Location: /login ");
         exit;
      }
    $this->renderAdmin('index');
   }
   







 

}