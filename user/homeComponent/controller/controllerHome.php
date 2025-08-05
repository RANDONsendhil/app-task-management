<?php
    session_start();
    require_once(BASE_PATH . '/config/database.php');
    require_once(BASE_PATH . '/user/homeComponent/model/home.php');

    class ControllerHome
    {
        private $homeModel;
        private $db;

        public function __construct()
        {
            $this->db = new DatabaseConnection();
            $this->homeModel = new Home($this->db);
        }

        public function index()
        {
            $listProjects = $this->homeModel->get_projects();
           
        }
        
        public function controlledisplayProjects()
        {       
            $listProjects = $this->homeModel->get_projects();
            require(BASE_PATH . '/user/homeComponent/view/displayHome.php');
           
        }
 

        public function controllerDeleteProject($id_project)
        {   
            $listProjects = $this->homeModel->get_projects();
            $this->homeModel->delete_project($id_project);
           
        }
 
        public function controllerCreateProject($objProject)
        {    
            if ($this->homeModel->create_project($objProject)) {
                $listProjects = $this->homeModel->get_projects();
                return true;
            } else {
                return false;
            }
        }
        public function controllerEditProject($id, $objProject)
        {
            if ($this->homeModel->edit_project($id, $objProject)) {
                return true;
            } else {
                return false;
            }
        }
    }