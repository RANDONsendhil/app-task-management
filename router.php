<?php


$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$currentDir = dirname($_SERVER['PHP_SELF']);

$routes = [
  '/' =>  BASE_PATH . '/loginComponent/view/login.php',
  '/login' =>  BASE_PATH . '/loginComponent/view/login.php',
  '/userCreation' =>  BASE_PATH . '/userCreationComponent/public/index.php',
  '/home' =>  BASE_PATH . '/user/homeComponent/public/index.php',
  '/home/selectProject/project' =>  BASE_PATH . '/projectComponent/public/index.php',



  '/userCreation' =>  BASE_PATH . '/userCreationComponent/public/index.php',
  '/login/submit-login'  =>   BASE_PATH . '/loginComponent/public/index.php',
  '/home' =>  BASE_PATH . '/user/homeComponent/public/index.php',
  '/profil' =>   BASE_PATH . '/user/profilComponent/public/index.php',
  '/updateProfil' =>   BASE_PATH . '/user/profilComponent/public/index.php',
  '/name' =>   BASE_PATH . '/utilisateur/public/index.php',
  '/home/selectDoctor/appointment'  =>   BASE_PATH . '/appointmentComponent/public/index.php',
  '/home/displayListDoctors'  =>   BASE_PATH . '/appointmentComponent/public/index.php',
  '/home/selectDoctor'  =>   BASE_PATH . '/appointmentComponent/public/index.php',
  '/home/bookAppoinment'  =>   BASE_PATH . '/appointmentComponent/public/index.php',
  '/home/displayAppointments'  =>   BASE_PATH . '/appointmentComponent/public/index.php',
  '/contact-assistant'  =>   BASE_PATH . '/user/profilComponent/public/index.php',
  '/find-doctors'  =>   BASE_PATH . '/user/profilComponent/public/index.php',
  '/emergency-numbers'  =>   BASE_PATH . '/user/profilComponent/public/index.php',
  '/admin'  =>   BASE_PATH . '/adminComponent/public/index.php',
  '/admin/submit-login-admin'  =>   BASE_PATH . '/adminComponent/public/index.php',
  '/admin/home' =>   BASE_PATH . '/adminComponent/public/index.php',
  '/admin/profil-admin' =>   BASE_PATH . '/adminComponent/public/index.php',
  '/updateProfil-admin' =>   BASE_PATH . '/adminComponent/public/index.php',
  '/admin/home/display-appointment-patients' =>   BASE_PATH . '/adminComponent/public/index.php',
  '/admin/home/display-appointment-doctors' =>   BASE_PATH . '/adminComponent/public/index.php',
  '/admin/home/display-doctors' =>   BASE_PATH . '/adminComponent/public/index.php',
  '/admin/home/display-list-admin-patients' =>   BASE_PATH . '/adminComponent/public/index.php',
  '/admin/home/display-list-admins' =>   BASE_PATH . '/adminComponent/public/index.php'
];

// echo '<br>';
// print_r($routes);s
// print_r("<br>");
// print_r("CURRENT DIR" . $currentDir);
function route_controller($requestUri, $routes)
{
  // echo "<script> alert(" . $_SESSION['isloggedIn'] . ") </script>";
  array_key_exists($requestUri, $routes) ? require  $routes[$requestUri] : abort();
}
function abort()
{
  http_response_code(404);
  echo ("Page Not Found !");
  die();
}

route_controller($requestUri, $routes);