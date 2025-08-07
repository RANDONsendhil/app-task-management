<?php

require_once(BASE_PATH . '/config/utils.php');
require_once(BASE_PATH . '/taskComponent/controller/controllerTask.php');
require_once(BASE_PATH . '/taskComponent/model/task.php');
require_once(BASE_PATH . '/taskComponent/model/taskObj.php');


$currentDir = dirname($_SERVER['PHP_SELF']);



class IndexTask
{
    private $controllerTask;
    private $utils;
    public function __construct()
    {   
        $this->controllerTask = new ControllerTask();
        $this->utils = new Utils("");
       
        // Handle task form submissions
        if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['submit-task'])) {
            if (isset($_POST['idproject'])) {
                // Prepare clean redirect URL
                $redirect_url = strtok($_SERVER['REQUEST_URI'], '?');
                if (isset($_SESSION["projectId"])) {
                    $redirect_url .= '?project_id=' . $_SESSION["projectId"];
                }
                
                // Check if we're in edit mode
                if (isset($_POST['edit_mode']) && $_POST['edit_mode'] == '1' && isset($_POST['task_id'])) {
                    echo("<script>alert('UPDATE: submit-task de la tâche: " . $_POST['task_id'] . "');</script>");
                    if ($this->controllerTask->updateTask($this->getObjTaskForUpdate())) {
                        header("Location: " . $redirect_url);
                        exit();
                    }
                } else {
                    if ($this->controllerTask->createTask($this->getObjTask())) {
                        header("Location: " . $redirect_url);
                        exit();
                    }
                }
            }
        }

        // Handle task deletion
        if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['delete-task'])) {
            if (isset($_POST['idTask'])) {
                // Prepare clean redirect URL
                $redirect_url = strtok($_SERVER['REQUEST_URI'], '?');
                if (isset($_SESSION["projectId"])) {
                    $redirect_url .= '?project_id=' . $_SESSION["projectId"];
                }
                
                if ($this->controllerTask->deleteTask($_POST['idTask'])) {
                    header("Location: " . $redirect_url);
                    exit();
                }
            }
        }

        // if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_SESSION["projectId"])) {
        //     $this->controllerTask->getTasksByProjectId($_SESSION["projectId"]);
        // }
        //    if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['export-pdf'])) {
        //     $project_id = $this->sanitize_input($_POST["export_project_pdf"]);

        //     // if ($this->controllerHome->controllerExportProjectToPDF($project_id)) {
        //     //     header("Location: " . $_SERVER['REQUEST_URI']);
        //     //     exit();
        //     // }
            
        // }
        //   $allUsers = $this->controllerTask->getUsers(); 
        //  $this->displayProjectTasks();  

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

    public function displayProjectTasks()
    {
        require(BASE_PATH . '/projectComponent/view/displayProjectDetails.php');
    }
}

new IndexTask();
