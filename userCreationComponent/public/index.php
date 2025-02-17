<?php

require_once(BASE_PATH . '/config/utils.php');
require_once(BASE_PATH . '/userCreationComponent/controller/controllerUserCreation.php');
require_once(BASE_PATH . '/userCreationComponent/model/user.php');
require_once(BASE_PATH . '/config/utils.php');
$currentDir = dirname($_SERVER['PHP_SELF']);
class IndexUserCreation
{
    private $controllerUserCreation;
    private $utils;
    public function __construct()
    {
        $this->controllerUserCreation = new ControllerUserCreation();
        $this->utils = new Utils("");


        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $this->displayUser($this->controllerUserCreation, "1");
        }
        if (isset($_POST['create-user'])) {

            $this->userCreation($this->controllerUserCreation, $this->getObjUser());
            unset($_POST);
        }
        $this->controllerUserCreation->index();
    }

    function getObjUser()
    {
        $objUser = new User(
            $this->sanitize_input($_POST["genre"]),
            $this->sanitize_input($_POST["numSS"]),
            $this->sanitize_input($_POST["lname"]),
            $this->sanitize_input($_POST["fname"]),
            $this->sanitize_input($_POST["inputEmail"]),
            $this->sanitize_input($_POST["inputPassword"]),
            $this->sanitize_input($_POST["mobileNum"]),
            $this->sanitize_input($_POST["phoneNum"]),
            $this->sanitize_input($_POST["inputAddress"]),
            $this->sanitize_input($_POST["inputCity"]),
            $this->sanitize_input($_POST["inputZip"])
        );

        return  $objUser;
    }
    public function sanitize_input($data)
    {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    public function displayUser($controllerUserCreation, $numSS)
    {
        $controllerUserCreation->displayUser($numSS);
    }

    public function userCreation($controllerUserCreation, $objUser)
    {
        $controllerUserCreation->createUser($objUser);
    }

    public function updateUser($objUser)
    {
        $this->controllerUserCreation->updateUser($objUser);
    }

    public function getIndex()
    {
        $this->controllerUserCreation->index();
    }
}
new IndexUserCreation();
