<?php

require_once(BASE_PATH . '/user/profilComponent/controller/controllerProfil.php');
$currentDir = dirname($_SERVER['PHP_SELF']);
$controllerProfil = new ControllerProfil();
if (($_SERVER['REQUEST_METHOD'] === 'POST')) {
    return;
} else {

    $controllerProfil->index($numss = "12345");
}
