<?php

require_once(BASE_PATH . '/config/database.php');
require_once(BASE_PATH . '/user/profilComponent/model/profil.php');

class Controllerprofil
{
    private $profilModel;
    private $db;

    public function __construct()
    {
        $this->db = new DatabaseConnection();
        $this->profilModel = new Profil($this->db);
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
}
