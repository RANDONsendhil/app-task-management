<?php

// echo "here" . "<br>";

// // Parse the URL
// $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// $currentDir = dirname($_SERVER['PHP_SELF']);
// $baseUrl = (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . $currentDir;

// // Define a simple routing mechanism
// switch ($baseUrl) {
//   case $baseUrl . '/':
//     print_r("here " . $baseUrl);
//     homePage();
//     break;
//   case $baseUrl . '/about':
//     echo "ABOUT ";
//     aboutPage();
//     break;
//   case '/contact':
//     contactPage();
//     break;
//   default:

//     print_r("BASE URI " . $baseUrl . '/');
//     http_response_code(404);

//     echo "404 Not Found";
//     break;
// }

// // Function for the home page
// function homePage()
// {
//   print_r(BASE_PATH . '/utilisateur/public/index.php');
//   require  BASE_PATH . '/utilisateur/public/index.php';
// }

// // Function for the about page
// function aboutPage()
// {
//   echo "This is the about page.";
// }

// // Function for the contact page
// function contactPage()
// {
//   echo "Contact us at example@example.com.";
// }
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$currentDir = dirname($_SERVER['PHP_SELF']);
$routes = [
  '/' =>  BASE_PATH . '/home/public/index.php',
  '/user' =>   BASE_PATH . '/utilisateur/public/index.php'
];
print_r($requestUri);
echo '<br>';
print_r($routes);
print_r("<br>");
print_r("CURRENT DIR" . $currentDir);


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
