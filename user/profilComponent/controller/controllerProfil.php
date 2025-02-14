<?php

require_once(BASE_PATH . '/config/database.php');
require_once(BASE_PATH . '/user/profilComponent/model/profil.php');

class Controllerprofil
{
    private $utilsateurModel;
    private $db;

    public function __construct() {}

    public function index()
    {
        require(BASE_PATH . '/user/profilComponent/view/profil.php');
    }
}
