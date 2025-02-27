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
            <h4 class="card-title">Afficher les rendez-vous patient</h4>
            <p class="card-text">Consulter ou Supprimer un rendez-vous des patients </p>
            <a href="/admin/home/getallAppointments" class="btn btn-info btn-sm">Rendez-vous</a>
          </div>
          <div class="card-body">
            <h4 class="card-title">Afficher les Rendez-vous médecin</h4>
            <p class="card-text">Consulter ou Supprimer un rendez-vous des patients</p>
            <form action="/home/displayAppointments" method="post">
              <button name="display-appointments-patients" value="display-appointments-patients"
                class="btn btn-info btn-sm">Afficher mes
                rendez-vous</button>
            </form>
          </div>
          <div class="card-body">
            <h4 class="card-title">Les Medecins</h4>
            <p class="card-text">Afficher la liste des médecin du cabinet</p>
            <a href="/home/doctors" class="btn btn-info btn-sm">Afficher les medecins</a>
          </div>
        </div>
      </div>
  </div>
</div>