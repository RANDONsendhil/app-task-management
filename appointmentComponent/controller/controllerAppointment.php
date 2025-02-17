<?php

require_once(BASE_PATH . '/config/database.php');

require_once(BASE_PATH . '/appointmentComponent/model/appointment.php');
class ControllerAppointment
{
    private $appointmentModel;
    private $db;

    public function __construct()
    {
        $this->db = new DatabaseConnection();
        $this->appointmentModel = new AppointementModel($this->db);
    }


    public function indexAppointment()
    {
        require(BASE_PATH . '/appointmentComponent/view/reserveAppointment.php');
    }

    public function indexSelectDoctor()
    {
        $listDoctors =  $this->appointmentModel->get_doctors_list();
        require(BASE_PATH . '/appointmentComponent/view/selectDoctor.php');
    }
}
