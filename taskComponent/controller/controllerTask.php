<?php
require_once(BASE_PATH . '/config/database.php');
require_once(BASE_PATH . '/taskComponent/model/task.php');
$currentDir = dirname($_SERVER['PHP_SELF']);

class ControllerTask
{
    private $projectModel;
    private $taskModel;
    private $db;

    public function __construct()
    {
        $this->db = new DatabaseConnection();
        $this->taskModel = new TaskModel($this->db);
        $this->projectModel = new ProjectModel($this->db);
    }

    public function getUsers()
    {
        $allUsers = $this->projectModel->get_all_users();
        return $allUsers;
    }

    public function getTasksByProjectId($id)
    {
        $projectTasks = $this->taskModel->get_tasks_by_project_id($id);

        return $projectTasks;
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
            echo "<script>alert(' === HERE idTask " . json_encode($idTask) . " ===');</script>";
            $projectTasks = $this->taskModel->get_tasks_by_project_id($_SESSION["projectId"]);


            return true;
        } else {
            return false;
        }
    }

    public function updateTask($task)
    {
        if ($this->taskModel->update_task($task)) {
            echo ("<script>alert('update_task update_task de la tâche: " . json_encode($task->getId()) . "');</script>");
            $projectTasks = $this->taskModel->get_tasks_by_project_id($_SESSION["projectId"]);
            return true;
        } else {
            return false;
        }
    }
}
