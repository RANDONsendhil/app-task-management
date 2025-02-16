<style>
  table {

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

  tr:hover {
    background-color: rgb(193, 193, 193);
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



  .btn-container {
    text-align: right;
    margin-top: 20px;
  }
</style>


<div id="containerHome">
  <?php
  include(BASE_PATH . '/user/homeComponent/view/home.php');
  ?>
  <div class=" containerContentHome">

    <div class=" container-card">

      <div class="card">
        <fieldset>
          <legend>
            <h5>Profil</h5>
          </legend>


          <table>
            <tbody>
              <?php foreach ($dataByNumss as $row): ?>
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
              <?php endforeach; ?>
            </tbody>
          </table>

          <div class=" btn-container">
            <input class="btn" type="submit" name="update-User" value="Modifier">
          </div>
        </fieldset>
      </div>
    </div>
  </div>