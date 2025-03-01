<?php
require_once(BASE_PATH . '/config/database.php');
require_once(BASE_PATH . '/adminComponent/model/admin.php');
require_once(BASE_PATH . '/appointmentComponent/model/appointment.php');

session_start();
class ControllerAdmin
{

  private $db;
  private $modelAdmin;
  private $modelAppointment;

  public function __construct()
  {
    $this->db = new DatabaseConnection();
    $this->modelAdmin = new AdminModel($this->db);
    $this->modelAppointment = new AppointementModel($this->db);
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

  public function displayAdminProfilToUpdate($id)
  {
    $dataAdminById = $this->modelAdmin->displayAdminById($id);
    require(BASE_PATH . '/adminComponent/view/home/updateProfilAdmin.php');
  }


  public function controllerAdminProfilUpdate($objUserAdmin)
  {
    $this->modelAdmin->updateProfilAdmin($objUserAdmin);
    $this->displayAdminProfilById($_SESSION["id_admin"]);
  }

  public function controllerDisplayAppointmentPatients()
  {

    $dataDisplayAppointmentPatients = $this->modelAdmin->disAppointementUser();


    require(BASE_PATH . '/adminComponent/view/home/disAppointementUser.php');
  }

  public function controllerDisplayAppointmentDoctors()
  {
    $dataDisplayAppointmentDoctors = $this->modelAdmin->disAppointementDoctor();
    require(BASE_PATH . '/adminComponent/view/home/disAppointementDoctor.php');
  }

  public function controllerDisplayDoctors()
  {
    $listDoctorsAdmin = $this->modelAppointment->get_doctors_list();
    require(BASE_PATH . '/adminComponent/view/home/disDoctors.php');
  }

  public function controllerAdminDeleteAppointmentPatientByIdAppoint($id)
  {
    $dataDisplayAppointmentPatients = $this->modelAdmin->deleteAppointmentPatientByIdAppoint($id);
    $this->controllerDisplayAppointmentPatients();
  }
  public function controllerAdminDeleteAppointmentDoctorByIdAppoint($id)
  {


    $dataDisplayAppointmentDoctors = $this->modelAdmin->deleteAppointmentDoctorByIdAppoint($id);
    $this->controllerDisplayAppointmentDoctors();
    return true;
  }
}
