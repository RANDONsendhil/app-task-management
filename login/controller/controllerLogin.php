<?php

// require_once(BASE_PATH . '/config/database.php');
require_once(BASE_PATH . '/login/model/login.php');

class ControllerLogin
{
    private $utilsateurModel;
    private $db;

    public function __construct()
    {
    }

    public function index()
    {
        require(BASE_PATH . '/login/view/login.php');

    }
}