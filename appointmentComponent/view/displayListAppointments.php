<?php
define('BASE_PATH', __DIR__); ?>
<?php
include(BASE_PATH . '/user/homeComponent/view/home.php');
session_start();
$status = isset($_SESSION['statusDelete']) ? $_SESSION['statusDelete'] : null;
$message = isset($_SESSION['message']) ? $_SESSION['message'] : "";
unset($_SESSION['statusDelete']);
unset($_SESSION['message']);
?>
<style>
#tableAppointment {
  font-size: 14px;
  max-width: 950px;
}
</style>
<div class="content">

  <fieldset>
    <legend>
      <h5>Mes Rendez-vous</h5>
    </legend>
    <div class="content-container">
      <div class="container shadow-lg p-3  bg-body-tertiary rounded">
        <?php if (!empty($getUsersAppointments)): ?>
        <table class="table  table-striped">
          <thead>
            <tr>
              <th scope=" col">Numéro RV</th>
              <th scope="col">Date</th>
              <th scope="col">Heure</th>
              <th scope="col">Médecin</th>
              <th scope="col">Coordonnée Médecin</th>
              <th scope="col">Annulation</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <?php
              $date = new DateTime($row['date']);
              $formatter = new IntlDateFormatter(
                'fr_FR',
                IntlDateFormatter::FULL,
                IntlDateFormatter::NONE
              ); ?>
            <?php foreach ($getUsersAppointments as $row): ?>
            <tr>
              <td scope='row'> <?= htmlspecialchars($row['id']) ?></td>

              </th>
              <td>
                <?= htmlspecialchars($formatter->format($date)) ?></td>
              <td>
                <?= htmlspecialchars($row['slot']) ?>
              </td>
              <td>
                <?= htmlspecialchars($row['full_name']),  htmlspecialchars($row['specialization']) ?>
              </td>
              <td>
                <?= htmlspecialchars($row['phone']) ?>
              </td>
              <td>
                <form method="post">
                  <input type='hidden' name='idAppointment' value='<?= $row['id'] ?>' ?>
                  <button class='btn btn-danger btn-sm' type='submit' name='delete-appointment'
                    value='delete-appointment'>Annuler le rendez-vous </button>
                </form>
              </td>
            </tr>
            <?php endforeach; ?>
        </table>
      </div>
      <?php else: ?>
      <div style="margin: auto;">
        <h5>Vous n'avez pas de rendez-vous!</h5>
      </div>
      <?php endif; ?>
      </tbody>
      </table>
    </div>
</div>
</fieldset>
</div>


<!-- Bootstrap Success Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Information sur votre rendez vous</h5>
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
var status = <?php echo json_encode($status); ?>;
var message = <?php echo json_encode($message); ?>;
if (status === "success") {
  var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
  document.getElementById("message").innerHTML = message;
  deleteModal.show();

} else if (status === "error") {
  var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
  errorModal.show();
}
</script>