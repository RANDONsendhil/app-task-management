<?php

require_once(BASE_PATH . '/config/database.php');
require_once(BASE_PATH . '/user/profilComponent/model/profil.php');
require_once(BASE_PATH . '/userCreationComponent/model/userCreation.php');



class Controllerprofil
{
    private $profilModel;
    private $db;

    public function __construct()
    {
        $this->db = new DatabaseConnection();
        $this->profilModel = new Profil($this->db);
    }

    public function getProfils()
    {
        $dataUserGest = $this->profilModel->displayProfils();
        // echo "<script>alert('Profils loaded successfully: " . json_encode($dataUserGest) . "');</script>";
        require(BASE_PATH . '/user/profilComponent/view/profil.php');
    }



    public function displayProfilEditableFormPublic()
    {

        require(BASE_PATH . '/user/profilComponent/view/updateProfil.php');
    }

    public function controllerDeleteUser($id)
    {
        return $this->profilModel->delete_user($id);
    }

    public function controllerAddUser($objUser)
    {

        return $this->profilModel->insert_user($objUser);
    }

    public function controllerUpdateUser($id, $objUser)
    {

        $this->profilModel->update_user($id, $objUser);
    }

    public function findDoctor()
    {
        require(BASE_PATH . '/user/profilComponent/view/findDoctor.php');
    }

    public function contactAssistant()
    {
        require(BASE_PATH . '/user/profilComponent/view/contact.php');
    }

    public function displayUrgentNumbers()
    {
        require(BASE_PATH . '/user/profilComponent/view/urgentNumbers.php');
    }
}
