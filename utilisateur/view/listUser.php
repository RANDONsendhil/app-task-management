 <?php
  include('formUser.php');
  ?>
 <?php if (!empty($users)): ?>

 <table class="table">
   <thead class="table-dark">

     <tr>
       <th>Id</th>
       <th>Name </th>
       <th>Address</th>
       <th>Delete User</th>
       <th>Update User</th>
     </tr>
   </thead>

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
       <form method="post">
         <input type='hidden' name='idusers' value='<?= $user['idusers'] ?>'>
         <button class="btn btn-danger" type="submit" name="delete-user" value="delete">Delete</button>
       </form>
     </td>
     <td>
       <button class="btn btn-primary" type="button" name="update-user"
         onclick="updateUser(<?= $user['idusers'] ?>)">Update</button>
     </td>
   </tr>
   <?php endforeach; ?>
 </table>
 </div>
 <?php else: ?>
 <p>No users found.</p>
 <?php endif; ?>