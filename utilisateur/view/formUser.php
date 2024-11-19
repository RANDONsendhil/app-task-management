<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../../utilisateur/view/css/style.css">
  <script src="../../utilisateur/view/js/script.js"></script>
</head>

<body>
<?php
  include('confirmation.php');
?>
<button id="btn_display_form" onclick="display_userCreation_form()">Create User</button>
<div id="form_user" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>Some text in the Modal..</p>

    <form method="post">
      <div>
        <div>
          <label for="userId"> User Id:
            <input type="text" name="userId" placeholder="userId" id="userId">
          </label>
        </div>
        <label for="username"> User Name:
          <input type="text" name="username" placeholder="username" id="username">
        </label>
      </div>
      <div>
        <label for="userAddress"> User Address:
          <input type="text" name="userAddress" placeholder="userAddress" id="userAddress">
        </label>
      </div>
      <input type="submit" value="Add" name="save-user">
    </form>
    </div>
  </div>
</body>

</html>