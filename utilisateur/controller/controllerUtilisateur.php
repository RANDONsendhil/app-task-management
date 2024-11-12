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
    // $this->get_list_users();
  }


  public function add_user($userId, $uname, $userAddress)
  {
    if ($this->utilsateurModel->insert_user($userId, $uname, $userAddress)) {
      new Log("User created successfully new!");
      $_SESSION['message'] = 'User created successfully!';
    } else {
      $_SESSION['message'] = 'User creation Failed!';
      new Log("User creation Failed!");
    }
    header('Location: /user');
  }

  public function get_list_users()
  {
    $users = $this->utilsateurModel->fetch_all_users();
    require(BASE_PATH . '/utilisateur/view/listUser.php');
  }

  public function index()
  {
    require(BASE_PATH . '/utilisateur/view/formUser.php');
  }
  public function __destruct()
  {
    return;
    //$this->utilsateurModel->closeConnection();
  }
}
