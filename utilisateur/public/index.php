<?php

require_once(BASE_PATH . '/config/utils.php');
require_once(BASE_PATH . '/utilisateur/controller/controllerUtilisateur.php');
$currentDir = dirname($_SERVER['PHP_SELF']);

class IndexUtilisateur
{   
  private $userId ="";
  private $uname ="";
  private $userAddress ="";

    public function __construct()
    {     
        $this->userId =  $this->sanitize_input($_POST["userId"]);
        $this->uname = $this->sanitize_input($_POST["username"]);
        $this->userAddress =$_POST["userAddress"];
   
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
    public function sanitize_input($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }
    public function deleteUser($controllerUtilisateur): bool
    {
        if (isset($_POST['idusers'])) {
            if ($controllerUtilisateur->delete_user_by_id((int)$_POST['idusers'])) {
                $_SESSION['message'] = 'User ' . $_POST['idusers'] . ' deleted successfully!';
                $message = 'User ' . $_POST['idusers'] . ' deleted successfully!';
                return true;
            } else {
                $_SESSION['message'] = 'User ' . $_POST['idusers'] . ' deleted failed!';
                $message = 'User ' . $_POST['idusers'] . ' deleted failed!';
                exit;
                return false;
            }
        }
        return false;
    }

    public function addUser($controllerUtilisateur): bool
    {   
        if (($this->userId != "") && ($this->uname != "") && ($this-> userAddress != "")) {
          
            if ($controllerUtilisateur->update_user_info(intval($this->userId), $this->uname, $this->userAddress)) {
                return true;
            } else {
                return false;
               
            }

        } elseif(($this->uname != "") && ($this-> userAddress != "")) {
            if ($controllerUtilisateur->add_user($this->uname, $this->userAddress)) {
                $_SESSION['message'] = 'User creation successfully!' . "".$this->uname."". $this->userAddress;
               $message = 'User creation successfully!';
                return true;
            } else {
                return false;
            }
        }else{
          
          return false;
        }
       
    }

    public function getError() : string {
      return "";
    }
}

new IndexUtilisateur();
