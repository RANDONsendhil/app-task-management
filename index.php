


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
<body>
  <script src="js/other/jquery-3.6.0.min.js"></script>
  <script src="js/other/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/other/bootstrap.min.css">

   <!-- Header -->
   <header>
        <h1>USER REGISTRATION APPLICATION</h1>
    </header>
    <!-- Navbar -->
    <nav>
        <a href="/">Home</a>
        <a href="user">Clients</a>
        <a href="services">Agenda</a>
        <a href="contact">Contact</a>
    </nav>

    <!-- Main Content -->
    <main>
      <div class="container">
      <?php
        define('BASE_PATH', __DIR__);
require BASE_PATH . '/router.php';
?>
      </div>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy;  FOOTER</p>
    </footer>

 
    </body>
 