<?php

require_once(BASE_PATH . '/user/profilComponent/controller/controllerProfil.php');
$currentDir = dirname($_SERVER['PHP_SELF']);
$controllerProfil = new ControllerProfil();
if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['save-user'])) {
    return;
} else {
    $controllerProfil->index();
}
