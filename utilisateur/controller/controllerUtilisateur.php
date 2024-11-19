<?php

require_once(BASE_PATH . '/config/database.php');
require_once(BASE_PATH . '/utilisateur/model/utilisateur.php');
require_once(BASE_PATH . '/config/utils.php');

class ControllerUtilisateur
{
    private $utilsateurModel;
    private $db;

    public function __construct()
    {
        $this->db = new DatabaseConnection();
        $this->utilsateurModel = new Utilisateur($this->db);
    }


    public function add_user($userId, $uname, $userAddress)
    {
        if ($this->utilsateurModel->insert_user($userId, $uname, $userAddress)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_list_users()
    {
        $users = $this->utilsateurModel->fetch_all_users();
        require(BASE_PATH . '/utilisateur/view/listUser.php');
    }

    public function delete_user_by_id($id)
    {
        return $this->utilsateurModel->deleteUserById($id);
    }

    public function index()
    {
        $this->get_list_users();
    }
    public function __destruct()
    {
        return;
    }
}
