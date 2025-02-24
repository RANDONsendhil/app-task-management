<?php

require_once(BASE_PATH . '/user/homeComponent/controller/controllerHome.php');
$currentDir = dirname($_SERVER['PHP_SELF']);
$controllerHome = new ControllerHome();


if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['save-user'])) {
    return;
} else {
    $controllerHome->index();
}