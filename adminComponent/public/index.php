<?php
require_once(BASE_PATH . '/adminComponent/controller/controllerAdmin.php');
require_once(BASE_PATH . '/config/utils.php');


class IndexAdmin
{
  private $controllerAdmin;



  private $utils;
  public function __construct()
  {
    $id_admin =  $_SESSION["id_admin"];

    $this->utils = new Utils("");
    $this->controllerAdmin = new ControllerAdmin();

    if ($this->utils->getUri() == '/admin') {
      $this->index();
    }
    if ($this->utils->getUri() == '/admin/home') {
      $this->indexAdminHome();
    }
    if ($this->utils->getUri() == '/admin/profil-admin') {

      $this->controllerAdmin->displayAdminProfilById($_SESSION["id_admin"]);
    }

    if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['connect-admin'])) {
      $id_admin = htmlspecialchars($_POST["id_admin"]);
      $_SESSION["id_admin"] = $id_admin;
      $password = htmlspecialchars($_POST["password_admin"]);

      if ($this->indexLoginAdmin($id_admin, $password)) {
        header("Location: /admin/home");
      } else {
        $_SESSION['statusLoginAdmin'] = "error";
        $_SESSION['messageLoginAdmin'] = "Identifiant ou mot de passe non reconnu!";
        header("Location: /admin");
        exit();
      }
    }
  }


  public function indexLoginAdmin($id_admin, $password)
  {
    return $this->controllerAdmin->indexLoginAdmin($id_admin, $password);
  }

  public function index()
  {
    return $this->controllerAdmin->index();
  }

  public function indexAdminHome()
  {
    return $this->controllerAdmin->indexAdminHome();
  }

  public function indexAdminProfil()
  {
    return $this->controllerAdmin->controllerAdminProfil();
  }
  public function displayAdminProfilById()
  {
    return $this->controllerAdmin->controllerAdminProfil();
  }
}

new IndexAdmin();
