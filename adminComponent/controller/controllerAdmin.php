<?php
require_once(BASE_PATH . '/config/database.php');
require_once(BASE_PATH . '/adminComponent/model/admin.php');
session_start();
class ControllerAdmin
{

  private $db;
  private $modelAdmin;

  public function __construct()
  {
    $this->db = new DatabaseConnection();
    $this->modelAdmin = new AdminModel($this->db);
  }


  public function indexLoginAdmin($id_admin, $password)
  {
    $ret = $this->modelAdmin->verifyAdminLogin($id_admin, $password);

    if ($ret != null) {
      $_SESSION["id_admin"] = $ret["id_admin"];
      $_SESSION["fname"] = $ret["fname"];
      $_SESSION["lname"] = $ret["lname"];
      return true;
    } else {
      return false;
    }
  }

  public function index()
  {
    require(BASE_PATH . '/adminComponent/view/adminLogin.php');
  }

  public function indexAdminHome()
  {
    require(BASE_PATH . '/adminComponent/view/adminHome.php');
  }

  public function controllerAdminProfil()
  {
    require(BASE_PATH . '/adminComponent/view/profilAdmin.php');
  }

  public function displayAdminProfilById($id)
  {
    $dataAdminById = $this->modelAdmin->displayAdminById($id);
    require(BASE_PATH . '/adminComponent/view/profilAdmin.php');
  }
}
