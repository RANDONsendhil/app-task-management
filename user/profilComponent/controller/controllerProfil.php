<?php

require_once(BASE_PATH . '/config/database.php');
require_once(BASE_PATH . '/user/profilComponent/model/profil.php');
require_once(BASE_PATH . '/userCreationComponent/model/userCreation.php');



class Controllerprofil
{
    private $profilModel;
    private $db;
    private $userCreationModel;

    public function __construct()
    {
        $this->db = new DatabaseConnection();
        $this->profilModel = new Profil($this->db);
        $this->userCreationModel = new UserCreationModel($this->db);
    }

    public function index($numSS)
    {
        $this->displayProfilUser($numSS);
    }

    public function displayListUser()
    {
        $myUserData = $this->profilModel->displayUserList();
        require(BASE_PATH . '/user/profilComponent/view/profil.php');
    }

    public function displayProfilUser($numSS)
    {
        $dataByNumss = $this->profilModel->displayUserbyNumSS($numSS);
        require(BASE_PATH . '/user/profilComponent/view/profil.php');
    }

    public function displayProfilEditableFormPublic()
    {

        require(BASE_PATH . '/user/profilComponent/view/updateProfil.php');
    }

    public function saveProfilController($objUser)
    {

        $this->userCreationModel->update_user($objUser);
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