<?php
session_start();
require_once(BASE_PATH . '/config/database.php');
require_once(BASE_PATH . '/userCreationComponent/model/userCreation.php');
require_once(BASE_PATH . '/user/homeComponent/model/home.php');


class ControllerLogin
{
    private $loginModel;
    private $db;
    private $userCreationModel;
    private $homeModel;

    public function __construct()
    {
        $this->db = new DatabaseConnection();
        // $this->loginModel = new Login($this->db);
        $this->userCreationModel = new UserCreationModel($this->db);
        $this->homeModel = new Home($this->db);
    }

    public function indexLogin($email, $password)
    {
        $ret = $this->userCreationModel->verifyLogin($email, $password);
        echo "<script> console.log(" . $ret . ") </script>";
        if ($ret != null) {
            $_SESSION["collaborateur_id"] =  ($this->getCollaborateurId($ret)) ? $this->getCollaborateurId($ret) : 0;
            $_SESSION["fname_lname"] = $ret["nom"];
            $_SESSION["role"] = $ret["role"];
            $_SESSION["email"] = $ret["email"];
            echo "<script> console.log('Login  l: " . $this->getCollaborateurId($ret) . "'); </script>";
            return true;
        }
    }

    public function getCollaborateurId($ret)
    {
        if ($ret["role"] == "collaborateur") {
            return $this->homeModel->get_id_userCollaborateur($ret["nom"], $ret["email"]);
        }
    }

    public function logout()
    {
        // Destroy all session data
        session_start();

        // Unset all session variables
        $_SESSION = array();

        // Delete the session cookie if it exists
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        // Destroy the session
        session_destroy();

        return true;
    }
}
