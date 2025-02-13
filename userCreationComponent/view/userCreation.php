<main>
  <?php
  include(BASE_PATH . "/index/nav.php");
  ?>
  <fieldset>
    <div class="container">


      <legend class="text-center m-4">
        <h4>CRÉER UN COMPTE</h4>
      </legend>
      <div class="container-sm shadow-lg p-3  bg-body-tertiary rounded">
        <form class="row g-3" method="POST" action="/">
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
            <label for="inputAddress" class="form-label">Numéro de Sécurité Sociale</label>
            <input type="text" class="form-control" id="numSS" name="numSS" placeholder="" required>
          </div>
          <div class="col-md-6">
            <label for="lname" class="form-label">Nom*</label>
            <input type="lname" class="form-control" id="lname" name="lname" required>
          </div>
          <div class="col-md-6">
            <label for="sname" class="form-label">Prénom*</label>
            <input type="sname" class="form-control" id="fname" name="fname" required>
          </div>
          <div class="col-md-6">
            <label for="inputEmail" class="form-label">Email*</label>
            <input type="email" class="form-control" id="inputEmail" , name="inputEmail" required>
          </div>
          <div class="col-md-6">
            <label for="inputPassword" class="form-label">Mot de Passe*</label>
            <input type="password" class="form-control" id="inputPassword" name="inputPassword" required>
          </div>

          <div class="col-md-6">
            <label for="mobileNum" class="form-label">Téléphone Portable*</label>
            <input type="mobileNum" class="form-control" id="mobileNum" name="mobileNum" required>
          </div>
          <div class="col-md-6">
            <label for="phoneNum" class="form-label">Téléphone Fixe</label>
            <input type="phoneNum" class="form-control" id="phoneNum" name="phoneNum" required>
          </div>

          <div class="col-12">
            <label for="inputAddress" class="form-label">Address</label>
            <input type="text" class="form-control" id="inputAddress" name="inputAddress" placeholder="Address">
          </div>
          <div class="col-md-6">
            <label for="inputCity" class="form-label">Commune</label>
            <input type="text" class="form-control" id="inputCity" name="inputCity">
          </div>

          <div class="col-md-6">
            <label for="inputZip" class="form-label">Code Postal</label>
            <input type="text" class="form-control" id="inputZip" name="inputZip">
          </div>

          <div class="d-grid gap-2 mt-4 d-flex justify-content-end">
            <div class="grid text-center d-inline-flex gap-1">


              <div class="fg-col-4">
                <input class="btn btn-danger btn-lg" type="submit" value="Annuler">
              </div>

              <div class="g-col-4">
                <input class="btn btn-primary btn-lg" type="submit" name="create-user" value="Créer un Compte">
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