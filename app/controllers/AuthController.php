<?php 
require_once (__DIR__.'/../models/User.php');
class AuthController extends BaseController {
 
   protected $UserModel ;
   public function __construct(){

      $this->UserModel = new User();

      
   }


   public function showLogin() {
      
    $this->render('auth/login');
   }

   public function handleLogin(){


      if ($_SERVER["REQUEST_METHOD"] == "POST"){
          if (isset($_POST['login'])) {
              $email = $_POST['email'];
              $password = $_POST['password'];
              $userData = [$email,$password];


              $user = $this->UserModel->login($userData);

              if($user){

                $role = $user['role'] ;
                $_SESSION['user_loged_in_id'] = $user["id"];
                $_SESSION['user_loged_in_role'] = $role;
                $_SESSION['user_loged_in_name'] = $user['name'];
                if ($user && $role == 'admin') {
                    header('Location: /Admin');
                } else {
                    header('Location: /Client');
                }
            
              }
            else{
                $this->render('auth/login', ['error' => 'Invalid email or password']);
            }
  



             
          }
      }
 

   }

   public function logout() {

         if (isset($_SESSION['user_loged_in_id']) && isset($_SESSION['user_loged_in_role'])) {
             unset($_SESSION['user_loged_in_id']);
             unset($_SESSION['user_loged_in_role']);
             session_destroy();
            
             header("Location: /login");
             exit;
         }
   }



}