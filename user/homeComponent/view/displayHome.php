<?php
define('BASE_PATH', __DIR__); ?>
<?php
include(BASE_PATH . '/user/homeComponent/view/home.php');
?>
<style>
.card-body a {
  font-size: 14px;
}

.btn {
  width: 230px;
}

.project-header {
  margin-bottom: 15px;
  border-bottom: 2px solid #e9ecef;
  padding-bottom: 10px;
  text-align: center;
}

.project-id {
  font-weight: bold;
  color: #007bff;
  display: block;
}

.project-name {
  font-weight: 600;
  color: #343a40;
  display: block;
  min-height: 50px;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  padding: 5px 0;
}

.project-info {
  margin-bottom: 8px;
}

.date-label {
  font-weight: 600;
  color: #6c757d;
  margin-right: 8px;
}

.card-text {
  font-size: 14px;
  line-height: 1.4;
}

.specialization-title {
  font-size: 16px;
  font-weight: 500;
  margin-bottom: 10px;
}

.description-highlight {
  background-color: #f8f9fa;
  border-left: 4px solid #007bff;
  padding: 10px;
  margin: 10px 0;
  border-radius: 4px;
}

.description-text {
  font-weight: 500;
  color: #495057;
  margin: 0;
}

.date-value {
  color: #28a745;
  font-weight: 500;
}
</style>
<div class="content">

  <fieldset>
    <legend>
      <h5>Tableau de bord</h5>
    </legend>

    <div class="content-container">
      <div id="containerCreationCompte">
        <div class="container-card">
          <div class="card">

            <?php foreach ($listProjects as $row): ?>

            <div class="card-body">
              <?php ?>
              <form action='/home/selectProject/project' method='POST'>
                <div class="project-header">
                  <h4>
                    <span class="project-id">
                      <?php echo ($row["id"]); ?>
                    </span>
                    <span class="project-name">
                      <?php echo ($row["nom"]); ?>
                    </span>
                  </h4>

                  <div style="color: #af0a0a; font-variant-caps: small-caps;" class="card-title specialization-title">
                    <?php echo ($row["specialization"]); ?>
                  </div>
                </div>

                <div class="project-info">
                  <div class="description-highlight">
                    <p class="card-text description-text">
                      <span class="date-label">Description:</span>
                      <?php echo ($row["description"]); ?>
                    </p>
                  </div>
                  <p class="card-text">
                    <span class="date-label">Date début:</span>
                    <span class="date-value"><?php echo ($row["date_debut"]); ?></span>
                  </p>
                  <p class="card-text">
                    <span class="date-label">Date fin:</span>
                    <span class="date-value"><?php echo ($row["date_fin"]); ?></span>
                  </p>
                  <p class="card-text">
                    <span class="date-label">Date création:</span>
                    <span class="date-value"><?php echo ($row["date_creation"]); ?></span>
                  </p>
                </div>

                <input type='hidden' name='select-project' value=<?php echo $row["id"]; ?>>
                <button style="width: 221px!important; margin:0px;" type='submit' class='btn btn-info btn-sm'>Afficher
                </button>
              </form>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </fieldset>

</div>