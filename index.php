<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>

  <?php
  //  require 'utilisateur.php';
  //  $user1 = new Utilisateur( 'Sendhil', '12345', 'Sendhil Address');
  //  echo $user1->getUserName() .', '. $user1->getUserId(). ','. $user1->getUserAddress();
  // echo $user1->getUserName();

  ?>
  <p>Paragraphe</p>

  <form action="controllerUtilisateur.php" method="post">
    <div>
      <label for="username"> User Name:
        <input type="text" name="username" placeholder="username" id="username">
      </label>
    </div>
    <div>
      <label for="userId"> User Id:
        <input type="text" name="userId" placeholder="userId" id="userId">
      </label>
    </div>
    <div>
      <label for="userAddress"> User Address:
        <input type="text" name="userAddress" placeholder="userAddress" id="userAddress">
      </label>
    </div>
    <input type="submit" value="Add" name="save-user">
  </form>


</body>

</html>