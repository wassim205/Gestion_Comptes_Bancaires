<?php
require_once(__DIR__ . '/../models/User.php');
require_once(__DIR__ . "/../models/Admin.php");

class AdminController extends BaseController
{
    private $AdminModel;
    public function __construct()
    {

        $this->AdminModel = new Admin();
    }

    public function dashboard()
    {

        if (!isset($_SESSION['user_loged_in_id'])) {
            header("Location: /login ");
            exit;
        }
        $this->renderAdmin('index');
    }

    public function compte()
    {
        // Your code here
        return $this->renderAdmin('compte');
    }

    public function transactions()
    {
        // Your code here
        return $this->renderAdmin('transactions');
    }

    public function getAllUsers()
    {
        $users = $this->AdminModel->getUsers();
        $this->renderAdmin('clients', ['users' => $users]);
    }


    public function changeStatus($userId, $status)
    {
        $this->AdminModel->changeStatus($userId, $status);
        header("Location: /clients");
        exit;
    }
    public function DeleteUser($userId)
    {
        $this->AdminModel->deleteUser($userId);
        header("Location: /clients");
        exit;
    }

    public function editUser($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $this->AdminModel->updateUser($id, $name, $email);
            header("Location: /clients");
            exit;
        }
        $userAccounts = $this->AdminModel->getUserAccounts($id);

        $user = $this->AdminModel->getUserId($id);
        $this->renderAdmin('editUser', ['user' => $user, 'id' => $id, 'userAccounts' => $userAccounts]);
    }

    public function editUserAccount(){
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = (int)$_POST['UserId'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $this->AdminModel->updateUser($id, $name, $email);
            header("Location: /clients");
            exit;
        }
    }
    public function AddNewUser()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['SecondName'] . ' ' . $_POST['FirstName'];
            $email = $_POST['Email'];
            $password = $_POST['password'];
            $accountType = $_POST['account_type'];
            $this->AdminModel->AddUser($name, $email, $password, $accountType);
            header("Location: /clients");
            exit;
        }
    }

}
