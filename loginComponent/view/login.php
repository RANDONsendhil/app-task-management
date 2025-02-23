  <style>
    .containerLogin {
      margin: auto;
      max-width: 500px;
      padding: 39px 11px;
      width: 400px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      top: 3px;

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
      <div class="containerLogin">

        <legend>
          <h5 class="text-center m-0">SE CONNECTER</h5>
        </legend>
        <div class="container-mb-10">
          <div class="container-sm shadow-lg p-3 mb-5 bg-body-tertiary rounded">
            <form id="loginForm" method="POST" action="/login/submit-login">
              <div class="form-group">
                <label for="username">Identifiant</label>
                <input type="text" name="email" id="email" required><br><br>
                <label for="password">Mot de Passe</label>
                <input type="text" name="password" id="password" required>
                <div class="d-grid gap-2 mt-4 d-flex justify-content-center">
                  <div class="grid text-center d-inline-flex gap-1">

                    <div class="fg-col-3">

                      <input class="btn btn-info btn-sm" id="compteCreation" type="submit"
                        onclick="window.location.href='/'" value="Je crée un Compte">
                    </div>
                    <div class="g-col-3">
                      <input id="loginButton" class="btn btn-primary btn-sm" name="connect-profil" type="submit"
                        value="Se Connecter">
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


  <script>
    document.addEventListener("DOMContentLoaded", function() {
      document.getElementById("loginForm").addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
          event.preventDefault(); // Prevent default form submission
          document.getElementById("loginButton").click(); // Simulate button click
        }
      });
    });
  </script>