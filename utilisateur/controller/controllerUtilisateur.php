<?php
require_once(BASE_PATH . '/config/database.php');
require_once(BASE_PATH . '/utilisateur/model/utilisateur.php');

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
    echo $this->utilsateurModel->add_user($userId, $uname, $userAddress);
    header('Location: .');
  }

  public function index()
  {
    require(BASE_PATH . '/utilisateur/view/listUtilisateur.php');
  }
}
