<?php

require_once(BASE_PATH . '/config/database.php');

class ControllerLogin
{
    private $utilsateurModel;
    private $db;

    public function __construct()
    {

    }

    public function index()
    {
        require(BASE_PATH . '/loginComponent/view/login.php');

    }

}
