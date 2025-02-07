<?php

require_once(BASE_PATH . '/config/utils.php');
require_once(BASE_PATH . '/loginComponent/controller/controllerLogin.php');
$currentDir = dirname($_SERVER['PHP_SELF']);


class IndexLogin
{
    public function __construct()
    {
        $controllerLogin = new ControllerLogin();
        $controllerLogin -> index();
    }
}

new IndexLogin();