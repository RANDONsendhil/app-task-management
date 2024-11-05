<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php if (!empty($users)): ?>
    <ul>
      <?php foreach ($users as $user): ?>
        <p>ID: <?= htmlspecialchars($user['username']) ?></p>

      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <p>No users found.</p>
  <?php endif; ?>
</body>

</html>