<?php
require_once(BASE_PATH . '/adminComponent/controller/controllerAdmin.php');
require_once(BASE_PATH . '/adminComponent/model/userAdmin.php');
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

    // if ($this->utils->getUri() == '/admin/home/display-appointment-patients') {
    //   $this->indexAdminAppointmentPatients();
    // }
    // if ($this->utils->getUri() == '/admin/home/display-appointment-doctors') {
    //   $this->indexAdminAppointmentDoctors();
    // }
    if ($this->utils->getUri() == '/admin/home/display-doctors') {
      $this->indexAdminDisplayDoctors();
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

    if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['delete-appointment-patient'])) {


      if (isset($_POST['id_appointement_delete'])) {
        if ($this->deleteAppointmentPatientByIdAppoint((int)$_POST['id_appointement_delete'])) {

          //header("Location: /admin/home/display-appointment-patients");
        }
      }
    }

    if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['delete-appointment-doctor'])) {
      if (isset($_POST['id_appointement_doctor_delete'])) {
        if ($this->deleteAppointmentDoctorByIdAppoint((int)$_POST['id_appointement_doctor_delete'])) {
          //header("Location: /admin/home/display-appointment-doctors");
        }
      }
    }
    if (($_SERVER['REQUEST_METHOD'] === 'POST')  && isset($_POST['display-appointments-admin-patients'])) {

      $this->indexAdminAppointmentPatients();
    }
    if (($_SERVER['REQUEST_METHOD'] === 'POST')  && isset($_POST['display-appointment-admin-doctors'])) {

      $this->indexAdminAppointmentDoctors();
    }

    if (($_SERVER['REQUEST_METHOD'] === 'POST')  && isset($_POST['display-admin-doctors'])) {

      $this->indexAdminDisplayDoctors();
    }




    if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['updateProfil-admin'])) {
      $this->displayAdminProfilUpdate($this->getObjUserAdmin());
    }

    if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['display-update-admin'])) {
      $this->displayAdminProfilToUpdate($_SESSION["id_admin"]);
    }
  }

  public function deleteAppointmentPatientByIdAppoint($id)
  {
    $this->controllerAdmin->controllerAdminDeleteAppointmentPatientByIdAppoint($id);
  }

  public function displayAdminProfilUpdate($objUserAdmin)
  {
    $this->controllerAdmin->controllerAdminProfilUpdate($objUserAdmin);
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


  public function displayAdminProfilById()
  {
    return $this->controllerAdmin->controllerAdminProfil();
  }

  function getObjUserAdmin()
  {
    $objUserAdmin = new UserAdmin(
      $this->sanitize_input($_POST["id_admin"]),
      $this->sanitize_input($_POST["lname"]),
      $this->sanitize_input($_POST["fname"]),
      $this->sanitize_input($_POST["email"]),
      $this->sanitize_input($_POST["password"]),
      $this->sanitize_input($_POST["phone"])
    );

    return  $objUserAdmin;
  }
  public function sanitize_input($data)
  {
    return htmlspecialchars(stripslashes(trim($data)));
  }

  public function displayAdminProfilToUpdate($id)
  {
    $this->controllerAdmin->displayAdminProfilToUpdate($id);
  }


  public function indexAdminAppointmentPatients()
  {
    $this->controllerAdmin->controllerDisplayAppointmentPatients();
  }

  public function indexAdminAppointmentDoctors()
  {
    $this->controllerAdmin->controllerDisplayAppointmentDoctors();
  }
  public function indexAdminDisplayDoctors()
  {
    $this->controllerAdmin->controllerDisplayDoctors();
  }

  public function deleteAppointmentDoctorByIdAppoint($id)
  {
    $this->controllerAdmin->controllerAdminDeleteAppointmentDoctorByIdAppoint($id);
  }
}

new IndexAdmin();
