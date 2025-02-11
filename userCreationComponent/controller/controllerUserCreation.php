<?php

require_once(BASE_PATH . '/config/database.php');
require_once(BASE_PATH . '/userCreationComponent/model/userCreation.php');


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

    public function index()
    {
        require(BASE_PATH . '/userCreationComponent/view/userCreation.php');
    }
}
