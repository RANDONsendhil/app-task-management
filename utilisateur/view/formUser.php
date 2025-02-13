<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Registration Form</title>
</head>

<body>


  <div class="user-table-header">
    <div id="confirmMessg">
      <?php include("confirmation.php") ?>
    </div>

    <div class="table-info">
      <div>
        <button class="btn btn-info" id="btn_display_form" onclick="display_userCreation_form()">Create User</button>
      </div>
    </div>
  </div>

  <div id="form_user" class="modal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">USER REGISTRATION</h5>

        </div>
        <div class="modal-body">
          <form method="post" action="/user" onsubmit="return validateFormUserCreation()">

            <span class="error"> <?php echo "*" . $_SESSION['message']; ?></span>
            <div id="divId">
              <label for="userId"> User Id:
                <input type="number" name="userId" placeholder="userId" id="userId">
              </label>
            </div>

            <div>
              <label for="username"> User Name:
                <input type="text" name="username" placeholder="username" id="username">
              </label>
            </div>

            <div>
              <label for="userAddress"> User Address:
                <input type="text" name="userAddress" placeholder="userAddress" id="userAddress">
              </label>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <input type="submit" value="Save User" name="save-user" class="btn btn-primary">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="../../utilisateur/view/js/script.js"></script>
  <link rel="stylesheet" href="../../utilisateur/view/css/style.css">
  <script>
    let messg = document.getElementById("confirmMessg");

    function messageTimeout() {
      messg.style.display = "none";
    }
    setTimeout(messageTimeout, 2000);
  </script>
</body>

</html>