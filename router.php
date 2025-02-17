<?php


$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$currentDir = dirname($_SERVER['PHP_SELF']);

$routes = [
  '/' =>  BASE_PATH . '/userCreationComponent/public/index.php',
  '/userCreation' =>  BASE_PATH . '/userCreationComponent/public/index.php',
  '/login' =>  BASE_PATH . '/loginComponent/view/login.php',
  '/home' =>  BASE_PATH . '/user/homeComponent/public/index.php',
  '/profil' =>   BASE_PATH . '/user/profilComponent/public/index.php',
  '/updateProfil' =>   BASE_PATH . '/user/profilComponent/public/index.php',
  '/name' =>   BASE_PATH . '/utilisateur/public/index.php',
  '/home/selectDoctor/appointment'  =>   BASE_PATH . '/appointmentComponent/public/index.php',
  '/home/selectDoctor'  =>   BASE_PATH . '/appointmentComponent/public/index.php',
];

// echo '<br>';
// print_r($routes);s
// print_r("<br>");
// print_r("CURRENT DIR" . $currentDir);
function route_controller($requestUri, $routes)
{
  array_key_exists($requestUri, $routes) ? require  $routes[$requestUri] : abort();
}
function abort()
{
  http_response_code(404);
  echo ("Page Not Found !");
  die();
}

route_controller($requestUri, $routes);
