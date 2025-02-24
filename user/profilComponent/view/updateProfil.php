<?php

define('BASE_PATH', __DIR__);

include(BASE_PATH . '/user/homeComponent/view/home.php');
session_start();

$status = isset($_SESSION['retStatus']) ? $_SESSION['retStatus'] : null;
$message = isset($_SESSION['retMessage']) ? $_SESSION['retMessage'] : "";
unset($_SESSION['statusDelete']);
unset($_SESSION['message']);
?>


<div class="container-card">

  <fieldset>
    <legend>
      <h5>MODFIFICATION DU PROFIL</h5>
    </legend>

    <div class="content-container">
      <div class="container shadow-lg p-3  bg-body-tertiary rounded" id="containerCreationCompte">
        <form class="row g-2" method="POST" action="/profil">

          <div class="form-group">
            <?php htmlspecialchars($_SESSION['genre']) ?>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" id="madame" name="genre" value="madame"
                <?php if (htmlspecialchars($_SESSION['genre']) == "madame") echo "checked"; ?>>
              <label class="form-check-label" for="madame" value=checked> Madame</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" id="monsieur" name="genre" value="monsieur"
                <?php if (htmlspecialchars($_SESSION['genre']) == "monsieur") echo "checked"; ?>>
              <label class="form-check-label g-col-md-" for=" monsieur"> Monsieur
            </div>
          </div>
          <div class="col-12">
            <label for="inputAddress">Numéro de Sécurité Sociale</label>
            <input type="text" class="form-control" id="numSS" name="numSS"
              value="<?php echo htmlspecialchars($_SESSION['numSS']) ?>" required>
          </div>
          <div class="col-md-6">
            <label for="lname">Nom*</label>
            <input type="text" class="form-control" id="lname" name="lname"
              value="<?php echo htmlspecialchars($_SESSION['lname']) ?>" required>
          </div>
          <div class=" col-md-6">
            <label for="sname">Prénom*</label>
            <input type="text" class="form-control" id="fname" name="fname"
              value="<?php echo htmlspecialchars($_SESSION['fname']) ?>" required>
          </div>
          <div class=" col-md-6">
            <label for="inputEmail">Email*</label>
            <input type="text" class="form-control" id="inputEmail" , name="inputEmail"
              value="<?php echo htmlspecialchars($_SESSION['inputEmail']) ?>" required>
          </div>
          <div class=" col-md-6">
            <label for="inputPassword">Mot de Passe*</label>
            <input type="text" class="form-control" id="inputPassword" name="inputPassword"
              value="<?php echo htmlspecialchars($_SESSION['inputPassword']) ?>" required>
          </div>

          <div class=" col-md-6">
            <label for="mobileNum">Téléphone Portable*</label>
            <input type="text" class="form-control" id="mobileNum" name="mobileNum"
              value="<?php echo htmlspecialchars($_SESSION['mobileNum']) ?>" required>
          </div>
          <div class=" col-md-6">
            <label for="phoneNum">Téléphone Fixe</label>
            <input type="text" class="form-control" id="phoneNum" name="phoneNum"
              value="<?php echo htmlspecialchars($_SESSION['phoneNum']) ?>" required>
          </div>

          <div class=" col-12">
            <label for="inputAddress">Address</label>
            <input type="text" class="form-control" id="inputAddress" name="inputAddress"
              value="<?php echo htmlspecialchars($_SESSION['inputAddress']) ?>">
          </div>
          <div class=" col-md-6">
            <label for="inputCity">Commune</label>
            <input type="text" class="form-control" id="inputCity" name="inputCity"
              value="<?php echo htmlspecialchars($_SESSION['inputCity']) ?>">
          </div>

          <div class=" col-md-6">
            <label for="inputZip">Code Postal</label>
            <input type="text" class="form-control" id="inputZip" name="inputZip"
              value="<?php echo htmlspecialchars($_SESSION['inputZip']) ?>">
          </div>

          <div class="d-grid gap-2 mt-4 d-flex justify-content-end">
            <div class="grid text-center d-inline-flex gap-1">
              <div class="fg-col-4">
                <input class="btn btn-secondary btn-sm" value=" Abandonner" onclick="redirectPage('/profil')">
              </div>
              <div class="g-col-4">
                <input class="btn btn-primary btn-sm" type="submit" name="save-update-profil"
                  value="Mettre à jour mon Profil">
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </fieldset>
</div>