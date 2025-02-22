<style>
#containerAppoint {
  display: flex;
  flex-direction: row-reverse;
  justify-content: space-around;
  align-items: flex-start;
  align-content: stretch;
  margin: auto;
}

table {
  width: 100%;
  border-collapse: collapse;
}

table,
th,
td {
  border: 1px solid black;
}

th,
td {
  gap: 10px;
  padding: 10px;
  text-align: center;
}

button {
  display: flex;
  padding: 3px 10px;
  margin: 5px;
  cursor: pointer;
  border-radius: 5px;
  font-size: 15px;
}

button.disabled {
  background-color: #ccc;
  cursor: not-allowed;
}

#tableSlot {
  font-size: 15px;
  color: navy;
}
</style>

<?php

define('BASE_PATH', __DIR__);

include(BASE_PATH . '/user/homeComponent/view/home.php');
session_start();
?>

<div class="container-card">
  <fieldset>
    <div class="content-container">
      <legend>
        <h5>Tableau de Rendez-vous</h5>
      </legend>
      <div class="container shadow-lg p-3  bg-body-tertiary rounded" id="">

        <div id="containerAppoint">

          <ul style="font-size: 15px; font-weight:bolder; ">
            <div style="font-size: 14px;color: rgb(23 20 153);text-decoration: underline;">Prise de rendez-vous avec:
            </div>
            <li><?php echo  $getDoctById["full_name"]  ?> </li>
            <li><?php echo  $getDoctById["specialization"]  ?> </li>
            <li><?php echo  $getDoctById["phone"]  ?> </li>
            <li><?php echo  $getDoctById["email"]  ?> </li>
          </ul>
          <?php
          setlocale(LC_TIME, 'fr_FR.UTF-8');
          $currentDate = date('Y-m-d');
          $currentTime = date('H:i');
          $currentDayOfWeek = date('N'); // 1 = Monday, 7 = Sunday

          function generateTimeSlots($startTime, $endTime, $interval, $maxAppointments)
          {
            $slots = [];
            $currentTime = strtotime($startTime);
            $endTime = strtotime($endTime);

            while ($currentTime < $endTime) {
              $formattedTime = date('H:i', $currentTime);
              $slots[] = $formattedTime;
              $currentTime = strtotime("+$interval", $currentTime);
              if (count($slots) >= $maxAppointments) {
                break;
              }
            }
            return $slots;
          }

          $morningSlots = generateTimeSlots("09:00", "12:00", "30 minutes", 6);
          $afternoonSlots = generateTimeSlots("14:00", "18:00", "30 minutes", 10);
          function getNextWeekdays($startDate, $numDays)
          {
            $weekdays = [];
            $currentDate = strtotime($startDate);
            $daysAdded = 0;

            while ($daysAdded < $numDays) {
              $dayOfWeek = date('N', $currentDate);
              if ($dayOfWeek >= 1 && $dayOfWeek <= 5) {
                $weekdays[] = date('Y-m-d', $currentDate);
                $daysAdded++;
              }
              $currentDate = strtotime("+1 day", $currentDate);
            }

            return $weekdays;
          }
          $nextWeekdays = getNextWeekdays($currentDate, 5);
          function isPastTime($time, $date)
          {
            $currentDateTime = strtotime(date('Y-m-d H:i')); // Date et heure actuelles
            $slotDateTime = strtotime("$date $time"); // Date et heure du créneau

            return $slotDateTime < $currentDateTime;
          }
          ?>
          <!-- Loop through the next five weekdays -->
          <table id="tableSlot">
            <tr>
              <?php foreach ($nextWeekdays as $weekday): ?>

              <th><?php echo date('j/m/y', strtotime($weekday)); ?></th>
              <?php endforeach; ?>
            </tr>
            <tr>
              <?php foreach ($nextWeekdays as $weekday): ?>
              <td>
                <?php foreach ($morningSlots as $slot): ?>
                <button style="background:#1c8cad" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                  data-bs-target="#btnSelectSlot" class="<?php echo isPastTime($slot, $weekday) ? 'disabled' : ''; ?>"
                  <?php echo isPastTime($slot, $weekday) ? 'disabled' : ''; ?> onclick="displayConfirmModal(this)"
                  value=<?php echo json_encode(["slot" => $slot, 'date' => $weekday]) ?>>
                  <?php echo $slot; ?> </button>
                <?php endforeach; ?>

                <?php foreach ($afternoonSlots as $slot): ?>
                <button style="background:#1c8cad" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                  data-bs-target="#btnSelectSlot" class="<?php echo isPastTime($slot, $weekday) ? 'disabled' : ''; ?>"
                  <?php echo isPastTime($slot, $weekday) ? 'disabled' : ''; ?> onclick="displayConfirmModal(this)"
                  value=<?php echo json_encode(["slot" => $slot, 'date' =>  $weekday])  ?>>
                  <?php echo $slot; ?>
                </button>
                <?php endforeach; ?>
              </td>
              <?php endforeach; ?>
            </tr>
          </table>

        </div>
      </div>
    </div>

  </fieldset>
