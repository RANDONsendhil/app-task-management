<?php
include('database.php');
include('utilisateur.php');

$db = new DatabaseConnection();

if (isset($_POST['save-user'])) {

  $uname = $_POST["username"];
  $userId = $_POST["userId"];
  $userAddress = $_POST["userAddress"];
  echo $uname . " , " . $userId . " , " . $userAddress;

  $user = new Utilisateur($db, $uname, $userId, $userAddress);

  $user->add_user();
}
