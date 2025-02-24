<?php
require_once(BASE_PATH . '/config/database.php');
require_once(BASE_PATH . '/home/model/home.php');

class ControllerAdmin
{

  private $db;

  public function __construct() {}

  public function index()
  {
    require(BASE_PATH . '/admin/view/admin.php');
  }
}