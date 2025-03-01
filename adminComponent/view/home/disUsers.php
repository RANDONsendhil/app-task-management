<style>
table {
  width: 100%;
  margin: 20px auto;
  border-collapse: collapse;
  background-color: #fff;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

th,
td {
  padding: 2px 8px 1px 24px;
  text-align: left;
}

th {
  background-color: rgb(90, 177, 190);
  color: white;
}

tr:nth-child(even) {
  background-color: rgb(179, 179, 179);
}

td strong {
  color: #333;
}



.btn:hover {
  background-color: #c82333;
}

/* Conteneur scrollable pour le tableau */
.scrollable-container {
  max-height: 300px;
  overflow-y: auto;
  border: 1px solid #ddd;
}
</style>

<?php
include(BASE_PATH . '/adminComponent/view/home/ad_home.php');
session_start();
$statusDeleteAdminPatient = isset($_SESSION['statusDeleteAdminPatient']) ? $_SESSION['statusDeleteAdminPatient'] : null;
$messageAdminDeletePatients = isset($_SESSION['messageDeleteAdminPatient']) ? $_SESSION['messageDeleteAdminPatient'] : "";
unset($_SESSION['statusDeleteAdminPatient']);
unset($_SESSION['messageDeleteAdminPatient']);
?>

<div class="content">
  <fieldset>
    <legend>

      <h5>LISTES DES PATIENTS</h5>
    </legend>


    <?php if (!empty($dataAdminlistUsers)): ?>

    <?php
      // Supposons que $dataDisplayAppointmentPatients est le résultat d'une requête MySQLi
      $rowCount = $dataAdminlistUsers->num_rows;
      ?>

    <div class="content-container" style="max-width: 1100px;">
      <div class="container shadow-lg p-3 bg-body-tertiary rounded">
        <?php if ($rowCount > 0): ?>
        <?php if ($rowCount > 10): ?>
        <!-- Conteneur scrollable si plus de 5 lignes -->
        <div style="max-height:500px; overflow-y:auto; border:1px solid #ddd;">
          <?php endif; ?>

          <table>
            <thead>
              <tr>
                <th scope="col">Num. Séc Sociale</th>
                <th scope="col">Genre</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Téléphone</th>
                <th scope="col">Email</th>
                <th scope="col">Adresse</th>
                <th scope="col">Supprimer</th>
              </tr>
            </thead>
            <tbody class="table-group-divider">
              <?php while ($row = $dataAdminlistUsers->fetch_assoc()): ?>

              <tr>
                <td><?= htmlspecialchars($row["numSS"]) ?></td>
                <td><?= htmlspecialchars($row["genre"]) ?></td>
                <td><?= htmlspecialchars($row["lname"]) ?></td>
                <td><?= htmlspecialchars($row["fname"]) ?></td>
                <td><?= htmlspecialchars($row["mobileNum"]) ?></td>
                <td><?= htmlspecialchars($row["inputEmail"]) ?></td>
                <td>
                  <?= htmlspecialchars($row["inputAddress"]) ?>
                  <?= htmlspecialchars($row["inputCity"]) ?>
                  <?= htmlspecialchars($row["inputZip"]) ?>
                </td>

                <td>
                  <form method="POST" action="/admin/home/display-list-admin-patients">
                    <input type="hidden" name="id_delete_admin_patient" value="<?= $row["numSS"] ?>">
                    <button class="btn btn-danger btn-sm" type="submit" name='delete-admin-patient-id'
                      value='delete-admin-patient-id'>🗑
                      Supprimer</button>
                  </form>
                </td>
              </tr>
              <?php endwhile; ?>
            </tbody>
          </table>

          <?php if ($rowCount > 5): ?>
        </div> <!-- Fin du conteneur scrollable -->
        <?php endif; ?>

        <?php else: ?>
        <div style="margin: auto;">
          <h5>Aucun rendez-vous</h5>
        </div>
        <?php endif; ?>
      </div>
    </div>

    <?php else: ?>
    <div style="margin: auto;">
      <h5>Aucun rendez-vous</h5>
    </div>
    <?php endif; ?>


  </fieldset>
</div>

<!-- Bootstrap Success Modal -->
<div class="modal fade" id="modalDeletePatientLabel" tabindex="-1" aria-labelledby="modalDeletePatientLabelLabel"
  aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDeletePatientLabel">Information ADMIN</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="message"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

<script>
var status = <?php echo json_encode($statusDeleteAdminPatient); ?>;
var message = <?php echo json_encode($messageAdminDeletePatients); ?>;
if (status === "success") {
  var modalDeletePatientLabel = new bootstrap.Modal(document.getElementById(
    'modalDeletePatientLabel'));
  document.getElementById("message").innerHTML = message;
  modalDeletePatientLabel.show();
} else if (status === "error") {
  var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
  errorModal.show();
}
</script>