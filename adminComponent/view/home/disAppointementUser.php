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
$statusAdmin = isset($_SESSION['statusDeleteAppointmentAdmin']) ? $_SESSION['statusDeleteAppointmentAdmin'] : null;
$messageAdmin = isset($_SESSION['messageDeleteAppointmentAdmin']) ? $_SESSION['messageDeleteAppointmentAdmin'] : "";
unset($_SESSION['statusDeleteAppointmentAdmin']);
unset($_SESSION['messageDeleteAppointmentAdmin']);
?>

<div class="content">
  <fieldset>
    <legend>
      <h5>Profil ADMIN</h5>
    </legend>


    <?php if (!empty($dataDisplayAppointmentPatients)): ?>

      <?php
      // Supposons que $dataDisplayAppointmentPatients est le résultat d'une requête MySQLi
      $rowCount = $dataDisplayAppointmentPatients->num_rows;
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
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Num Séc. Sociale</th>
                    <th scope="col">Date</th>
                    <th scope="col">Créneau</th>
                    <th scope="col">Médecin</th>
                    <th scope="col">Spécialisation</th>
                    <th scope="col">Supprimer</th>
                  </tr>
                </thead>
                <tbody class="table-group-divider">
                  <?php while ($row = $dataDisplayAppointmentPatients->fetch_assoc()): ?>
                    <tr>

                      <td><?= htmlspecialchars($row["id_res"]) ?></td>
                      <td><?= htmlspecialchars($row["Nom"]) ?></td>
                      <td><?= htmlspecialchars($row["Prénom"]) ?></td>
                      <td><?= htmlspecialchars($row["Numéro SS"]) ?></td>
                      <td><?= htmlspecialchars($row["Date"]) ?></td>
                      <td><?= htmlspecialchars($row["Créneau"]) ?></td>
                      <td><?= htmlspecialchars($row["Médecin"]) ?></td>
                      <td><?= htmlspecialchars($row["Spécialisation"]) ?></td>
                      <td>
                        <form method="POST">
                          <input type="hidden" name="id_appointement_delete" value="<?= htmlspecialchars($row["id_res"]) ?>">
                          <button class="btn btn-danger btn-sm" type="submit" name='delete-appointment-patient'
                            value='delete-appointment-patient'>🗑
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
<div class="modal fade" id="modalDeleteAppointment" tabindex="-1" aria-labelledby="modalDeleteAppointmentLabel"
  aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDeleteAppointmentLabel">Information ADMIN</h5>
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
  var status = <?php echo json_encode($statusAdmin); ?>;
  var message = <?php echo json_encode($messageAdmin); ?>;
  if (status === "success") {
    var modalDeleteAppointment = new bootstrap.Modal(document.getElementById('modalDeleteAppointment'));
    document.getElementById("message").innerHTML = message;
    modalDeleteAppointment.show();
  } else if (status === "error") {
    var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
    errorModal.show();
  }
</script>