<?php
session_start();
require_once(BASE_PATH . '/config/database.php');
require_once(BASE_PATH . '/userCreationComponent/model/userCreation.php');
require_once(BASE_PATH . '/config/utils.php');

class ControllerUserCreation
{
    private $userCreationModel;
    private $db;

    public function __construct()
    {

        $this->db = new DatabaseConnection();
        $this->userCreationModel = new UserCreationModel($this->db);
    }

    public function createUser($objUser)
    {
        if ($this->userCreationModel->insert_user($objUser)) {
            return true;
        } else {
            return false;
        }
    }

    public function updatUser($objUser)
    {
        if ($this->userCreationModel->insert_user($objUser)) {
            return true;
        } else {
            return false;
        }
    }

    public function displayUser($userNumSS)
    {
        $user_data = $this->userCreationModel->display_user("1");
    }

    public function index()
    {
        require(BASE_PATH . '/userCreationComponent/view/userCreation.php');
    }
}
