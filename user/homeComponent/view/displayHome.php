<?php
define('BASE_PATH', __DIR__); ?>
<?php
include(BASE_PATH . '/user/homeComponent/view/home.php');
?>
<style>
.card-body a {
  font-size: 14px;

}
</style>
<div class="content">

  <fieldset>
    <legend>
      <h5>Tableau de bord</h5>
    </legend>

    <div class="container-card">

      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Prendre un rendez vous</h4>
          <p class="card-text">Prenez votre rendez vous en ligne</p>
          <a href="/home/selectDoctor" class="btn btn-info btn-sm">Rendez-vous</a>
        </div>
        <div class="card-body">
          <h4 class="card-title">Mes Rendez-vous</h4>
          <p class="card-text">Afficher les rendez-vous en cours, les rendez-vous passés.</p>
          <form action="/home/displayAppointments" method="post">
            <button name="display-appointments" value="display-appointments" class="btn btn-info btn-sm">Afficher mes
              rendez-vous</button>
          </form>
        </div>
        <div class="card-body">
          <h4 class="card-title">Les Medecins</h4>
          <p class="card-text">Afficher la liste des médecin du cabinet</p>
          <a href="/home/doctors" class="btn btn-info btn-sm">Afficher les medecins</a>
        </div>
        <div class="card-body">
          <h4 class="card-title">Titre 4</h4>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-info btn-sm">Btn</a>
        </div>
        <div class="card-body">
          <h4 class="card-title">Titre 5</h4>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-info btn-sm">Btn</a>
        </div>
        <div class="card-body">
          <h4 class="card-title">Titre 6</h4>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-info btn-sm">Btn</a>
        </div>
        <div class="card-body">
          <h4 class="card-title">Titre </h4>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-info btn-sm">Btn</a>
        </div>
      </div>
    </div>
  </fieldset>

</div>