<style>
  .user-board {
    background: #f6f7fb;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    margin: 20px 0;
    overflow: hidden;
    border: 1px solid #e6e9ef;
  }

  .board-header {
    background: #ffffff;
    padding: 20px 24px;
    border-bottom: 1px solid #e6e9ef;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .board-title {
    font-size: 24px;
    font-weight: 600;
    color: #323338;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .board-icon {
    width: 32px;
    height: 32px;
    background: linear-gradient(135deg, #6161ff, #0085ff);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 16px;
  }

  .board-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
  }

  .board-table thead {
    background: #f8f9fd;
    position: relative;
  }

  .board-table thead::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, #0085ff, #6161ff, #0085ff);
    background-size: 200% 100%;
    animation: shimmer 3s ease-in-out infinite;
  }

  @keyframes shimmer {
    0% { background-position: -200% 0; }
    100% { background-position: 200% 0; }
  }

  .board-table th {
    padding: 16px 20px;
    text-align: left;
    font-weight: 600;
    font-size: 14px;
    color: #676879;
    border-bottom: 1px solid #e6e9ef;
    border-right: 1px solid #e6e9ef;
    background: linear-gradient(135deg, #f8f9fd, #e6e9ef);
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .board-table th:last-child {
    border-right: none;
  }

  .board-table td {
    border-bottom: 1px solid #e6e9ef;
    border-right: 1px solid #e6e9ef;
    vertical-align: middle;
    font-size: 14px;
  }

  .board-table td:last-child {
    border-right: none;
  }

  .board-table tbody tr {
    transition: all 0.3s ease;
  }

  .board-table tbody tr:hover {
    background: linear-gradient(135deg, #f8f9fd, #ffffff);
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
  }

  .user-name-cell {
    font-weight: 600;
    color: #323338;
    font-size: 16px;
  }

  .user-id-cell {
    font-weight: 600;
    color: #0085ff;
    font-size: 14px;
  }

  .user-email-cell {
    color: #676879;
    font-size: 14px;
  }

  .user-role-cell {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .role-admin {
    background: #e2445c;
    color: white;
  }

  .role-user {
    background: #00c875;
    color: white;
  }

  .role-manager {
    background: #fdab3d;
    color: white;
  }

  .user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #6161ff, #0085ff);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    font-weight: 600;
    margin-right: 12px;
  }

  .user-info-cell {
    display: flex;
    align-items: center;
  }

  .date-cell {
    color: #676879;
    font-size: 14px;
  }

  .action-btn {
    background: none;
    border: none;
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 18px;
    padding: 8px 12px;
  }

  .action-btn-primary {
    color: #0085ff;
  }

  .action-btn-primary:hover {
    color: #0073e6;
    transform: none;
    box-shadow: none;
  }

  .action-btn-danger {
    color: #e2445c;
  }

  .action-btn-danger:hover {
    color: #d63447;
    transform: none;
    box-shadow: none;
  }

  .actions-cell {
    display: flex;
    gap: 8px;
    align-items: center;
  }

  .profile-section {
    margin-bottom: 30px;
  }

  .empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #676879;
  }

  .empty-state-icon {
    font-size: 48px;
    margin-bottom: 16px;
    opacity: 0.5;
  }

  .empty-state-title {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 8px;
    color: #323338;
  }

  /* Modal Styles */
  .modal-content {
    border-radius: 12px;
    border: none;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
  }

  .modal-header {
    background: linear-gradient(135deg, #6161ff, #0085ff);
    color: white;
    border-radius: 12px 12px 0 0;
    border-bottom: none;
  }

  .modal-title {
    font-weight: 600;
    color: white !important;
  }

  .btn-close {
    filter: brightness(0) invert(1);
  }

  .form-group {
    margin-bottom: 20px;
  }

  .form-label {
    font-weight: 600;
    color: #323338;
    margin-bottom: 8px;
    display: block;
  }

  .form-control {
    border: 2px solid #e6e9ef;
    border-radius: 8px;
    padding: 12px 16px;
    font-size: 14px;
    transition: border-color 0.3s ease;
  }

  .form-control:focus {
    border-color: #0085ff;
    box-shadow: 0 0 0 3px rgba(0, 133, 255, 0.1);
    outline: none;
  }

  .btn-primary {
    background: linear-gradient(135deg, #0085ff, #6161ff);
    border: none;
    border-radius: 8px;
    padding: 12px 24px;
    font-weight: 600;
    transition: all 0.3s ease;
  }

  .btn-primary:hover {
    background: linear-gradient(135deg, #0073e6, #5555e6);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 133, 255, 0.3);
  }

  .btn-success {
    background: linear-gradient(135deg, #00c875, #00a86b);
    border: none;
    border-radius: 8px;
    padding: 12px 24px;
    font-weight: 600;
    transition: all 0.3s ease;
  }

  .btn-success:hover {
    background: linear-gradient(135deg, #00b368, #009961);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 200, 117, 0.3);
  }

  .create-user-btn {
    margin-bottom: 20px;
  }
  #createUserRole{
    height: 56px;
  }
</style>
<?php
include(BASE_PATH . '/user/homeComponent/view/home.php');
session_start();
$status = isset($_SESSION['statusUpdateProfil']) ? $_SESSION['statusUpdateProfil'] : null;
$message = isset($_SESSION['message']) ? $_SESSION['message'] : "";
unset($_SESSION['statusUpdateProfil']);
unset($_SESSION['message']);

?>
<div class="content">
  <div class="">
    <fieldset>
      <legend>
        <h5>Liste des Utilisateurs</h5>
      </legend>
      
      <div class="user-board">
        <div class="board-header">
          <h1 class="board-title">
            <div class="board-icon">👤</div>
            Informations du Profil
          </h1>
          <button type="button" class="btn btn-success create-user-btn" data-bs-toggle="modal" data-bs-target="#createUserModal">
            ➕ Créer Utilisateur
          </button>
        </div>

        <!-- User Profile Table -->
        <table class="board-table">
          <thead>
            <tr>
 
              <th style="width: 80px;">ID</th>
              <th style="width: 200px;">Nom d'utilisateur</th>
              <th style="width: 250px;">Email</th>
              <th style="width: 100px;">Rôle</th>
              <th style="width: 150px;">Date de Création</th>
              <th style="width: 120px;">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if (isset($dataUserGest) && !empty($dataUserGest)): ?>
              <?php foreach ($dataUserGest as $row): ?>
                <?php
                  $_SESSION['id']  =  $row['id'];
                  $_SESSION['name']  =  $row['nom'];
                  $_SESSION['email'] = $row['email']; 
                  $_SESSION['role'] = $row['role'];
                  $_SESSION['date_creation'] = $row['date_creation'];
                  
                  // Get user initials for avatar
                  $userInitials = strtoupper(substr($row['nom'], 0, 2));
                ?>
                
                <tr class="user-row" 
                    data-user-id="<?php echo $row['id'] ?? ''; ?>"
                    data-user-name="<?php echo htmlspecialchars($row['nom']); ?>"
                    data-user-email="<?php echo htmlspecialchars($row['email']); ?>"
                    data-user-role="<?php echo htmlspecialchars($row['role']); ?>">
                  
                  <td>
                    <div class="user-id-cell">
                      #<?php echo $row['id'] ?? 'N/A'; ?>
                    </div>
                  </td>
                  <td>
                    <div class="user-name-cell"> 
                      <?php echo htmlspecialchars($row['nom']); ?>
                    </div>
                  </td>
                  <td>
                    <div class="user-email-cell">
                      <?php echo htmlspecialchars($row['email']); ?>
                    </div>
                  </td>
                  
                  <td>
                    <span class="user-role-cell role-<?php echo strtolower($row['role']); ?>">
                      <?php echo htmlspecialchars(ucfirst($row['role'])); ?>
                    </span>
                  </td>
                  <td>
                    <div class="date-cell">
                      <?php echo htmlspecialchars(date('d/m/Y H:i', strtotime($row['date_creation']))); ?>
                    </div>
                  </td>
                  <td>
                    <div class="actions-cell">
                      <button type="button" class="action-btn action-btn-primary" 
                              data-bs-toggle="modal" 
                              data-bs-target="#updateUserModal"
                              data-user-id="<?php echo $row['id']; ?>"
                              data-user-name="<?php echo htmlspecialchars($row['nom']); ?>"
                              data-user-email="<?php echo htmlspecialchars($row['email']); ?>"
                              data-user-role="<?php echo htmlspecialchars($row['role']); ?>"
                              title="Modifier l'utilisateur">
                        ✏️
                      </button>
                      <form method="post"  style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                        <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                        <button class="action-btn action-btn-danger" type="submit" name="delete-user" title="Supprimer l'utilisateur">
                          🗑️
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="8">
                  <div class="empty-state">
                    <div class="empty-state-icon">👤</div>
                    <h3 class="empty-state-title">Aucun utilisateur trouvé</h3>
                    <p>Les informations des utilisateurs ne sont pas disponibles.</p>
                  </div>
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </fieldset>
  </div>
</div>
</div>


<!-- Create User Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createUserModalLabel">Créer un Nouvel Utilisateur</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="createUserName" class="form-label">Nom d'utilisateur</label>
            <input type="text" class="form-control" id="createUserName" name="user_name" required>
          </div>
          <div class="form-group">
            <label for="createUserEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="createUserEmail" name="user_email" required>
          </div>
          <div class="form-group">
            <label for="createUserPassword" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="createUserPassword" name="user_password" required>
          </div>
          <div class="form-group">
            <label for="createUserRole" class="form-label">Rôle</label>
            <select class="form-control" id="createUserRole" name="user_role" required>
              <option value="">Sélectionner un rôle</option>
              <option value="user">Utilisateur</option>
              <option value="admin">Administrateur</option>
              <option value="manager">Manager</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-success" name="create-user">Créer Utilisateur</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Update User Modal -->
<div class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateUserModalLabel">Modifier l'Utilisateur</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post">
        <div class="modal-body">
          <input type="hidden" id="updateUserId" name="user_id">
          <div class="form-group">
            <label for="updateUserName" class="form-label">Nom d'utilisateur</label>
            <input type="text" class="form-control" id="updateUserName" name="user_name" required>
          </div>
          <div class="form-group">
            <label for="updateUserEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="updateUserEmail" name="user_email" required>
          </div>
          <div class="form-group">
            <label for="updateUserPassword" class="form-label">Nouveau mot de passe (optionnel)</label>
            <input type="password" class="form-control" id="updateUserPassword" name="user_password" placeholder="Laisser vide pour conserver le mot de passe actuel">
          </div>
          <div class="form-group">
            <label for="updateUserRole" class="form-label">Rôle</label>
            <select class="form-control" id="updateUserRole" name="user_role" required>
              <option value="user">Utilisateur</option>
              <option value="admin">Administrateur</option>
              <option value="manager">Manager</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-primary" name="update-user">Modifier Utilisateur</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="returnModel" tabindex="-1" aria-labelledby="returnModelLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="returnModelLabel" style="color: #0c3783;">Information.</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="message">
        Votre réservation a été bien prise en compte.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

<script>
// Modal functionality for updating user
document.addEventListener('DOMContentLoaded', function() {
  var updateModal = document.getElementById('updateUserModal');
  
  updateModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var userId = button.getAttribute('data-user-id');
    var userName = button.getAttribute('data-user-name');
    var userEmail = button.getAttribute('data-user-email');
    var userRole = button.getAttribute('data-user-role');
    
    // Update modal fields
    document.getElementById('updateUserId').value = userId;
    document.getElementById('updateUserName').value = userName;
    document.getElementById('updateUserEmail').value = userEmail;
    document.getElementById('updateUserRole').value = userRole;
  });
});

// Existing modal functionality
var status = <?php echo json_encode($status); ?>;
var message = <?php echo json_encode($message); ?>;
if (status === "success") {
  var returnModel = new bootstrap.Modal(document.getElementById('returnModel'));
  document.getElementById("message").innerHTML = message;
  returnModel.show();
} else if (status === "error") {
  var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
  errorModal.show();
}
if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}
</script>