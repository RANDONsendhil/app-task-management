<?php

require_once(BASE_PATH . '/user/homeComponent/controller/controllerHome.php');
require_once(BASE_PATH . '/user/homeComponent/model/project.php');
require_once(BASE_PATH . '/config/utils.php');
$currentDir = dirname($_SERVER['PHP_SELF']);



class IndexHome
{
    private $controllerHome;
    private $utils;
    public function __construct()
    {

        $this->utils = new Utils("");
        $this->controllerHome = new ControllerHome();

        echo ("<script> console.log('" . json_encode($_SESSION["role"]) . "'); </script>");
        if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['submit-project'])) {

            if ($this->controllerHome->controllerCreateProject($this->getProjetData())) {
                header("Location: " . $_SERVER['REQUEST_URI']);
                exit();
            }
        }

        if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['submit-edit-project'])) {
            $edit_project_id = $this->sanitize_input($_POST["project_id"]);

            if ($this->controllerHome->controllerEditProject($edit_project_id, $this->getProjetData())) {
                header("Location: " . $_SERVER['REQUEST_URI']);
                exit();
            }
        }

        if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['export-pdf'])) {
            $project_id = $this->sanitize_input($_POST["export_project_pdf"]);

            if ($this->controllerHome->controllerExportProjectToPDF($project_id)) {
                header("Location: " . $_SERVER['REQUEST_URI']);
                exit();
            }
        }

        if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['delete-project'])) {
            $delete_project_id = $this->sanitize_input($_POST["delete-project"]);

            if ($this->controllerHome->controllerDeleteProject($delete_project_id)) {
                header("Location: " . $_SERVER['REQUEST_URI']);
                exit();
            }
        }
        if ($_SESSION["role"] == "admin") {
            $this->displayProjects();
        }
        if ($_SESSION["role"] == "collaborateur") {
            $this->displayHomeCollaborateur();
        }
    }

    function getProjetData()
    {
        $objProject = new Project(
            $this->sanitize_input($_POST["nom"]),
            $this->sanitize_input($_POST["description"]),
            $this->sanitize_input($_POST["date_debut"]),
            $this->sanitize_input($_POST["date_fin"]),
            $this->sanitize_input($_POST["cree_par_user_id"])
        );
        return  $objProject;
    }



    public function sanitize_input($data)
    {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    public function displayProjects()
    {
        $this->controllerHome->controlledisplayProjects();
    }


    public function deleteProject($id)
    {

        return $this->controllerHome->controllerDeleteProject($id);
    }

    public function displayHome()
    {
        // echo ("<script> console.log('Displaying home for user: " . $_SESSION["user_id"] . "'); </script>");
        return $this->controllerHome->index();
    }
    public function displayHomeCollaborateur()
    {
        //echo ("<script> console.log('Displaying displayHomeCollaborateur : " . $_SESSION["user_id"] . "'); </script>");
        $this->controllerHome->controlledisplayProjectsCollaborateur($_SESSION["fname_lname"], $_SESSION["email"]);
    }
}

new IndexHome();
