<?php
include(BASE_PATH . '/adminComponent/view/home/ad_home.php');
?>
<div class="content">

  <div class="">
    <fieldset>
      <legend>
        <h4>Tableau de bord Admin</h4>
      </legend>

      <div class="container-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Afficher les Patients</h4>
            <p class="card-text">Consulter ou Supprimer des patients</p>
            <form action="/admin/home/display-list-admin-patients" method="post">
              <button name="display-list-admin-patients" value="display-list-admin-patients"
                class="btn btn-info btn-sm">Afficher les Patients</button>
            </form>
          </div>

          <div class="card-body">
            <h4 class="card-title">Afficher les rendez-vous patient</h4>
            <p class="card-text">Consulter ou Supprimer un rendez-vous des patients </p>
            <form action="/admin/home/display-appointment-patients" method="post">
              <button name="display-appointments-admin-patients" value="display-appointment-admin-patients"
                class="btn btn-info btn-sm">Afficher les rendez-vous
                patients</button>
            </form>
          </div>


          <div class="card-body">
            <h4 class="card-title">Afficher les Rendez-vous médecin</h4>
            <p class="card-text">Consulter ou Supprimer un rendez-vous des docteurs</p>
            <form action="/admin/home/display-appointment-doctors" method="post">
              <button name="display-appointment-admin-doctors" value="display-appointment-admin-doctors"
                class="btn btn-info btn-sm">Afficher les
                rendez-vous Médecin</button>
            </form>
          </div>
          <div class="card-body">
            <h4 class="card-title">Les Medecins</h4>
            <p class="card-text">Afficher la liste des médecin du cabinet</p>
            <form action="/admin/home/display-doctors" method="post">
              <button name="display-admin-doctors" value="display-appointment-admin-doctors"
                class="btn btn-info btn-sm">Afficher les Médecins</button>
            </form>
          </div>
          <div class="card-body">
            <h4 class="card-title">Les Admins</h4>
            <p class="card-text">Afficher la liste des admin enregistré</p>
            <form action="/admin/home/display-list-admins" method="post">
              <button name="display-list-admins" value="display-list-admins" class="btn btn-info btn-sm">Afficher les
                Admins</button>
            </form>
          </div>
        </div>
      </div>
  </div>
</div>