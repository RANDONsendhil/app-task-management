<main>
  <?php
  include(BASE_PATH . "/index/nav.php");
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
          <div class="col-12">
            <label for="inputAddress">Numéro de Sécurité Sociale</label>
            <input type="text" class="form-control" id="numSS" name="numSS" placeholder="" required>
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
          <div class="col-md-6">
            <label for="inputCity">Commune</label>
            <input type="text" class="form-control" id="inputCity" name="inputCity">
          </div>

          <div class="col-md-6">
            <label for="inputZip">Code Postal</label>
            <input type="text" class="form-control" id="inputZip" name="inputZip">
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
</body>