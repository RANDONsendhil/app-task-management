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
include(BASE_PATH . '/user/homeComponent/view/home.php');
?>
<div class="content">

  <div class="">
    <fieldset>
      <legend>
        <h5>Profil</h5>
      </legend>
      <form method="post" action="/updateProfil">
        <div class="content-container">
          <div class="container shadow-lg p-3  bg-body-tertiary rounded">
            <table>
              <tbody>
                <?php foreach ($dataByNumss as $row): ?>
                  <?php
                  $_SESSION['genre'] = $row['genre'];
                  $_SESSION['numSS'] =  $row['numSS'];
                  $_SESSION['lname']  =  $row['lname'];
                  $_SESSION['fname'] = $row['fname'];
                  $_SESSION['inputEmail'] = $row['inputEmail'];;
                  $_SESSION['inputPassword'] = $row['inputPassword'];
                  $_SESSION['mobileNum'] = $row['mobileNum'];
                  $_SESSION['phoneNum']  = $row['phoneNum'];
                  $_SESSION['inputAddress'] = $row['inputAddress'];
                  $_SESSION['inputCity'] = $row['inputCity'];
                  $_SESSION['inputZip'] = $row['inputZip'];
                  ?>
                  <tr>
                    <td><strong>Numéro de Sécutié Sociale:</strong></td>
                    <td><?php echo htmlspecialchars($row['numSS']); ?></td>
                  </tr>
                  <tr>
                    <td><strong>Nom:</strong></td>
                    <td><?php echo htmlspecialchars($row['lname']); ?></td>
                  </tr>
                  <tr>
                    <td><strong>Prénom:</strong></td>
                    <td><?php echo htmlspecialchars($row['fname']); ?></td>
                  </tr>
                  <tr>
                    <td><strong>Adresse Mail:</strong></td>
                    <td><?php echo htmlspecialchars($row['inputEmail']); ?></td>
                  </tr>
                  <tr>
                    <td><strong>Mot de Passe:</strong></td>
                    <td><?php echo htmlspecialchars($row['inputPassword']); ?></td>
                  </tr>
                  <tr>
                    <td><strong>Téléphone mobile:</strong></td>
                    <td><?php echo htmlspecialchars($row['mobileNum']); ?></td>
                  </tr>
                  <tr>
                    <td><strong>Téléphone Fixe:</strong></td>
                    <td><?php echo htmlspecialchars($row['phoneNum']); ?></td>
                  </tr>
                  <tr>
                    <td><strong>Adresse Postale:</strong></td>
                    <td><?php echo htmlspecialchars($row['inputAddress']); ?></td>
                  </tr>
                  <tr>
                    <td><strong>Commune ou Ville:</strong></td>
                    <td><?php echo htmlspecialchars($row['inputCity']); ?></td>
                  </tr>
                  <tr>
                    <td><strong>Code Postal:</strong></td>
                    <td><?php echo htmlspecialchars($row['inputZip']); ?></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>
                      <div class="d-flex justify-content-end">

                        <input class=" btn btn-primary btn-sm" type="submit" name="display-update-user"
                          value="Mettre à jour mon Profil">

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