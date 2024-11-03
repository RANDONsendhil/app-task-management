<?php
require_once(BASE_PATH . '/config/database.php');
require_once(BASE_PATH . '/home/model/home.php');

class Controllerhome
{
  private $utilsateurModel;
  private $db;

  public function __construct() {}

  public function index()
  {
    require(BASE_PATH . '/home/view/home.php');
  }
}
