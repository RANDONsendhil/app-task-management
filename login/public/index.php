<?php

require_once(BASE_PATH . '/login/controller/controllerLogin.php');
$currentDir = dirname($_SERVER['PHP_SELF']);
$controllerLogin = new ControllerLogin();
// if (($_SERVER['REQUEST_METHOD'] === 'GET') && isset($_POST['save-user'])) {
//     return;
// } else {

//     $controllerLogin -> index();
// }
$controllerLogin -> index();