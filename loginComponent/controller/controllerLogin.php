<?php
session_start();
require_once(BASE_PATH . '/config/database.php');
require_once(BASE_PATH . '/userCreationComponent/model/userCreation.php');

class ControllerLogin
{
    private $loginModel;
    private $db;
    private $userCreationModel;

    public function __construct()
    {
        $this->db = new DatabaseConnection();
        // $this->loginModel = new Login($this->db);
        $this->userCreationModel = new UserCreationModel($this->db);
    }

    public function indexLogin($email, $password)
    {
        $ret = $this->userCreationModel->verifyLogin($email, $password);
        if ($ret != null) {
            $_SESSION["lname"] = $ret["lname"];
            $_SESSION["fname"] = $ret["fname"];
            $_SESSION["numSS"] = $ret["numSS"];
            return true;
        } else {
            return false;
        }
    }
}