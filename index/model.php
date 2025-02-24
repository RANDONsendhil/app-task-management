<?php
session_start();
$status = isset($_SESSION['retStatus']) ? $_SESSION['retStatus'] : null;
$message = isset($_SESSION['retMessage']) ? $_SESSION['retMessage'] : "";
unset($_SESSION['statusDelete']);
unset($_SESSION['message']);
?>


<div class="modal fade" id="returnModel" tabindex="-1" aria-labelledby="returnModelLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="returnModelLabel" style="color: #0c3783;">Information.</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="message">
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
var message = <?php echo json_encode($message); ?>;
if (status === "success") {
  var returnModel = new bootstrap.Modal(document.getElementById('returnModel'));
  document.getElementById("message").innerHTML = message;
  returnModel.show();
} else if (status === "error") {
  var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
  errorModal.show();
}
</script>