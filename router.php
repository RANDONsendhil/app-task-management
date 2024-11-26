<?php
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$currentDir = dirname($_SERVER['PHP_SELF']);
$routes = [
  '/' =>  BASE_PATH . '/home/public/index.php',
  '/user' =>   BASE_PATH . '/utilisateur/public/index.php'
];
// print_r($requestUri);
// echo '<br>';
// print_r($routes);
// print_r("<br>");
// print_r("CURRENT DIR" . $currentDir);
function route_controller($requestUri, $routes)
{
  array_key_exists($requestUri, $routes) ? require  $routes[$requestUri] : abort();
}
function abort()
{
  http_response_code(404);
  echo("Page Not Found !");
  die();
}

route_controller($requestUri, $routes);
