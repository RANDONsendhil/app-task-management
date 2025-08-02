<?php

require_once(BASE_PATH . '/config/database.php');
require_once(BASE_PATH . '/projectComponent/model/project.php');

ini_set('memory_limit', '256M'); // Increase to 256MB

class ControllerProject
{
    private $projectModel;
    private $db;

    public function __construct()
    {
        $this->db = new DatabaseConnection();
        $this->projectModel = new ProjectModel($this->db);
    }


    public function indexProject($id)
    {
        $projectTasks = $this->projectModel->get_tasks_by_project_id($id);
        $resultProjectById = $this->projectModel->get_project_by_id($id);
        echo "<script>alert('resultProjectById: " . json_encode($projectTasks) . "');</script>";
        if (!$resultProjectById) {
            echo "<script>alert('Project not found.');</script>";
            return;
        }
        require(BASE_PATH . '/projectComponent/view/displayProjectDetails.php');
    }

    public function getTasksByProjectId($id)
    {
        $projectTasks = $this->projectModel->get_tasks_by_project_id($id);
        require(BASE_PATH . '/projectComponent/view/displayProjectDetails.php');
    }

    // public function indexSelectDoctor()
    // {
    //     $listDoctors =  $this->projectModel->get_doctors_list();
    //     require(BASE_PATH . '/appointmentComponent/view/selectDoctor.php');
    // }

    // public function controlleReserveAppointment($doctor_RPPS, $user_numSS,  $res_date, $res_time)
    // {
    //     if ($this->projectModel->reserveAppointment($doctor_RPPS, $user_numSS,  $res_date, $res_time)) {
    //         header("Location: /home/selectDoctor");
    //     }
    // }
}