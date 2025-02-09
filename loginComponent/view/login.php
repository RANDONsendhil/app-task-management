  <style>
.container {
  max-width: 500px;
  padding: 40px;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.btn {

  width: 175px;
}
  </style>
  <fieldset>
    <legend>
      <h3 class="text-center m-4">SE CONNECTER</h3>
    </legend>
    <div class="container-mb-5  ">
      <div class="container-sm shadow-lg p-3 mb-5 bg-body-tertiary rounded">
        <form method="POST" action="/">
          <div class="form-group">
            <label for="username">Identifiant</label>
            <input type="text" name="username" id="username" required><br><br>
            <label for="password">Mot de Passe</label>
            <input type="password" name="password" id="password" required>
            <div class="d-grid gap-2 mt-4 d-flex justify-content-center">
              <div class="grid text-center d-inline-flex gap-1">

                <div class="fg-col-4">
                  <input class="btn btn-info btn-lg" type="submit" value="Créer un Compte">
                </div>
                <div class="g-col-4">
                  <input class="btn btn-primary btn-lg" type="submit" value="Se Connecter">
                </div>

              </div>
            </div>
        </form>
      </div>
    </div>
  </fieldset>