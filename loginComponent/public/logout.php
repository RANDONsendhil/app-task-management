<?php
define('BASE_PATH', dirname(__DIR__, 2));
require_once(BASE_PATH . '/config/basePath.php');
require_once(BASE_PATH . '/loginComponent/controller/controllerLogin.php');

// Handle POST request for logout
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $controller = new ControllerLogin();

  // Destroy session
  if ($controller->logout()) {
    // Return JSON response for AJAX request
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'message' => 'Logged out successfully']);
    exit();
  } else {
    header('Content-Type: application/json');
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Logout failed']);
    exit();
  }
}

// Handle GET request for logout (fallback)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $controller = new ControllerLogin();

  // Destroy session
  $controller->logout();

  // Redirect to login page
  header('Location: /login');
  exit();
}

// Default redirect if method not supported
header('Location: /login');
exit();
