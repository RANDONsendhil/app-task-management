<?php

require_once(BASE_PATH . '/config/utils.php');
require_once(BASE_PATH . '/loginComponent/controller/controllerLogin.php');
$currentDir = dirname($_SERVER['PHP_SELF']);


class IndexLogin
{
    private $controllerLogin;
    public function __construct()
    {
        $this->controllerLogin = new ControllerLogin();
        //  $controllerLogin -> index();
    }


    public function login($uname, $password)
    {
        $this->controllerLogin->index();
    }
}

$index = new IndexLogin();
$index->login("", "");