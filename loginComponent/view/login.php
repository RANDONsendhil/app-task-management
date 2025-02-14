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
  <main>
    <?php
    include(BASE_PATH . "/index/nav.php")
    ?>
    <fieldset>
      <div class="container">

        <legend>
          <h5 class="text-center m-0">SE CONNECTER</h5>
        </legend>
        <div class="container-mb-10">
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

                      <input class="btn btn-info" id="compteCreation" type="submit" onclick="window.location.href='/'" value="Je crée un Compte">
                    </div>
                    <div class="g-col-4">
                      <input class="btn btn-primary" type="submit" value="Se Connecter">
                    </div>

                  </div>
                </div>
            </form>
          </div>
        </div>
      </div>

    </fieldset>
  </main>
  <?php
  include(BASE_PATH . "/index/footer.php")
  ?>
  </body>