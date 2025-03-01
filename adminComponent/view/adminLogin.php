<style>
  .containerLogin {
    margin: auto;
    max-width: 500px;
    padding: 39px 11px;
    width: 400px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    top: 3px;

  }

  .btn {
    width: 175px;
  }
</style>

<?php

session_start();
$status = isset($_SESSION['statusLoginAdmin']) ? $_SESSION['statusLoginAdmin'] : null;
$message = isset($_SESSION['messageLoginAdmin']) ? $_SESSION['messageLoginAdmin'] : "";
unset($_SESSION['statusLoginAdmin']);
unset($_SESSION['messageLoginAdmin']);
?>
<main>
  <?php
  include(BASE_PATH . "/index/navAdmin.php")
  ?>
  <fieldset>
    <div class="containerLogin">

      <legend>
        <h5 class="text-center m-0">SE CONNECTER</h5>
      </legend>
      <div class="container-mb-10">
        <div class="container-sm shadow-lg p-3 mb-5 bg-body-tertiary rounded">
          <form id="loginFormAdmin" method="POST" action="/admin/submit-login-admin">
            <div class="form-group">
              <label for="username">Identifiant Admin</label>
              <input type="text" name="id_admin" id="id_admin" required><br><br>
              <label for="password">Mot de Passe</label>
              <input type="text" name="password_admin" id="password_admin" required>
              <div class="d-grid gap-2 mt-4 d-flex justify-content-center">
                <div class="grid text-center d-inline-flex gap-1">


                  <div class="g-col-3">
                    <input id="loginButtonAdmin" class="btn btn-primary btn-sm" name="connect-admin" type="submit"
                      value="Se Connecter">
                  </div>

                </div>
              </div>
          </form>
        </div>
      </div>
    </div>

  </fieldset>
</main>
<?php
include(BASE_PATH . "/index/footer.php")
?>
</body>
<div class="modal fade" id="modelLoginAdmin" tabindex="-1" aria-labelledby="modelLoginAdminLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modelLoginAdminLabel" style="color: #0c3783;">Information.</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="message">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("loginFormAdmin").addEventListener("keypress", function(event) {
      if (event.key === "Enter") {
        event.preventDefault(); // Prevent default form submission
        document.getElementById("loginButtonAdmin").click(); // Simulate button click
      }
    });
  });

  var status = <?php echo json_encode($status); ?>;
  var message = <?php echo json_encode($message); ?>;
  if (status === "success") {

  } else if (status === "error") {
    var modelLoginAdmin = new bootstrap.Modal(document.getElementById('modelLoginAdmin'));
    document.getElementById("message").style.color = "#13168f";
    document.getElementById("message").innerHTML = "<h5>" + message + "</h5>";
    modelLoginAdmin.show();
  }
</script>