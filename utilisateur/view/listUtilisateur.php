<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>

  <p>Paragraphe</p>
  <form action="." method="post">
    <div>
      <div>
        <label for="userId"> User Id:
          <input type="text" name="userId" placeholder="userId" id="userId">
        </label>
      </div>
      <label for="username"> User Name:
        <input type="text" name="username" placeholder="username" id="username">
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