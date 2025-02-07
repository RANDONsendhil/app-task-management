<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
</head>

<body>
  <h2>Login Page</h2>

  <?php
    // Display error message if login failed
    if (isset($error_message)) {
        echo "<p style='color:red;'>$error_message</p>";
    }
  ?>

  <form method="POST" action="login.php">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required><br><br>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required><br><br>
    <input type="submit" value="Login">
  </form>
</body>

</html>