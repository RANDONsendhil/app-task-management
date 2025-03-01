 <style>
   .modal-dialog {
     color: rgb(7, 45, 112);
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
   <fieldset>
     <legend>
       <h5>Liste des Docteurs</h5>
     </legend>

     <div class="content-container">
       <div id="containerCreationCompte">
         <div class="container-card">
           <div class="card">
             <?php foreach ($listDoctorsAdmin as $row): ?>
               <div class="card-body">
                 <?php ?>

                 <h4>
                   <div class="card-title"><?php echo ($row["full_name"]); ?></div>
                 </h4>

                 <div style="color: #af0a0a; font-variant-caps: small-caps;" class="card-title">
                   <?php echo ($row["specialization"]); ?></div>

                 <p class="card-text"><?php echo ($row["phone"]); ?></p>
                 <p class="card-text"><?php echo ($row["email"]); ?></p>


               </div>
             <?php endforeach; ?>
           </div>
         </div>
       </div>
     </div>

   </fieldset>
 </div>