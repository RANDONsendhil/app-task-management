 <?php

    require_once(BASE_PATH . '/user/profilComponent/controller/controllerProfil.php');
    require_once(BASE_PATH . '/userCreationComponent/model/user.php');
    require_once(BASE_PATH . '/config/utils.php');

    $currentDir = dirname($_SERVER['PHP_SELF']);
    class IndexProfil
    {
        private $controllerProfil;
        private $utils;
        public function __construct()
        {
            $this->controllerProfil = new ControllerProfil();
            $this->utils = new Utils("");
            $profilNumSS =  $_SESSION["numSS"];



            if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['update-profil'])) {
                $this->displayProfilEditableForm();
            }
            if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['save-update-profil'])) {
                $this->saveProfil($this->getObjUser());
            }
            if ($this->utils->getUri() == '/profil') {
                $this->controllerProfil->index($numss = $profilNumSS);
            }

            if ($this->utils->getUri() == '/updateProfil') {
                $this->controllerProfil->displayProfilEditableFormPublic();
            }
        }

        public function displayProfilEditableForm()
        {

            $this->controllerProfil->displayProfilEditableFormPublic();
        }
        public function saveProfil($objUser)
        {

            $this->controllerProfil->saveProfilController($objUser);
            session_unset();
        }

        function getObjUser()
        {
            $objUser = new User(
                $this->sanitize_input($_POST["genre"]),
                $this->sanitize_input($_POST["numSS"]),
                $this->sanitize_input($_POST["lname"]),
                $this->sanitize_input($_POST["fname"]),
                $this->sanitize_input($_POST["inputEmail"]),
                $this->sanitize_input($_POST["inputPassword"]),
                $this->sanitize_input($_POST["mobileNum"]),
                $this->sanitize_input($_POST["phoneNum"]),
                $this->sanitize_input($_POST["inputAddress"]),
                $this->sanitize_input($_POST["inputCity"]),
                $this->sanitize_input($_POST["inputZip"])
            );
            return  $objUser;
        }
        public function sanitize_input($data)
        {
            return htmlspecialchars(stripslashes(trim($data)));
        }
    }

    new IndexProfil();
