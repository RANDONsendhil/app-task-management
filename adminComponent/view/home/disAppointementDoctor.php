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
    background-color: #f9f9f9;
  }

  td strong {
    color: #333;
  }

  .btn {
    background-color: #dc3545;
    color: white;
    padding: 10px 20px;
    font-size: 14px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
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
$statusAdminDeletedDoctor = isset($_SESSION['statusDeleteAppointmentAdminDoctor']) ? $_SESSION['statusDeleteAppointmentAdminDoctor'] : null;
$messageAdminDeletedDoctor = isset($_SESSION['messageDeleteAppointmentAdminDoctor']) ? $_SESSION['messageDeleteAppointmentAdminDoctor'] : "";
unset($_SESSION['statusDeleteAppointmentAdminDoctor']);
unset($_SESSION['messageDeleteAppointmentAdminDoctor']);
?>

<div class="content">
  <fieldset>
    <legend>
      <h5>Profil ADMIN</h5>
    </legend>


    <?php if (!empty($dataDisplayAppointmentDoctors)): ?>

      <?php
      // Supposons que $dataDisplayAppointmentPatients est le résultat d'une requête MySQLi
      $rowCount = $dataDisplayAppointmentDoctors->num_rows;
      ?>

      <div class="content-container">
        <div class="container shadow-lg p-3 bg-body-tertiary rounded">
          <?php if ($rowCount > 0): ?>
            <?php if ($rowCount > 10): ?>
              <!-- Conteneur scrollable si plus de 5 lignes -->
              <div style="max-height:300px; overflow-y:auto; border:1px solid #ddd;">
              <?php endif; ?>

              <table>
                <thead>
                  <tr>
                    <th scope="col">ID </th>
                    <th scope="col">ID Médécin</th>
                    <th scope="col">Nom et Prénom</th>
                    <th scope="col">Spécialisation</th>
                    <th scope="col">Date</th>
                    <th scope="col">Créneau</th>
                    <th scope="col">Supprimer</th>
                  </tr>
                </thead>
                <tbody class="table-group-divider">
                  <?php while ($row = $dataDisplayAppointmentDoctors->fetch_assoc()): ?>

                    <tr>
                      <td><?= htmlspecialchars($row["id"]) ?></td>
                      <td><?= htmlspecialchars($row["doctor_id"]) ?></td>
                      <td><?= htmlspecialchars($row["full_name"]) ?></td>
                      <td><?= htmlspecialchars($row["specialization"]) ?></td>
                      <td><?= htmlspecialchars($row["date"]) ?></td>
                      <td><?= htmlspecialchars($row["slot"]) ?></td>

                      <td>
                        <form method="POST">
                          <input type="hidden" name="id_appointement_doctor_delete"
                            value="<?= htmlspecialchars($row["id"]) ?>">
                          <button type="submit" class="btn" name='delete-appointment-doctor'
                            value='delete-appointment-doctor'>🗑
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
<div class="modal fade" id="modalDeleteAppointmentDoctorLabel" tabindex="-1"
  aria-labelledby="modalDeleteAppointmentDoctorLabelLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDeleteAppointmentDoctorLabelDoctorLabel">Information sur votre rendez vous</h5>
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
  var status = <?php echo json_encode($statusAdminDeletedDoctor); ?>;
  var message = <?php echo json_encode($messageAdminDeletedDoctor); ?>;
  if (status === "success") {
    var modalDeleteAppointmentDoctorLabel = new bootstrap.Modal(document.getElementById(
      'modalDeleteAppointmentDoctorLabel'));
    document.getElementById("message").innerHTML = message;
    modalDeleteAppointmentDoctorLabel.show();
  } else if (status === "error") {
    var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
    errorModal.show();
  }
</script>