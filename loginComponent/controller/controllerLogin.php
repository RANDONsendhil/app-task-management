<?php

require_once(BASE_PATH . '/config/database.php');
require_once(BASE_PATH . '/loginComponent/model/login.php');

class ControllerLogin
{
    private $utilsateurModel;
    private $db;

    public function __construct()
    {

    }

    public function indexLogin()
    {
        require(BASE_PATH . '/loginComponent/view/login.php');

    }
    public function indexUserCreation()
    {
        require(BASE_PATH . '/loginComponent/view/userCreation.php');

    }
}