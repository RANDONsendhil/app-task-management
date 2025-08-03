<?php
session_start();
require_once(BASE_PATH . '/config/utils.php');
require_once(BASE_PATH . '/projectComponent/controller/controllerProject.php');
require_once(BASE_PATH . '/projectComponent/model/task.php');
$currentDir = dirname($_SERVER['PHP_SELF']);


class IndexProject
{
    private $controllerProject;
    private $utils;
    public function __construct()
    {
        $this->controllerProject = new ControllerProject();
        $this->utils = new Utils("");

        if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['select-project'])) {
            $_SESSION["projectId"]  = isset($_POST['select-project']) ? intval($_POST['select-project']) : 0;

            $this->controllerProject->indexProject($_SESSION["projectId"]);
            $this->displayProjectTasksByProjectId($_SESSION["projectId"]);
        }

        if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['submit-task'])) {

            if (isset($_POST['idproject'])) {
                // Check if we're in edit mode
                if (isset($_POST['edit_mode']) && $_POST['edit_mode'] == '1' && isset($_POST['task_id'])) {

                    if ($this->controllerProject->updateTask($this->getObjTaskForUpdate())) {
                        header("Location: " . $_SERVER['REQUEST_URI']);
                        exit();
                    }
                } else {
                    if ($this->controllerProject->createTask($this->getObjTask())) {
                        header("Location: " . $_SERVER['REQUEST_URI']);
                        exit();
                    }
                }
            }
        }

        if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['delete-task'])) {

            if (isset($_POST['idTask'])) {

                if ($this->controllerProject->deleteTask($_POST['idTask'])) {
                    header("Location: " . $_SERVER['REQUEST_URI']);
                    exit();
                }
            }
        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_SESSION["projectId"])) {
            $this->controllerProject->indexProject($_SESSION["projectId"]);
        }
    }

    function getObjTask()
    {
        $objTask = new Task(
            $this->sanitize_input($_SESSION["projectId"]),
            $this->sanitize_input($_POST["titre"]),
            $this->sanitize_input($_POST["description"]),
            $this->sanitize_input($_POST["statut"]),
            $this->sanitize_input($_POST["assignee_id"]),
            $this->sanitize_input($_POST["priorite"]),
            $this->sanitize_input($_POST["date_echeance"]),
            date('Y-m-d H:i:s') // Auto-set creation date
        );

        return  $objTask;
    }

    function getObjTaskForUpdate()
    {
        $objTask = new Task(
            $this->sanitize_input($_SESSION["projectId"]),
            $this->sanitize_input($_POST["titre"]),
            $this->sanitize_input($_POST["description"]),
            $this->sanitize_input($_POST["statut"]),
            $this->sanitize_input($_POST["assignee_id"]),
            $this->sanitize_input($_POST["priorite"]),
            $this->sanitize_input($_POST["date_echeance"]),
            null, // Keep original creation date
            $this->sanitize_input($_POST["task_id"]) // Include task ID for update
        );

        return  $objTask;
    }

    function sanitize_input($data)
    {
        if ($data === null || $data === '') {
            return '';
        }
        return htmlspecialchars(strip_tags(trim($data)));
    }


    public function displayProjectTasksByProjectId($projectId)
    {
        $this->controllerProject->getTasksByProjectId($projectId);
    }
}

new IndexProject();
