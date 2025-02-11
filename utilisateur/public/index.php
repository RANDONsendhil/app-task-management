<?php

require_once(BASE_PATH . '/config/utils.php');
require_once(BASE_PATH . '/utilisateur/controller/controllerUtilisateur.php');
$currentDir = dirname($_SERVER['PHP_SELF']);

class IndexUtilisateur
{
    private $userId = "";
    private $uname = "";
    private $userAddress = "";

    public function __construct()
    {
        $this->userId =  $this->sanitize_input($_POST["userId"]);
        $this->uname = $this->sanitize_input($_POST["username"]);
        $this->userAddress = $_POST["userAddress"];

        $controllerUtilisateur = new ControllerUtilisateur();
        if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['save-user'])) {
            $this->addUser($controllerUtilisateur);
        } elseif (($_SERVER['REQUEST_METHOD'] === 'POST')  && isset($_POST['get-users'])) {
            $controllerUtilisateur->get_list_users();
        } elseif (($_SERVER['REQUEST_METHOD'] === 'POST')  && isset($_POST['delete-user'])) {
            $this->deleteUser($controllerUtilisateur);
        }
        $controllerUtilisateur->index();
    }
    public function sanitize_input($data)
    {
        return htmlspecialchars(stripslashes(trim($data)));
    }



    public function deleteUser($controllerUtilisateur): bool
    {
        if (isset($_POST['idusers'])) {
            if ($controllerUtilisateur->delete_user_by_id((int)$_POST['idusers'])) {
                $_SESSION['message'] = 'User ' . $_POST['idusers'] . ' deleted successfully!';
                return true;
            } else {
                $_SESSION['message'] = 'User ' . $_POST['idusers'] . ' deleted failed!';
                return false;
            }
        }
        return false;
    }

    public function addUser($controllerUtilisateur): bool
    {
        if (($this->userId != "") && ($this->uname != "") && ($this->userAddress != "")) {

            if ($controllerUtilisateur->update_user_info(intval($this->userId), $this->uname, $this->userAddress)) {
                $_SESSION['message'] = 'User Updated successfully!' . "" . $this->uname . "" . $this->userAddress;
                header("Location: user");
                die();
            } else {
                $_SESSION['message'] = 'User Updation failed!' . "" . $this->uname . "" . $this->userAddress;
                return false;
            }
        } elseif (($this->uname != "") && ($this->userAddress != "")) {
            if ($controllerUtilisateur->add_user($this->uname, $this->userAddress)) {
                $_SESSION['message'] = 'User created successfully!' . "" . $this->uname . "" . $this->userAddress;
                header("Location: user");
                die();
            } else {
                $_SESSION['message'] = 'User creation Failed !' . "" . $this->uname . "" . $this->userAddress;
                return false;
            }
        } else {

            return false;
        }
    }

    public function getError(): string
    {
        return "";
    }
}

new IndexUtilisateur();
