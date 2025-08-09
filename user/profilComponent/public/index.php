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

            if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['update-profil'])) {
                $this->displayProfilEditableForm();
            }
            if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['create-user'])) {

                $this->addUser();
            }
            if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['update-user'])) {
                $this->updateUser($_POST['user_id']);
            }
            if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['delete-user'])) {
                $this->deleteUser($_POST['user_id']);
            }
            if ($this->utils->getUri() == '/profil') {
                switch ($_SESSION["role"]) {
                    case "admin":
                        $this->controllerProfil->getProfils();
                        break;
                    case "collaborateur":
                        $this->controllerProfil->getProfilsCollaborateur($_SESSION["collaborateur_id"]);
                        break;
                    default:
                        break;
                }
            }

            if ($this->utils->getUri() == '/updateProfil') {
                $this->controllerProfil->displayProfilEditableFormPublic();
                // header('Location: user/profilComponent/view/profil.php');
                exit();
            }
        }

        public function deleteUser($userId)
        {
            $this->controllerProfil->controllerDeleteUser($userId);
        }


        public function displayProfilEditableForm()
        {

            $this->controllerProfil->displayProfilEditableFormPublic();
        }
        public function updateUser($id)
        {
            $this->controllerProfil->controllerUpdateUser($id, $this->getObjUser());
        }



        public function addUser()
        {

            $objUser = $this->getObjUser();

            if ($objUser) {
                $this->controllerProfil->controllerAddUser($objUser);
            }
        }

        public function getObjUser()
        {
            if (isset($_POST["user_name"]) && isset($_POST["user_email"]) && isset($_POST["user_password"]) && isset($_POST["user_role"])) {

                $objUser = new User(
                    $this->sanitize_input($_POST["user_name"]),
                    $this->sanitize_input($_POST["user_email"]),
                    $this->sanitize_input($_POST["user_password"]),
                    $this->sanitize_input($_POST["user_role"]),
                    date('Y-m-d H:i:s')
                );

                return $objUser;
            } else {
                echo "<script>alert('Veuillez remplir tous les champs');</script>";
                return null;
            }
        }
        public function sanitize_input($data)
        {
            return htmlspecialchars(stripslashes(trim($data)));
        }
    }

    new IndexProfil();
