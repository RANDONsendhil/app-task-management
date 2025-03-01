<?php
include(BASE_PATH . '/adminComponent/view/home/ad_home.php');
session_start();
$status = isset($_SESSION['statusUpdateProfilAdmin']) ? $_SESSION['statusUpdateProfilAdmin'] : null;
$messageAdmin = isset($_SESSION['messageUpdateProfilAdmin']) ? $_SESSION['messageUpdateProfilAdmin'] : "";
unset($_SESSION['statusUpdateProfilAdmin']);
unset($_SESSION['messageUpdateProfilAdmin']);

?>
<div class="container" id="contentProfil">

  <fieldset>
    <legend>
      <h5>Modifer le Profil ADMIN</h5>
    </legend>
    <div class="container-card">
      <div id="containerCreationCompte">
        <div class="container shadow-lg p-3  bg-body-tertiary rounded">
          <form class="row g-2" method="POST" action="">
            <?php foreach ($dataAdminById as $adminData): ?>
              <div class="col-12">
                <label for="inputAddress">id_admin</label>
                <input type="text" class="form-control" id="id_admin" name="id_admin"
                  value="<?php echo $adminData['id_admin']; ?>">
              </div>
              <div class="col-md-6">
                <label for="lname">Nom*</label>
                <input type="text" class="form-control" id="lname" name="lname"
                  value="<?php echo $adminData['lname']; ?>">
              </div>
              <div class="col-md-6">
                <label for="sname">Prénom*</label>
                <input type="text" class="form-control" id="fname" name="fname"
                  value="<?php echo $adminData['fname']; ?>">
              </div>
              <div class="col-md-6">
                <label for="email">Email*</label>
                <input type="text" class="form-control" id="email" , name="email"
                  value="<?php echo $adminData['email']; ?>">
              </div>
              <div class="col-md-6">
                <label for="password">Mot de Passe*</label>
                <input type="text" class="form-control" id="password" name="password"
                  value="<?php echo $adminData['password']; ?>">
              </div>

              <div class="col-md-6">
                <label for="phone">Téléphone Portable*</label>
                <input type="text" class="form-control" id="phone" name="phone"
                  value="<?php echo $adminData['phone']; ?>">
              </div>
            <?php endforeach; ?>
            <div class="d-grid gap-2 mt-4 d-flex justify-content-end">
              <div class="grid text-center d-inline-flex gap-1">


                <div class="fg-col-4">
                  <input class="btn btn-secondary btn-sm" type="reset" value="Annuler">
                </div>

                <div class="g-col-4">
                  <input class="btn btn-danger btn-sm" type="submit" name="updateProfil-admin" value="Modifier">
                </div>
              </div>
            </div>
          </form>
        </div>


  </fieldset>
</div>