$ <?php
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
            require(BASE_PATH . '/user/homeComponent/view/displayHome.php');
        }

        public function controlledisplayProjects()
        {
            require(BASE_PATH . '/user/homeComponent/view/displayHome.php');
        }

        public function controllerAddProject()
        {
            require(BASE_PATH . '/user/homeComponent/view/displayHome.php');
        }

        public function controllerDeleteProject()
        {
            require(BASE_PATH . '/user/homeComponent/view/displayHome.php');
        }

        public function controllerDisplayAppointments()
        {
            require(BASE_PATH . '/user/homeComponent/view/displayHome.php');
        }
    }