<?php
session_start();
require_once(BASE_PATH . '/config/utils.php');
require_once(BASE_PATH . '/projectComponent/controller/controllerProject.php');
require_once(BASE_PATH . '/user/homeComponent/controller/controllerHome.php');

require_once(BASE_PATH . '/taskComponent/model/task.php');
require_once(BASE_PATH . '/taskComponent/model/taskObj.php');
$currentDir = dirname($_SERVER['PHP_SELF']);


class IndexProject
{
    private $controllerProject;
    private $utils;
    private $controllerHome;
    public function __construct()
    {
        $this->controllerProject = new ControllerProject();
        $this->controllerHome = new ControllerHome();
        $this->utils = new Utils("");

        if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['select-project'])) {
            $_SESSION["projectId"]  = isset($_POST['select-project']) ? intval($_POST['select-project']) : 0;
            if ($_SESSION["role"] === "admin") {
                $this->controllerProject->indexProject($_SESSION["projectId"]);
            }
            if ($_SESSION["role"] === "collaborateur") {
                $this->controllerProject->indexProjectCollaborateur($_SESSION["collaborateur_id"], $_SESSION["projectId"]);
            }
        }

        if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['submit-task'])) {

            if ($this->controllerProject->createTask($this->getObjTask())) {
                header("Location: " . $_SERVER['REQUEST_URI']);
                exit();
            }
        }
        if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['modify-status-task-collaborateur'])) {

            if ($this->controllerProject->updateTaskStatus($_POST['task_id'], $_POST['modify-status-task-collaborateur'])) {
                header("Location: " . $_SERVER['REQUEST_URI']);
                exit();
            }
        }
        if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['submit-edit-task'])) {

            if ($this->controllerProject->updateTask($this->getObjTaskForUpdate())) {
                header("Location: " . $_SERVER['REQUEST_URI']);
                exit();
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
            if ($_SESSION["role"] === "admin") {
                $this->controllerProject->indexProject($_SESSION["projectId"]);
            }
            if ($_SESSION["role"] === "collaborateur") {
                $this->controllerProject->indexProjectCollaborateur($_SESSION["collaborateur_id"], $_SESSION["projectId"]);
            }
        }
        if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['export-pdf'])) {
            $project_id = $this->sanitize_input($_POST["export_project_pdf"]);

            if ($this->controllerHome->controllerExportProjectToPDF($project_id)) {
                header("Location: " . $_SERVER['REQUEST_URI']);
                exit();
            }
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
            $this->sanitize_input($_POST["task_id"]) // Include task ID for update (corrected field name)
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

    public function displayProjectTasksByCollaborateurId($collaborateurId, $projectId)
    {
        $this->controllerProject->getTasksByCollaborateurId($collaborateurId, $projectId);
    }
}

new IndexProject();
