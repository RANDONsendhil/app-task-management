<?php
define('BASE_PATH', __DIR__); ?>
<?php
include(BASE_PATH . '/user/homeComponent/view/home.php');
session_start();
?>
<style>
.card-body a {
  font-size: 14px;

}
</style>
<div class="content">

  <fieldset>
    <legend>
      <h5>Mes Rendez-vous</h5>
    </legend>

    <div class="container-card">

      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Prendre un rendez vous</h4>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>NumSS</th>
                <th>Patient</th>
                <th>Doctor</th>
                <th>Date</th>
                <th>Slot</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if ($getUsersAppointments->num_rows > 0) {
                while ($row = $getUsersAppointments->fetch_assoc()) {
                  echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['numSS']}</td>
                           <td>{$row['id_doctor']}</td>
                   
                        <td>{$row['date']}</td>
                        <td>{$row['slot']}</td>
                    </tr>";
                }
              } else {
                echo "<tr><td colspan='6' class='text-center'>No reservations found.</td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
  </fieldset>

</div>