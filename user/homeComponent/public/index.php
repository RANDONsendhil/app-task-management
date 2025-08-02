<?php

require_once(BASE_PATH . '/user/homeComponent/controller/controllerHome.php');
require_once(BASE_PATH . '/config/utils.php');
$currentDir = dirname($_SERVER['PHP_SELF']);



class IndexHome
{
    private $controllerHome;
    private $utils;
    public function __construct()
    {
        $this->controllerHome = new ControllerHome();
        $this->utils = new Utils("");
        $this->controllerHome = new ControllerHome();

        if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['save-user'])) {
            return;
        } else {
            if ($this->displayHome()) {
                $this->displayProjects();
            }
        }

        // if ($this->utils->getUri() == '/home/selectDoctor/appointment') {
        //     $doctor_id = isset($_GET['doctor_id']) ? intval($_GET['doctor_id']) : 0;
        // }

        //$this->displayProjects();
        // }
        // if ($this->utils->getUri() == '/home/selectDoctor') {
        //     $this->controllerHome->indexSelectProject();
        // }
        // if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['select-appointment'])) {
        //     $doctor_id = isset($_POST['select-appointment']) ? intval($_POST['select-appointment']) : 0;
        //     $this->controllerHome->indexAppointment($doctor_id);
        // }
        // if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['reserve-appointment'])) {
        //     $doctor_RPPS = $_POST["doctorRPPS"];
        //     $user_numSS = $_POST["userNumSS"];
        //     $res_date = $_POST["res_date"];
        //     $res_time = $_POST["res_time"];
        //     $this->indexReserveAppointment($doctor_RPPS, $user_numSS,  $res_date, $res_time);
        // }
        // if (($_SERVER['REQUEST_METHOD'] === 'POST')  && isset($_POST['delete-appointment'])) {

        //     if (isset($_POST['idAppointment'])) {
        //         ($_POST['idAppointment']);
        //         if ($this->deleteAppointment((int)$_POST['idAppointment'])) {
        //             return;
        //         }
        //     }
        // }

    }

    public function displayProjects()
    {
        $this->controllerHome->controlledisplayProjects();
    }


    public function indexAddProject($doctor_RPPS, $user_numSS,  $res_date, $res_time)
    {
        $this->controllerHome->controllerAddProject($doctor_RPPS, $user_numSS,  $res_date, $res_time);
    }

    public function deleteProject($id)
    {

        return $this->controllerHome->controllerDeleteProject($id);
    }

    public function withtouRerouteListAppointments($numSS)
    {

        $this->controllerHome->controllerDisplayAppointments($numSS);
    }

    public function displayHome()
    {
        $this->controllerHome = new ControllerHome();
        return $this->controllerHome->index();
    }
}

new IndexHome();