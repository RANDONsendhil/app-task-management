 <fieldset>

   <legend class="text-center m-4">
     <h3>CRÉER UN COMPTE</h3>
   </legend>

   <div class="container-sm shadow-lg p-3  bg-body-tertiary rounded">
     <form class="row g-3">

       <div class="form-group" method="POST" action="/">
         <div class="form-check form-check-inline">
           <input class="form-check-input" type="radio" id="madame" name="genre" value="madame">
           <label class="form-check-label" for="madame">Madame</label>
         </div>
         <div class="form-check form-check-inline">
           <input class="form-check-input" type="radio" id="monsieur" name="genre" value="monsieur">
           <label class="form-check-label g-col-md-" for=" monsieur">Monsieur</label>
         </div>
       </div>
       <div class="col-12">
         <label for="inputAddress" class="form-label">Numéro de Sécurité Sociale</label>
         <input type="text" class="form-control" id="inputAddress" placeholder="" required>
       </div>
       <div class="col-md-6">
         <label for="lname" class="form-label">Nom*</label>
         <input type="lname" class="form-control" id="lname" required>
       </div>
       <div class="col-md-6">
         <label for="sname" class="form-label">Prénom*</label>
         <input type="sname" class="form-control" id="sname" required>
       </div>
       <div class="col-md-6">
         <label for="inputEmail" class="form-label">Email*</label>
         <input type="email" class="form-control" id="inputEmail" required>
       </div>
       <div class="col-md-6">
         <label for="inputPassword" class="form-label">Mot de Passe*</label>
         <input type="password" class="form-control" id="inputPassword" required>
       </div>

       <div class="col-md-6">
         <label for="mobileNum" class="form-label">Téléphone Portable*</label>
         <input type="mobileNum" class="form-control" id="mobileNum" required>
       </div>
       <div class="col-md-6">
         <label for="phoneNum" class="form-label">Téléphone Fixe</label>
         <input type="phoneNum" class="form-control" id="phoneNum" required>
       </div>

       <div class="col-12">
         <label for="inputAddress2" class="form-label">Address</label>
         <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
       </div>
       <div class="col-md-6">
         <label for="inputCity" class="form-label">Commune</label>
         <input type="text" class="form-control" id="inputCity">
       </div>

       <div class="col-md-6">
         <label for="inputZip" class="form-label">Code Postal</label>
         <input type="text" class="form-control" id="inputZip">
       </div>

       <div class="d-flex justify-content-start mt-3">
         <button type="submit" class="btn btn-primary btn-lg">Sign in</button>
       </div>

     </form>
   </div>

 </fieldset>