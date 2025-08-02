 <?php

  include(BASE_PATH . '/user/homeComponent/view/home.php');
  include(BASE_PATH . '/appointmentComponent/model/doctor.php');
  session_start();

  $status = isset($_SESSION['status']) ? $_SESSION['status'] : null;
  $message = isset($_SESSION['message']) ? $_SESSION['message'] : "";

  // Clear session message after displaying
  unset($_SESSION['status']);
  unset($_SESSION['message']);
  ?>

 <style>
.modal-dialog {
  color: rgb(7, 45, 112);
}
 </style>
 <div class="content">
   <fieldset>
     <legend>
       <h5>Liste des Docteurs</h5>
     </legend>

     <div class="content-container">
       <div id="containerCreationCompte">
         <div class="container-card">
           <div class="card">
             <?php foreach ($listDoctors as $row): ?>
             <div class="card-body">
               <?php ?>
               <form action='/home/selectDoctor/appointment' method='POST'>
                 <h4>
                   <div class="card-title"><?php echo ($row["full_name"]); ?></div>
                 </h4>

                 <div style="color: #af0a0a; font-variant-caps: small-caps;" class="card-title">
                   <?php echo ($row["specialization"]); ?></div>

                 <p class="card-text"><?php echo ($row["phone"]); ?></p>
                 <p class="card-text"><?php echo ($row["email"]); ?></p>

                 <input type='hidden' name='select-appointment' value=<?php echo $row["id"]; ?>>
                 <button style="width: 221px!important; margin:0px;" type='submit' class='btn btn-info btn-sm'>Prendre
                   RDV</button>
               </form>
             </div>
             <?php endforeach; ?>
           </div>
         </div>
       </div>
     </div>

   </fieldset>
 </div>
 <!-- Bootstrap Success Modal -->
 <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="false">

   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="successModalLabel" style="color: #0c3783;">Information sur votre rendez vous</h5>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body">
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
if (status === "success") {
  var successModal = new bootstrap.Modal(document.getElementById('successModal'));
  successModal.show();
} else if (status === "error") {
  var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
  errorModal.show();
}
 </script>