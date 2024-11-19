<?php

require_once(BASE_PATH . '/config/utils.php');
require_once(BASE_PATH . '/utilisateur/controller/controllerUtilisateur.php');
$currentDir = dirname($_SERVER['PHP_SELF']);

class IndexUtilisateur
{
    public function __construct()
    {
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

    public function deleteUser($controllerUtilisateur): bool
    {
        echo"\n deleteUser called ";
        if (isset($_POST['idusers'])) {
            if ($controllerUtilisateur->delete_user_by_id((int)$_POST['idusers'])) {
                $_SESSION['message-delete-user'] = 'User ' . $_POST['idusers'] . ' deleted successfully!';
                return true;
            } else {
                $_SESSION['message-delete-user'] = 'User ' . $_POST['idusers'] . ' deleted failed!';
                return false;
            }
        }
    }

    public function addUser($controllerUtilisateur): bool
    {
        echo"\n addUser called ";
        $uname = $_POST["username"];
        $userId = $_POST["userId"];
        $userAddress = $_POST["userAddress"];
        if ($controllerUtilisateur->add_user($userId, $uname, $userAddress)) {
            $_SESSION['message'] = 'User created successfully!';
            return true;
        } else {
            $_SESSION['message'] = 'User--->  creation failed !';
            return false;
        }
    }
}

new IndexUtilisateur();
