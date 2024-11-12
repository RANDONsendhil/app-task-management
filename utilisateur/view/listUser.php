<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php if (!empty($users)): ?>

    <table border="5px">
      <tr>
        <th>Id</th>
        <th>Name </th>
        <th>Address</th>
      </tr>
      <?php foreach ($users as $user): ?>
        <tr>
          <td>
            <?= htmlspecialchars($user['idusers']) ?></td>
          <td>
            <?= htmlspecialchars($user['username']) ?>
          </td>
          <td>
            <?= htmlspecialchars($user['useraddress']) ?>
          </td>
          <td>
            <input type="button" value="Delete" name="delete-user">
          </td>
          <td>
            <input type="button" value="Update" name="update-user">
          </td>
        </tr>
      <?php endforeach; ?>
    </table>

  <?php else: ?>
    <p>No users found.</p>
  <?php endif; ?>
</body>

</html>