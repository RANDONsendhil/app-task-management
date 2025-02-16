<?php
session_start();
require_once(BASE_PATH . '/config/database.php');
require_once(BASE_PATH . '/user/homeComponent/model/home.php');

class ControllerHome
{
    private $utilsateurModel;
    private $db;

    public function __construct() {}

    public function index()
    {
        require(BASE_PATH . '/user/homeComponent/view/displayHome.php');
    }
}
