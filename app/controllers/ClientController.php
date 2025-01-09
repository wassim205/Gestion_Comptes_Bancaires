<?php
require_once (__DIR__.'/../models/Client.php');
class ClientController extends BaseController {
    private $ClientModel ;
    public function __construct(){

        $this->ClientModel = new Client();
  
        
     }
    public function index() {
        $this->renderClient('index');
    }
    public function profeil() {
        $userId = $_SESSION['user_loged_in_id'];

        $userInfo = $this->ClientModel->getClient($userId);

        $securityError = isset($_GET['securityError']) ? $_GET['securityError'] : null;
        $securitySuccess = isset($_GET['securitySuccess']) ? $_GET['securitySuccess'] : null;
        $profileSuccess = isset($_GET['profileSuccess']) ? $_GET['profileSuccess'] : null;
        $profileError = isset($_GET['profileError']) ? $_GET['profileError'] : null;
        if ($securityError) {
            $this->renderClient('profeil', ["userInfo" => $userInfo, "securityError" => $securityError]);
        }
        else if ($securitySuccess) {
            $this->renderClient('profeil', ["userInfo" => $userInfo, "securitySuccess" => $securitySuccess]);
        }
        else if ($profileSuccess) {
            $this->renderClient('profeil', ["userInfo" => $userInfo, "profileSuccess" => $profileSuccess]);
        }
        else if ($profileError) {
            $this->renderClient('profeil', ["userInfo" => $userInfo, "profileError" => $profileError]);
        }
        else {
            $this->renderClient('profeil', ["userInfo" => $userInfo]);
        }
    }

    public function mcompte(){
        $userId = $_SESSION['user_loged_in_id'];
        $account = $this->ClientModel->getAccountDetails($userId);
        $this->renderClient('compte', ["account" => $account]);
        // $this->renderClient('compte');
    }

    public function modifier_password(){
        $userId = $_SESSION['user_loged_in_id'];
        $user = $this->ClientModel->getClient($userId);
        if (empty($_POST['currentPassword']) || empty($_POST['newPassword']) || empty($_POST['confirmPassword'])) {
            $error = "Erreur : Tous les champs sont requis.";
            header("Location: /profeil?securityError=$error");
            exit ;
        }

        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];

      
        if (!password_verify($currentPassword, $user["password"])) {
            $error = "Erreur : Mot de passe actuel incorrect.";
            header("Location: /profeil?securityError=$error");
            exit;
        }

        if ($newPassword !== $confirmPassword) {
            $error = "Erreur : Les mots de passe ne correspondent pas.";
            header("Location: /profeil?securityError=$error");
            exit;
        }

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $result = $this->ClientModel->modifierPass($userId, $hashedPassword);

        if ($result) {
            $success = "Mot de passe modifié avec succès.";
            header("Location: /profeil?securitySuccess=$success");

            exit ;
        } else {
                return "Erreur : Mot de passe n'a pas été modifié.";
        }


    }

    public function modifier_profil(){
        $userId = $_SESSION['user_loged_in_id'];
        if (empty(trim($_POST['name'])) || empty(trim($_POST['email']))) {
            $error = "Erreur : Tous les champs sont requis.";
            header("Location: /profeil?profileError=$error");
            exit ;
        }
        $name = $_POST['name'];
        $email = $_POST['email'];
        $result = $this->ClientModel->modifierProfil($userId, $name, $email);
        if ($result) {
            $success = "Profil modifié avec succès.";
            header("Location: /profeil?profileSuccess=$success");
            exit ;
        }
        else {
            $error = "Profil modifié avec succès.";
            header("Location: /profeil?profileError=$error");
        }
    }


}