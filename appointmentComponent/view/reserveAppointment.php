<?php

define('BASE_PATH', __DIR__);

include(BASE_PATH . '/user/homeComponent/view/home.php');
session_start();
?>

<div class="container-card">

  <fieldset>
    <legend>
      <h5>Tableau de Rendez-vous</h5>
    </legend>

    <div class="content-container">
      <div class="container shadow-lg p-3  bg-body-tertiary rounded" id="containerCreationCompte">

      </div>
    </div>

  </fieldset>
</div>