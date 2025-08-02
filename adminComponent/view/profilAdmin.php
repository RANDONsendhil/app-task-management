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
  padding: 12px 15px;
  text-align: left;
}

th {
  background-color: #007bff;
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
</style>
<?php
include(BASE_PATH . '/adminComponent/view/home/ad_home.php');
session_start();
$status = isset($_SESSION['statusUpdateProfilAdmin']) ? $_SESSION['statusUpdateProfilAdmin'] : null;
$messageAdmin = isset($_SESSION['messageUpdateProfilAdmin']) ? $_SESSION['messageUpdateProfilAdmin'] : "";
unset($_SESSION['statusUpdateProfilAdmin']);
unset($_SESSION['messageUpdateProfilAdmin']);

?>
<div class="content">

  <div class="">
    <fieldset>
      <legend>
        <h5>PROFIL(ADMIN)</h5>
      </legend>
      <form method="post" action="/updateProfil-admin">
        <div class="content-container">
          <div class="container shadow-lg p-3  bg-body-tertiary rounded">
            <table>
              <tbody>
                <?php foreach ($dataAdminById as $row): ?>
                <?php
                  $_SESSION['id_admin'] = $row['id_admin'];
                  $_SESSION['password'] =  $row['password'];
                  $_SESSION['fname']  =  $row['fname'];
                  $_SESSION['lname'] = $row['lname'];
                  $_SESSION['email'] = $row['email'];;
                  $_SESSION['phone'] = $row['phone'];

                  ?>
                <tr>
                  <td><strong>ID ADMIN:</strong></td>
                  <td><?php echo htmlspecialchars($row['id_admin']); ?></td>
                </tr>
                <tr>
                  <td><strong>Nom:</strong></td>
                  <td><?php echo htmlspecialchars($row['fname']); ?></td>
                </tr>
                <tr>
                  <td><strong>Prénom:</strong></td>
                  <td><?php echo htmlspecialchars($row['lname']); ?></td>
                </tr>
                <tr>
                  <td><strong>Adresse Mail:</strong></td>
                  <td><?php echo htmlspecialchars($row['password']); ?></td>
                </tr>
                <tr>
                  <td><strong>Mot de Passe:</strong></td>
                  <td><?php echo htmlspecialchars($row['email']); ?></td>
                </tr>
                <tr>
                  <td><strong>Téléphone mobile:</strong></td>
                  <td><?php echo htmlspecialchars($row['phone']); ?></td>
                </tr>

                <td></td>
                <td>
                  <div class="d-flex justify-content-end">

                    <input class=" btn btn-primary btn-sm" type="submit" name="display-update-admin"
                      value="Mettre à jour mon Profil ADMIN">

                  </div>

                </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </form>
    </fieldset>
  </div>
</div>
</div>


<div class="modal fade" id="returnModel" tabindex="-1" aria-labelledby="returnModelLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="returnModelLabel" style="color: #0c3783;">Information.</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="messageAdmin">
        Votre réservation a été bien prise en compte.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

<script>
var status = <?php echo json_encode($status); ?>;
var messageAdmin = <?php echo json_encode($messageAdmin); ?>;
if (status === "success") {
  var returnModel = new bootstrap.Modal(document.getElementById('returnModel'));
  document.getElementById("messageAdmin").innerHTML = messageAdmin;
  returnModel.show();
} else if (status === "error") {
  var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
  errorModal.show();
}
if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}
</script>