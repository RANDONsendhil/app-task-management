<?php
define('BASE_PATH', __DIR__);
// Get the 'page' parameter from the AJAX request
$page = isset($_GET['page']) ? $_GET['page'] : '';

// Use a switch statement to return different content based on the 'page' value
switch ($page) {
  case 'home':

    header("Location: /user/homeComponent/view/displayHome.php");
    break;
  case 'profil':
    header("Location: /user/profilComponent/view/profil.php");
    break;
  case 'page3':
    echo "<h1>Welcome to Page 3</h1><p>This is the content of Page 3.</p>";
    break;
  default:
    echo "<h1>Welcome</h1><p>Click a button to load content dynamically.</p>";
    break;
}