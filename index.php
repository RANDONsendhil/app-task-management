<?php define('BASE_PATH', __DIR__);
?>

<?php
// Get the 'page' parameter from the URL (default to 'home' if not set)
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.5, user-scalable=yes">



  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>REGISTRATION APP</title>
</head>

<link rel="stylesheet" href="/css/other/bootstrap-grid.css">
<link rel="stylesheet" href="/css/other/bootstrap-grid.min.css">
<link rel="stylesheet" href="/css/other/bootstrap-doc.css">
<link rel="stylesheet" href="/css/other/bootstrap.min.css">
<link rel="stylesheet" href="/css/other/bootstrap.css">
<link rel="stylesheet" href="/css/style.css">
<link rel="stylesheet" href="/user/homeComponent/view/css/style.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/other/jquery-3.6.0.min.js"></script>
<script src="js/other/scriptBootstrap.js"></script>



<body>
  <header>
  </header>
  <?php
  require BASE_PATH . '/router.php'; ?>
  </div>

  <script src="user/homeComponent/view/js/script.js"></script>
  <script src="js/common/script.js"></script>
  <script src="/js/common/script.js"></script>

</body>