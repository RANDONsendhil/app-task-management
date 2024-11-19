<?php
// session_start();

if (isset($_SESSION['message'])) {
  echo  $_SESSION['message'];
  unset($_SESSION['message']); // Clear the message after displaying
} elseif ($_SESSION['message-delete-user']) {
  echo  $_SESSION['message-delete-user'];
  unset($_SESSION['message-delete-user']);
} else {
  echo "<p>No message available.</p>";
}
