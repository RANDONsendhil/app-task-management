<?php

include(BASE_PATH . '/user/homeComponent/view/home.php');
session_start();
?>
<div class="content">


  <fieldset>
    <legend>
      <h5>Liste des Docteurs</h5>
    </legend>

    <div class="content-container">
      <div class="container shadow-lg p-3  bg-body-tertiary rounded" id="containerCreationCompte">

        <div class="container-card">
          <div class="card">
            <?php foreach ($listDoctors as $row): ?>
              <div class="card-body">
                <h4 class="card-title"><?php echo ($row["full_name"]); ?></h4>
                <h5 class="card-text"><?php echo ($row["specialization"]); ?></h5>
                <p class="card-text"><?php echo ($row["phone"]); ?></p>
                <p class="card-text"><?php echo ($row["email"]); ?></p>
                <form action='/home/selectDoctor/appointment' method='POST'>
                  <input type='hidden' name='book-appointment' value=<?php echo $row["id"]; ?>> <button type='submit'
                    class='btn btn-dark btn-lg'>Prendre RDV</button>
                </form>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>

  </fieldset>
</div>