<?php define('BASE_PATH', __DIR__);
?>
<!DOCTYPE html>
<?php
// Get the 'page' parameter from the URL (default to 'home' if not set)
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>REGISTRATION APP</title>
</head>

<link rel="stylesheet" href="/css/other/bootstrap-doc.css" rel="stylesheet">
<link rel="stylesheet" href="/css/other/bootstrap.min.css">
<link rel="stylesheet" href="/css/other/bootstrap.css">
<link rel="stylesheet" href="/css/other/bootstrap-grid.css">
<link rel="stylesheet" href="/css/other/bootstrap-grid.min.css">
<link rel="stylesheet" href="/css/style.css">

<body>
  <header>

    <main>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid" id="container-nav-bar">
          <a class="nav-item" href="#">
            <img style="height: 150px;" src="/css/image/logo.png" alt="" srcset="">
          </a>
          <!------ NAV BAR ITEM ------>
          <div class="d-flex justify-content-center align-items-center navbar-container">
            <div class="collapse navbar-collapse">


              <ul class="navbar-nav mx-auto ">

                <li class="nav-item mx-2">
                  <a class="nav-link" href="/">Création de compte</a>
                </li>
                <li class="nav-item nav-item mx-2">
                  <a class="nav-link" href="#">Questions fréquentes</a>
                </li>
                <li class="nav-item nav-item mx-2">
                  <a class="nav-link" href="#">Professionnels de santé</a>
                </li>
              </ul>
            </div>
          </div>
          <!------ NAV BAR ITEM ------>
          <div class="container-login">
            <ul class="navbar-nav ms-auto">
              <!-- Login Icon -->
              <li class="nav-item">
                <a id="nav-login" class="nav-link" href="/login">
                  <i class="fas fa-sign-in-alt"></i>Mon Compte
                </a>
              </li>
            </ul>
          </div>
      </nav>
  </header>
  <main>

    <div class="container">
      <?php
      require BASE_PATH . '/router.php'; ?>
    </div>
  </main>
  <footer>
    <p>&copy; FOOTER</p>
  </footer>
</body>