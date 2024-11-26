<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Registration Form</title>
</head>

<body>
  <?php include("confirmation.php")?>
  <button id="btn_display_form" onclick="display_userCreation_form()">Create User</button>
    <div id="form_user" class="modal" tabindex="-1"> 
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">USER REGISTRATION</h5>
           
          </div>
          <div class="modal-body">
            <form method="post" action="/user" onsubmit="return validateForm()">
             
            <span class="error"> <?php echo "*". $_SESSION['message'] ;?></span>
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
</body>

</html>
