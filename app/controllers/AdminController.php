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

    public function index()
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
    public function dashboard()
    {
        // Your code here
        return $this->renderAdmin('index');
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
}