</div>
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#btnSelectSlot">
  Ouvrir le formulaire
</button> -->
<form id="formBook" method="post" action="/home/bookAppoinment">
  <div class="modal fade" id="btnSelectSlot" tabindex="-1" aria-labelledby="btnSelectSlotLabel" aria-hidden="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="btnSelectSlotLabel">Récapitualif de votre Renez vous</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>

        <div class="modal-body">

          <div class="mb-3">
            <h5>Vous</h5>
            <table>
              <tr>
                <td>
                  <div>Numéro Séc. Sociale:
                </td>
                <td name="userNumSS" value="<?php echo $_SESSION["numSS"] ?>">
                  <?php echo $_SESSION["numSS"]  ?>
                  <input type="hidden" name="userNumSS" value="<?php echo $_SESSION["numSS"] ?>">
                </td>
              </tr>
              <tr>
                <td>Nom: </td>
                <td>
                  <?php echo   $_SESSION["lname"]  ?>
                </td>
              </tr>
              <tr>
                <td>
                  Prénom:
                </td>
                <td>
                  <?php echo   $_SESSION["fname"]  ?>
                </td>
              </tr>
            </table>
          </div>
          <div class="mb-3">
            <h5>Médecin</h5>
            <table>
              <tr>
                <td> RPPS </td>
                <td name="doctorRPPS" value="<?php echo $getDoctById["id"] ?>">
                  <?php echo  $getDoctById["id"]  ?>
                  <input type="hidden" name="doctorRPPS" value="<?php echo $getDoctById["id"] ?>">
                </td>
              </tr>
              <tr>
                <td> Nom</td>
                <td>
                  <?php echo  $getDoctById["full_name"]  ?>
                </td>
              </tr>
              <tr>
                <td>Spécialisation</td>
                <td>
                  <?php echo  $getDoctById["specialization"]  ?>
                </td>
              </tr>
              <tr>
                <td>Téléphone</td>
                <td>
                  <?php echo  $getDoctById["phone"]  ?>
                </td>
              </tr>
              <tr>
                <td>Mail</td>
                <td>
                  <?php echo  $getDoctById["email"]  ?>
                </td>
              </tr>
            </table>
          </div>
          <div class="mb-3">
            <h5>Quand</h5>
            <table>
              <tr>
                <td>
                  Date
                </td>
                <td id="dateAppointment">
                </td>
                <input id="setval_date" type="hidden" name="res_date">
              </tr>
              <tr>
                <td> Heure</td>
                <td id="timeAppointment">
                </td>
                <input id="setval_time" type="hidden" name="res_time">
              </tr>

            </table>
          </div>
          <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-primary" name="reserve-appointment">Réserver le rendez-vous</button>
          </div>

        </div>

      </div>
    </div>
  </div>
</form>
<script>
document.getElementById("btnSelectSlot").addEventListener("submit", function(event) {
  event.preventDefault(); // Empêche la soumission classique du formulaire
  var modal = bootstrap.Modal.getInstance(document.getElementById('btnSelectSlot'));
  modal.hide(); // Ferme le modal après soumission
  $('.modal-backdrop').remove();

});
var dataJson;

function displayConfirmModal(params) {
  let data = JSON.parse(params.value);
  const date = document.getElementById('dateAppointment');
  const time = document.getElementById('timeAppointment');
  date.innerHTML = data.date;
  time.innerHTML = data.slot;
  const setdate = document.getElementById('setval_date');
  const settime = document.getElementById('setval_time');
  setdate.value = data.date;
  settime.value = data.slot;
  dataJson = data;
}

function getJsonData() {
  return dataJson;
}
</script>