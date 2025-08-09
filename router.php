<?php


$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$currentDir = dirname($_SERVER['PHP_SELF']);

$routes = [
  '/' =>  BASE_PATH . '/loginComponent/view/login.php',
  '/login' =>  BASE_PATH . '/loginComponent/view/login.php',
  '/logout' =>  BASE_PATH . '/loginComponent/public/logout.php',
  '/userCreation' =>  BASE_PATH . '/userCreationComponent/public/index.php',
  '/profil' =>   BASE_PATH . '/user/profilComponent/public/index.php',
  '/project' =>  BASE_PATH . '/user/homeComponent/public/index.php',
  '/project/tasks' =>  BASE_PATH . '/projectComponent/public/index.php',
  '/login/submit-login'  =>   BASE_PATH . '/loginComponent/public/index.php',
];
// print_r("CURRENT DIR" . $currentDir);
function route_controller($requestUri, $routes)
{
  // Handle static files (CSS, JS, images)
  if (preg_match('/\.(css|js|png|jpg|jpeg|gif|svg|ico)$/', $requestUri)) {
    $filePath = BASE_PATH . $requestUri;
    if (file_exists($filePath)) {
      // Set appropriate content type
      $ext = pathinfo($requestUri, PATHINFO_EXTENSION);
      $contentTypes = [
        'css' => 'text/css',
        'js' => 'application/javascript',
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'svg' => 'image/svg+xml',
        'ico' => 'image/x-icon'
      ];

      if (isset($contentTypes[$ext])) {
        header('Content-Type: ' . $contentTypes[$ext]);
      }

      readfile($filePath);
      return;
    }
  }

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
