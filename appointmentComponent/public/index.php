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

            $this->controllerAppointment->indexAppointment();
        }
        if ($this->utils->getUri() == '/home/selectDoctor') {
            $this->controllerAppointment->indexSelectDoctor();
        }
        if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['book-appointment'])) {
            $doctor_id = isset($_POST['book-appointment']) ? intval($_POST['book-appointment']) : 0;
            echo "<script type='text/javascript'>alert('" .  $doctor_id . "');</script>";
        }
    }

    public function indexSelectDoctor()
    {
        $this->controllerAppointment->indexSelectDoctor();
    }

    public function indexAppointment()
    {
        $this->controllerAppointment->indexAppointment();
    }
}

new IndexAppointment();
