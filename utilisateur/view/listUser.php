 <?php
  include('formUser.php');
  ?>
 <h5>USER </h5>
 <?php
  if (count($myUserData) > 0) {
    foreach ($myUserData as $u) {
      echo "<tr>
   <td>" . $u["lname"] . "</td>
 
 </tr>";
    }
  } else {
    echo "<tr>
   <td colspan='3'>No records found</td>
 </tr>";
  }
  ?>