<main>
  <?php
  include(BASE_PATH . "/index/nav.php");
  session_start();
  $status = isset($_SESSION['statusCreationProfil']) ? $_SESSION['statusCreationProfil'] : null;
  $message = isset($_SESSION['messageCreationProfil']) ? $_SESSION['messageCreationProfil'] : "";
  unset($_SESSION['statusCreationProfil']);
  unset($_SESSION['messageCreationProfil']);
  ?>
  <fieldset>

    <div id="containerCreationCompte">
      <div class="container shadow-lg p-3  bg-body-tertiary rounded">
        <form class="row g-2" method="POST" action="/">
          <legend>
            <h5>CRÉER UN COMPTE</h5>
          </legend>
          <div class="form-group">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" id="madame" name="genre" value="madame">
              <label class="form-check-label" for="madame">Madame</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" id="monsieur" name="genre" value="monsieur">
              <label class="form-check-label g-col-md-" for=" monsieur">Monsieur</label>
            </div>
          </div>
          </div>
          <div class="col-md-6">
            <label for="lname">Nom*</label>
            <input type="text" class="form-control" id="lname" name="lname" required>
          </div>
          <div class="col-md-6">
            <label for="sname">Prénom*</label>
            <input type="text" class="form-control" id="fname" name="fname" required>
          </div>
          <div class="col-md-6">
            <label for="inputEmail">Email*</label>
            <input type="text" class="form-control" id="inputEmail" , name="inputEmail" required>
          </div>
          <div class="col-md-6">
            <label for="inputPassword">Mot de Passe*</label>
            <input type="text" class="form-control" id="inputPassword" name="inputPassword" required>
          </div>

          <div class="col-md-6">
            <label for="mobileNum">Téléphone Portable*</label>
            <input type="text" class="form-control" id="mobileNum" name="mobileNum" required>
          </div>
          <div class="col-md-6">
            <label for="phoneNum">Téléphone Fixe</label>
            <input type="text" class="form-control" id="phoneNum" name="phoneNum" required>
          </div>

          <div class="col-12">
            <label for="inputAddress">Address</label>
            <input type="text" class="form-control" id="inputAddress" name="inputAddress">
          </div>

          <div class="d-grid gap-2 mt-4 d-flex justify-content-end">
            <div class="grid text-center d-inline-flex gap-1">


              <div class="fg-col-4">
                <input class="btn btn-secondary btn-sm" type="submit" value="Annuler">
              </div>

              <div class="g-col-4">
                <input class="btn btn-primary btn-sm" type="submit" name="create-user" value="Créer un Compte">
              </div>
            </div>
          </div>
        </form>
      </div>

  </fieldset>
</main>
<?php
include(BASE_PATH . "/index/footer.php")
?>


<div class="modal fade" id="retCreationModel" tabindex="-1" aria-labelledby="retCreationModelLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="retCreationModelLabel" style="color: #0c3783;">Information.</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="message">
        Votre réservation a été bien prise en compte.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

<script>
var status = <?php echo json_encode($status); ?>;
var message = <?php echo json_encode($message); ?>;
console.log(status);

if (status === "success") {
  var retCreationModel = new bootstrap.Modal(document.getElementById('retCreationModel'));
  document.getElementById("message").style.color = "#13168f";
  document.getElementById("message").innerHTML = "<h5>Votre compte a été crée avec succès</h5>";
  retCreationModel.show();
} else if (status === "error") {

}
</script>
</body>