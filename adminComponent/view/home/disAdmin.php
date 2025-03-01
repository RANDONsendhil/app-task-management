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
  padding: 2px 8px 1px 24px;
  text-align: left;
}

th {
  background-color: rgb(90, 177, 190);
  color: white;
}

tr:nth-child(even) {
  background-color: rgb(179, 179, 179);
}

td strong {
  color: #333;
}



.btn:hover {
  background-color: #c82333;
}

/* Conteneur scrollable pour le tableau */
.scrollable-container {
  max-height: 300px;
  overflow-y: auto;
  border: 1px solid #ddd;
}
</style>

<?php
include(BASE_PATH . '/adminComponent/view/home/ad_home.php');
session_start();
$statusDeleteAdminPatient = isset($_SESSION['statusDeleteAdminPatient']) ? $_SESSION['statusDeleteAdminPatient'] : null;
$messageAdminDeletePatients = isset($_SESSION['messageDeleteAdminPatient']) ? $_SESSION['messageDeleteAdminPatient'] : "";
unset($_SESSION['statusDeleteAdminPatient']);
unset($_SESSION['messageDeleteAdminPatient']);
?>

<div class="content">
  <fieldset>
    <legend>

      <h5>LISTES DES PATIENTS</h5>
    </legend>


    <?php if (!empty($dataListAdmin)): ?>

    <?php
      // Supposons que $dataDisplayAppointmentPatients est le résultat d'une requête MySQLi
      $rowCount = $dataListAdmin->num_rows;
      ?>

    <div class="content-container" style="max-width: 1100px;">
      <div class="container shadow-lg p-3 bg-body-tertiary rounded">
        <?php if ($rowCount > 0): ?>
        <?php if ($rowCount > 10): ?>
        <!-- Conteneur scrollable si plus de 5 lignes -->
        <div style="max-height:500px; overflow-y:auto; border:1px solid #ddd;">
          <?php endif; ?>

          <table>
            <thead>
              <tr>
                <th scope="col">Id Admin</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Téléphone</th>
                <th scope="col">Email</th>
              </tr>
            </thead>
            <tbody class="table-group-divider">
              <?php while ($row = $dataListAdmin->fetch_assoc()): ?>

              <tr>

                <td><?= htmlspecialchars($row["id_admin"]) ?></td>
                <td><?= htmlspecialchars($row["lname"]) ?></td>
                <td><?= htmlspecialchars($row["fname"]) ?></td>
                <td><?= htmlspecialchars($row["phone"]) ?></td>
                <td><?= htmlspecialchars($row["email"]) ?></td>
              </tr>
              <?php endwhile; ?>
            </tbody>
          </table>

          <?php if ($rowCount > 5): ?>
        </div> <!-- Fin du conteneur scrollable -->
        <?php endif; ?>

        <?php else: ?>
        <div style="margin: auto;">
          <h5>Aucun Admin engreistré</h5>
        </div>
        <?php endif; ?>
      </div>
    </div>

    <?php else: ?>
    <div style="margin: auto;">
      <h5>Aucun Admin engreistré</h5>
    </div>
    <?php endif; ?>


  </fieldset>
</div>