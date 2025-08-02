<?php

require_once(BASE_PATH . '/config/utils.php');
require_once(BASE_PATH . '/appointmentComponent/controller/controllerAppointment.php');
$currentDir = dirname($_SERVER['PHP_SELF']);


class IndexAppointment
{
    private $controllerAppointment;
    private $utils;
    public function __construct()
    {
        $this->controllerAppointment = new ControllerAppointment();
        $this->utils = new Utils("");

        if ($this->utils->getUri() == '/home/selectDoctor/appointment') {
            $doctor_id = isset($_GET['doctor_id']) ? intval($_GET['doctor_id']) : 0;
        }

        // if ($this->utils->getUri() == '/home/displayListDoctors') {
        //     $this->displayDoctors();
        // }
        if ($this->utils->getUri() == '/home/selectDoctor') {
            $this->controllerAppointment->indexSelectDoctor();
        }
        if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['select-appointment'])) {
            $doctor_id = isset($_POST['select-appointment']) ? intval($_POST['select-appointment']) : 0;
            $this->controllerAppointment->indexAppointment($doctor_id);
        }
        if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['reserve-appointment'])) {
            $doctor_RPPS = $_POST["doctorRPPS"];
            $user_numSS = $_POST["userNumSS"];
            $res_date = $_POST["res_date"];
            $res_time = $_POST["res_time"];
            $this->indexReserveAppointment($doctor_RPPS, $user_numSS,  $res_date, $res_time);
        }
        if (($_SERVER['REQUEST_METHOD'] === 'POST')  && isset($_POST['delete-appointment'])) {

            if (isset($_POST['idAppointment'])) {
                ($_POST['idAppointment']);
                if ($this->deleteAppointment((int)$_POST['idAppointment'])) {
                    return;
                }
            }
        }

        if (($_SERVER['REQUEST_METHOD'] === 'POST')  && isset($_POST['display-appointments'])) {

            $this->displayAppointments();
        }

        if (($_SERVER['REQUEST_METHOD'] === 'POST')  && isset($_POST['home-display-doctors'])) {
            $this->displayDoctors();
        }
    }
    public function displayAppointments()
    {
        $this->controllerAppointment->controllerDisplayAppointmentPanel();
    }

    public function displayDoctors()
    {
        $this->controllerAppointment->controllerDisplayDocotors();
    }

    public function indexSelectDoctor()
    {
        $this->controllerAppointment->indexSelectDoctor();
    }

    public function indexAppointment($docId)
    {
        $this->controllerAppointment->indexAppointment($docId);
    }

    public function indexReserveAppointment($doctor_RPPS, $user_numSS,  $res_date, $res_time)
    {
        $this->controllerAppointment->controlleReserveAppointment($doctor_RPPS, $user_numSS,  $res_date, $res_time);
    }

    public function deleteAppointment($id)
    {

        return $this->controllerAppointment->controllerDeleteAppointment($id);
    }

    public function withtouRerouteListAppointments($numSS)
    {

        $this->controllerAppointment->controllerDisplayAppointments($numSS);
    }
}

new IndexAppointment();
