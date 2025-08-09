<?php

require_once(BASE_PATH . '/config/database.php');
require_once(BASE_PATH . '/projectComponent/model/project.php');
require_once(BASE_PATH . '/taskComponent/model/task.php');
$currentDir = dirname($_SERVER['PHP_SELF']);
ini_set('memory_limit', '256M'); // Increase to 256MB

class ControllerProject
{
    private $taskModel;
    private $projectModel;
    private $db;

    public function __construct()
    {
        $this->db = new DatabaseConnection();
        $this->projectModel = new ProjectModel($this->db);
        $this->taskModel = new TaskModel($this->db);
    }



    public function indexProject($id)
    {
        $projectTasks = $this->taskModel->get_tasks_by_project_id($id);
        $resultProjectById = $this->projectModel->get_project_by_id($id);
        $allUsers = $this->projectModel->get_all_users();

        if (!$resultProjectById) {
            return;
        }
        require(BASE_PATH . '/projectComponent/view/displayProjectDetails.php');
    }


    public function indexProjectCollaborateur($collaborateurId, $projectId)
    {
        $projectTasks = $this->taskModel->get_tasks_by_collaborateurId_project_id($collaborateurId, $projectId);
        $resultProjectById = $this->projectModel->get_project_by_id($projectId);
        $allUsers = $this->projectModel->get_all_users();

        if (!$resultProjectById) {
            return;
        }
        require(BASE_PATH . '/projectComponent/view/displayProjectDetails.php');
    }

    public function getTasksByProjectId($id)
    {
        $projectTasks = $this->taskModel->get_tasks_by_project_id($id);
    }

    public function getTasksByCollaborateurId($collaborateurId, $projectId)
    {
        $projectTasks = $this->taskModel->get_tasks_by_collaborateurId_project_id($collaborateurId, $projectId);
    }

    public function createTask($objTask)
    {
        if ($this->taskModel->create_task($objTask)) {
            $projectTasks = $this->taskModel->get_tasks_by_project_id($_SESSION["projectId"]);

            return true;
        } else {
            return false;
        }
    }

    public function deleteTask($idTask)
    {
        if ($this->taskModel->delete_task_by_id($idTask)) {
            $projectTasks = $this->taskModel->get_tasks_by_project_id($_SESSION["projectId"]);

            return true;
        } else {
            return false;
        }
    }

    public function updateTask($task)
    {
        if ($this->taskModel->update_task($task)) {
            $projectTasks = $this->taskModel->get_tasks_by_project_id($_SESSION["projectId"]);
            return true;
        } else {
            return false;
        }
    }


    public function updateTaskStatus($taskId, $newStatus)
    {
        if ($this->taskModel->update_task_status($taskId, $newStatus)) {
            $projectTasks = $this->taskModel->get_tasks_by_project_id($_SESSION["projectId"]);
            return true;
        } else {
            return false;
        }
    }
}
