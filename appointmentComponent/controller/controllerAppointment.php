<?php

require_once(BASE_PATH . '/config/database.php');
require_once(BASE_PATH . '/appointmentComponent/model/appointment.php');

ini_set('memory_limit', '256M'); // Increase to 256MB

class ControllerAppointment
{
    private $appointmentModel;
    private $db;

    public function __construct()
    {
        $this->db = new DatabaseConnection();
        $this->appointmentModel = new AppointementModel($this->db);
    }


    public function indexAppointment($docId)
    {
        $getDoctById = $this->appointmentModel->get_doctor_by_id($docId);
        require(BASE_PATH . '/appointmentComponent/view/reserveAppointment.php');
    }

    public function indexSelectDoctor()
    {
        $listDoctors =  $this->appointmentModel->get_doctors_list();
        require(BASE_PATH . '/appointmentComponent/view/selectDoctor.php');
    }

    public function controlleReserveAppointment($doctor_RPPS, $user_numSS,  $res_date, $res_time)
    {
        if ($this->appointmentModel->reserveAppointment($doctor_RPPS, $user_numSS,  $res_date, $res_time)) {
            header("Location: /home/selectDoctor");
        }
    }


    public function controllerDisplayAppointments($numSS)
    {
        return $this->appointmentModel->get_appointments($numSS);
    }
    public function   controllerDisplayAppointmentPanel()
    {

        $getUsersAppointments = $this->controllerDisplayAppointments($_SESSION["numSS"]);
        require(BASE_PATH . '/appointmentComponent/view/displayListAppointments.php');
    }
}
