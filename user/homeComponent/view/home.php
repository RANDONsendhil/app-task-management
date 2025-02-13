 <style>
   legend {
     text-align: center !important;
   }

   .card-title {
     color: #063846;
     font-weight: 600 !important;
   }

   .btn {
     font-weight: 600;
   }

   .container-card {
     padding: 45px;
   }
 </style>

 <?php
  include(BASE_PATH . "/index/navHome.php")
  ?>
 <div class="content-home" style="margin-left: 250px;">
   <?php
    include(BASE_PATH . "/index/headerHome.php")
    ?>

   <fieldset>

     <div class="container-card">

       <legend>
         <h3>TABLEAU DE BORD</h3>
       </legend>

       <div class="card">
         <div class="card-body">
           <h4 class="card-title">Prendre un rendez vous</h4>
           <p class="card-text">Prenez votre rendez vous en ligne</p>
           <a href="#" class="btn btn-dark btn-lg">Rendez-vous</a>
         </div>
         <div class="card-body">
           <h4 class="card-title">Mes Rendez-vous</h4>
           <p class="card-text">Afficher les rendez-vous en cours, les rendez-vous passés.</p>
           <a href="#" class="btn btn-dark btn-lg">Afficher mes rendez-vous</a>
         </div>
         <div class="card-body">
           <h4 class="card-title">Les Medecins</h4>
           <p class="card-text">Afficher la liste des médecin du cabinet</p>
           <a href="#" class="btn btn-dark btn-lg">Afficher les medecins</a>
         </div>
         <div class="card-body">
           <h4 class="card-title">Special title treatment</h4>
           <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
           <a href="#" class="btn btn-dark btn-lg">Go somewhere</a>
         </div>
         <div class="card-body">
           <h4 class="card-title">Special title treatment</h4>
           <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
           <a href="#" class="btn btn-dark btn-lg">Go somewhere</a>
         </div>
         <div class="card-body">
           <h4 class="card-title">Special title treatment</h4>
           <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
           <a href="#" class="btn btn-dark btn-lg">Go somewhere</a>
         </div>
         <div class="card-body">
           <h4 class="card-title">Special title treatment</h4>
           <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
           <a href="#" class="btn btn-primary btn-lg">Go somewhere</a>

         </div>
       </div>
     </div>

 </div>
 </fieldset>