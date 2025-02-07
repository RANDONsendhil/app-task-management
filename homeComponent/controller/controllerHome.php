<?php

require_once(BASE_PATH . '/config/database.php');
require_once(BASE_PATH . '/homeComponent/model/home.php');

class Controllerhome
{
    private $utilsateurModel;
    private $db;

    public function __construct()
    {
    }

    public function index()
    {
        require(BASE_PATH . '/homeComponent/view/home.php');
    }
}