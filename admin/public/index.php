<?php
require_once(BASE_PATH . '/admin/controller/controllerAdmin.php');
$currentDir = dirname($_SERVER['PHP_SELF']);
$controllerAdmin = new ControllerAdmin();

$controllerAdmin->index();