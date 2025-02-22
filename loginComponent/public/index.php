<?php

require_once(BASE_PATH . '/config/utils.php');
require_once(BASE_PATH . '/loginComponent/controller/controllerLogin.php');
require_once(BASE_PATH . '/config/utils.php');


class IndexLogin
{
    private $controllerLogin;
    private $utils;
    public function __construct()
    {
        $this->utils = new Utils("");
        $this->controllerLogin = new ControllerLogin();

        if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['connect-profil'])) {
            $email = htmlspecialchars($_POST["email"]);
            $password = htmlspecialchars($_POST["password"]);

            if ($this->login($email, $password)) {
                header("Location: /home");
            } else {
                header("Location: /login");
                exit();
            }
        }
    }


    public function login($email, $password)
    {
        return $this->controllerLogin->indexLogin($email, $password);
    }
}

new IndexLogin();
