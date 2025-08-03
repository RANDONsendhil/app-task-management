 

<style>
 
  .taskPanel-board {
    background: #f6f7fb;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    margin: 20px 0;
    overflow: hidden;
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
    width: 24px;
    height: 24px;
    background: #6161ff;
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 14px;
  }

  .board-actions {
    display: flex;
    gap: 8px;
  }

  .monday-btn {
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 14px;
  }

  .monday-btn-primary {
    background: #0085ff;
    color: white;
  }

  .monday-btn-primary:hover {
    background: #0073e6;
  }

  .monday-btn-secondary {
    background: #f5f6fa;
    color: #676879;
    border: 1px solid #e6e9ef;
  }

  .monday-btn-secondary:hover {
    background: #ecedf5;
  }

  .board-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
  }

  .board-table thead {
    background: #f8f9fd;
  }

  .board-table th {
    padding: 12px 16px;
    text-align: left;
    font-weight: 500;
    font-size: 14px;
    color: #676879;
    border-bottom: 1px solid #e6e9ef;
    border-right: 1px solid #e6e9ef;
  }

  .board-table th:last-child {
    border-right: none;
  }

  .board-table td {
    padding: 12px 16px;
    border-bottom: 1px solid #e6e9ef;
    border-right: 1px solid #e6e9ef;
    vertical-align: middle;
  }

  .board-table td:last-child {
    border-right: none;
  }

  .board-table tbody tr:hover {
    background: #f8f9fd;
  }

  .project-name-cell {
    font-weight: 500;
    color: #323338;
    font-size: 14px;
  }

  .project-id-cell {
    font-weight: 600;
    color: #0085ff;
    font-size: 14px;
  }

  .date-cell {
    font-size: 14px;
    color: #676879;
  }

  .status-cell {
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .status-badge {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .status-todo {
    background: #c4c4c4;
    color: #323338;
  }

  .status-in_progress {
    background: #fdab3d;
    color: white;
  }

  .status-completed {
    background: #00c875;
    color: white;
  }

  .status-on_hold {
    background: #ff6b6b;
    color: white;
  }

  .priority-urgent {
    background: #e2445c;
  }

  .priority-cell {
    display: flex;
    align-items: center;
  }

  .priority-indicator {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    margin-right: 8px;
  }

  .priority-high {
    background: #ff6b6b;
  }

  .priority-medium {
    background: #ffd93d;
  }

  .priority-low {
    background: #6bcf7f;
  }

  .actions-cell {
    display: flex;
    gap: 4px;
  }

  .action-btn {
    width: 28px;
    height: 28px;
    border: none;
    border-radius: 4px;
    background: #f5f6fa;
    color: #676879;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
  }

  .action-btn:hover {
    background: #e6e9ef;
    color: #323338;
  }

  .description-preview {
    color: #676879;
    font-size: 12px;
    max-width: 200px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .user-avatar {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: #6161ff;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: 500;
  }

  .task-row {
    cursor: pointer;
  }

  .task-row:hover {
    background: #f8f9fd !important;
  }

  .add-item-row {
    background: #f8f9fd;
    border: 2px dashed #e6e9ef;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .add-item-row:hover {
    border-color: #0085ff;
    background: #f0f7ff;
  }

  .add-item-text {
    color: #676879;
    font-size: 14px;
    font-weight: 500;
    padding: 20px;
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

  .empty-state-text {
    font-size: 14px;
    margin-bottom: 24px;
  }

  /* Task Filters */
  .task-filters {
    background: #ffffff;
    padding: 16px 24px;
    border-bottom: 1px solid #e6e9ef;
    display: flex;
    gap: 20px;
    align-items: center;
    flex-wrap: wrap;
  }

  .filter-group {
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .filter-label {
    font-size: 14px;
    font-weight: 500;
    color: #323338;
    white-space: nowrap;
  }

  .filter-select {
    padding: 6px 12px;
    border: 1px solid #e6e9ef;
    border-radius: 4px;
    font-size: 14px;
    background: white;
    cursor: pointer;
    min-width: 140px;
  }

  .filter-select:focus {
    outline: none;
    border-color: #0085ff;
    box-shadow: 0 0 0 2px rgba(0, 133, 255, 0.1);
  }

  .filter-clear-btn {
    padding: 6px 16px;
    border: 1px solid #e6e9ef;
    border-radius: 4px;
    background: #f5f6fa;
    color: #676879;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .filter-clear-btn:hover {
    background: #ecedf5;
    border-color: #d0d4da;
  }

  .task-row.hidden {
    display: none !important;
  }

  .filter-stats {
    margin-left: auto;
    font-size: 12px;
    color: #676879;
    font-weight: 500;
  }
</style>

<div class="taskPanel-board">
  <div class="board-header">
    <h1 class="board-title">
      <div class="board-icon">P</div>
      <?php echo htmlspecialchars($resultProjectById["nom"]); ?>
    </h1>
    <div class="board-actions">
      <button class="monday-btn monday-btn-primary" onclick="openTaskModal()">
        + Ajouter tâche
      </button>
      <button class="monday-btn monday-btn-secondary" onclick="openProjectModal()">
        Détails projet
      </button>
    </div>
  </div>

  <!-- Task Filters -->
  <div class="task-filters">
    <div class="filter-group">
      <label for="statusFilter" class="filter-label">Statut:</label>
      <select id="statusFilter" class="filter-select">
        <option value="">Tous les statuts</option>
        <option value="todo">À faire</option>
        <option value="in_progress">En cours</option>
        <option value="completed">Terminée</option>
        <option value="on_hold">En attente</option>
      </select>
    </div>
    
    <div class="filter-group">
      <label for="priorityFilter" class="filter-label">Priorité:</label>
      <select id="priorityFilter" class="filter-select">
        <option value="">Toutes les priorités</option>
        <option value="low">Basse</option>
        <option value="medium">Moyenne</option>
        <option value="high">Haute</option>
        <option value="urgent">Urgente</option>
      </select>
    </div>
    
    <div class="filter-group">
      <label for="assigneeFilter" class="filter-label">Assigné à:</label>
      <select id="assigneeFilter" class="filter-select">
        <option value="">Tous les utilisateurs</option>
        <option value="unassigned">Non assigné</option>
        <?php if (isset($allUsers) && !empty($allUsers)): ?>
          <?php foreach ($allUsers as $user): ?>
            <option value="<?php echo htmlspecialchars($user['id']); ?>">
              <?php echo htmlspecialchars($user['nom']); ?>
            </option>
          <?php endforeach; ?>
        <?php endif; ?>
      </select>
    </div>
    
    <div class="filter-group">
      <button id="clearFilters" class="filter-clear-btn">Effacer les filtres</button>
    </div>
  </div>

  <!-- Task Management Table -->
  <table class="board-table">
    <thead>
      <tr>
        <th style="width: 40px;"></th>
        <th style="width: 100px;">Task ID</th>
        <th style="width: 200px;">Titre</th>
        <th style="width: 250px;">Description</th>
        <th style="width: 120px;">Statut</th>
        <th style="width: 100px;">Assigné ID</th>
        <th style="width: 100px;">Priorité</th>
        <th style="width: 120px;">Date Échéance</th>
        <th style="width: 80px;">Actions</th>
      </tr>
    </thead>
    <tbody>
      <!-- Tasks Rows -->
      <?php if (isset($projectTasks) && !empty($projectTasks)): ?>
        <?php foreach ($projectTasks as $task): ?>
          <tr class="task-row" onclick="editTask(<?php echo $task['id']; ?>)"
            data-task-id="<?php echo $task['id']; ?>"
            data-task-title="<?php echo htmlspecialchars($task['titre'] ?? $task['task_name']); ?>"
            data-task-description="<?php echo htmlspecialchars($task['description'] ?? ''); ?>"
            data-task-status="<?php echo $task['statut'] ?? $task['status']; ?>"
            data-task-assignee="<?php echo $task['assignee_id'] ?? $task['assigned_to']; ?>"
            data-task-priority="<?php echo $task['priorite'] ?? $task['priority']; ?>"
            data-task-due-date="<?php echo $task['date_echeance'] ?? $task['due_date'] ?? ''; ?>">
            <td>
              <div class="board-icon" style="background: #00c875;">T</div>
            </td>
            <td>
              <div class="project-id-cell">
                <?php echo $task['id'] ?? $task["id"]; ?>
              </div>
            </td>
            <td>
              <div class="project-name-cell">
                <?php echo htmlspecialchars($task['titre'] ?? $task['task_name']); ?>
              </div>
            </td>
            <td>
              <div class="description-preview">
                <?php echo htmlspecialchars(substr($task['description'] ?? '', 0, 80)) . (strlen($task['description'] ?? '') > 80 ? '...' : ''); ?>
              </div>
            </td>
            <td>
              <div class="status-cell">
                <span class="status-badge status-<?php echo $task['statut'] ?? $task['status']; ?>">
                  <?php
                  $statuses = [
                    'todo' => 'À faire',
                    'in_progress' => 'En cours',
                    'completed' => 'Terminée',
                    'on_hold' => 'En attente'
                  ];
                  echo $statuses[$task['statut'] ?? $task['status']] ?? ($task['statut'] ?? $task['status']);
                  ?>
                </span>
              </div>
            </td>
            <td>
              <?php if (!empty($task['assignee_id'] ?? $task['assigned_to'])): ?>
                <?php
                $assigneeId = $task['assignee_id'] ?? $task['assigned_to'];
                $userName = getUserNameById($assigneeId, $allUsers ?? []);
                $userInitials = getUserInitialsById($assigneeId, $allUsers ?? []);
                ?>

                <div style="display: flex; align-items: center; gap: 8px;">
                  <div class="user-avatar" title="<?php echo htmlspecialchars($userName ?: 'Utilisateur ID: ' . $assigneeId); ?>">
                    <?php echo htmlspecialchars($userInitials); ?>
                  </div>
                  <?php if ($userName): ?>
                    <span style="font-size: 12px; color: #323338;">
                      <?php echo htmlspecialchars($userName); ?>
                    </span>
                  <?php else: ?>
                    <span style="font-size: 12px; color: #676879;">
                      ID: <?php echo htmlspecialchars($assigneeId); ?>
                    </span>
                  <?php endif; ?>
                </div>
              <?php else: ?>
                <span style="color: #676879; font-size: 12px;">Non assigné</span>
              <?php endif; ?>
            </td>
            <td>
              <div class="priority-cell">
                <div class="priority-indicator priority-<?php echo $task['priorite'] ?? $task['priority']; ?>"></div>
                <span style="font-size: 14px;">
                  <?php
                  $priorities = [
                    'low' => 'Basse',
                    'medium' => 'Moyenne',
                    'high' => 'Haute',
                    'urgent' => 'Urgente'
                  ];
                  echo $priorities[$task['priorite'] ?? $task['priority']] ?? ($task['priorite'] ?? $task['priority']);
                  ?>
                </span>
              </div>
            </td>
            <td class="date-cell"><?php echo $task['date_echeance'] ?? $task['due_date'] ?? '-'; ?></td>
            <td>
              <div class="actions-cell">
                <button class="action-btn" onclick="event.stopPropagation(); editTask(<?php echo $task['id']; ?>)"
                  title="Modifier">
                  ✏️
                </button>
                <form method="post">
                  <input type='hidden' name='idTask' value='<?= $task['id'] ?>'>
                  <button class="action-btn" type="submit" name="delete-task" value="<?php echo $task['id']; ?>"
                    onclick="event.stopPropagation();"
                    title="Supprimer">
                    🗑️
                  </button>
                </form>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <!-- Empty State Row -->
        <tr>
          <td colspan="9">
            <div class="empty-state">
              <div class="empty-state-icon">📝</div>
              <h3 class="empty-state-title">Aucune tâche disponible</h3>
              <p class="empty-state-text">
                Commencez par créer votre première tâche pour ce projet.
              </p>
            </div>
          </td>
        </tr>
      <?php endif; ?>

      <!-- Add New Task Row -->
      <tr class="add-item-row" onclick="openTaskModal()">
        <td colspan="9">
          <div class="add-item-text">
            + Ajouter une nouvelle tâche
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</div>
