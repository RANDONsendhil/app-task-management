<?php
require_once(BASE_PATH . '/config/utils.php');
require_once(BASE_PATH . '/utilisateur/controller/controllerUtilisateur.php');
$currentDir = dirname($_SERVER['PHP_SELF']);
$controllerUtilisateur = new ControllerUtilisateur();

if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['save-user'])) {

  $uname = $_POST["username"];
  $userId = $_POST["userId"];
  $userAddress = $_POST["userAddress"];
  $controllerUtilisateur->add_user($userId, $uname, $userAddress);
} elseif (($_SERVER['REQUEST_METHOD'] === 'GET')  && isset($_GET['get-users'])) {
  new Log(("HERE GET METHOD"));
  $controllerUtilisateur->get_list_users();
} else {
  $controllerUtilisateur->index();
}
