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
     padding: 10px 20px;
     border: none;
     border-radius: 8px;
     font-weight: 600;
     cursor: pointer;
     transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
     font-size: 14px;
     position: relative;
     overflow: hidden;
     text-transform: uppercase;
     letter-spacing: 0.5px;
     display: inline-flex;
     align-items: center;
     gap: 8px;
     min-height: 38px;
     box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
   }

   .monday-btn::before {
     content: '';
     position: absolute;
     top: 0;
     left: -100%;
     width: 100%;
     height: 100%;
     background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
     transition: left 0.6s ease;
   }

   .monday-btn:hover::before {
     left: 100%;
   }

   .monday-btn-primary {
     background: linear-gradient(135deg, #0085ff, #0066cc);
     color: white;
     box-shadow: 0 4px 15px rgba(0, 133, 255, 0.3);
   }

   .monday-btn-primary:hover {
     background: linear-gradient(135deg, #0073e6, #0052a3);
     transform: translateY(-2px);
     box-shadow: 0 6px 20px rgba(0, 133, 255, 0.4);
   }

   .monday-btn-primary:active {
     transform: translateY(0);
     box-shadow: 0 2px 8px rgba(0, 133, 255, 0.3);
   }

   .monday-btn-secondary {
     background: linear-gradient(135deg, #f8f9fd, #e6e9ef);
     color: #323338;
     border: 2px solid #e6e9ef;
     box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
   }

   .monday-btn-secondary:hover {
     background: linear-gradient(135deg, #e6e9ef, #d0d4da);
     border-color: #d0d4da;
     transform: translateY(-2px);
     box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
     color: #1a1a1a;
   }

   .monday-btn-secondary:active {
     transform: translateY(0);
     box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
   }

   /* Action buttons improvements */
   .action-btn {
     width: 32px;
     height: 32px;
     border: none;
     border-radius: 8px;
     background: linear-gradient(135deg, #f8f9fd, #e6e9ef);
     color: #676879;
     cursor: pointer;
     display: flex;
     align-items: center;
     justify-content: center;
     transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
     font-size: 14px;
     position: relative;
     overflow: hidden;
     box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
   }

   .action-btn::before {
     content: '';
     position: absolute;
     top: 0;
     left: -100%;
     width: 100%;
     height: 100%;
     background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
     transition: left 0.5s ease;
   }

   .action-btn:hover::before {
     left: 100%;
   }

   .action-btn:hover {
     background: linear-gradient(135deg, #e6e9ef, #d0d4da);
     color: #323338;
     transform: translateY(-2px) scale(1.05);
     box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
   }

   .action-btn:active {
     transform: translateY(0) scale(0.95);
     box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
   }

   /* Specific action button styles */
   .action-btn[title="Modifier"]:hover {
     background: linear-gradient(135deg, #4CAF50, #45a049);
     color: white;
     box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
   }

   .action-btn[title="Supprimer"]:hover {
     background: linear-gradient(135deg, #f44336, #d32f2f);
     color: white;
     box-shadow: 0 4px 12px rgba(244, 67, 54, 0.3);
   }

   /* Export button improvements */
   .export-btn:hover {
     background: linear-gradient(135deg, #FF9800, #F57C00);
     color: white;
     box-shadow: 0 4px 12px rgba(255, 152, 0, 0.3);
   }

   /* Filter button improvements */
   .filter-clear-btn {
     padding: 8px 16px;
     border: 2px solid #e6e9ef;
     border-radius: 8px;
     background: linear-gradient(135deg, #f8f9fd, #e6e9ef);
     color: #323338;
     font-size: 14px;
     font-weight: 500;
     cursor: pointer;
     transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
     text-transform: uppercase;
     letter-spacing: 0.5px;
     position: relative;
     overflow: hidden;
     box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
   }

   .filter-clear-btn::before {
     content: '';
     position: absolute;
     top: 0;
     left: -100%;
     width: 100%;
     height: 100%;
     background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
     transition: left 0.5s ease;
   }

   .filter-clear-btn:hover::before {
     left: 100%;
   }

   .filter-clear-btn:hover {
     background: linear-gradient(135deg, #e6e9ef, #d0d4da);
     border-color: #d0d4da;
     transform: translateY(-2px);
     box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
     color: #1a1a1a;
   }

   .filter-clear-btn:active {
     transform: translateY(0);
     box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
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
     0% {
       background-position: -200% 0;
     }

     100% {
       background-position: 200% 0;
     }
   }

   .board-table th {
     padding: 12px 16px;
     text-align: left;
     font-weight: 500;
     font-size: 14px;
     color: #676879;
     border-bottom: 1px solid #e6e9ef;
     border-right: 1px solid #e6e9ef;
     cursor: pointer;
     position: relative;
     transition: all 0.3s ease;
     user-select: none;
     background: linear-gradient(135deg, #f8f9fd, #e6e9ef);
   }

   .board-table th:hover {
     background: linear-gradient(135deg, #e6e9ef, #d0d4da);
     transform: translateY(-1px);
     box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
   }

   .board-table th.sortable {
     border-right: 1px solid rgba(255, 255, 255, 0.3);
   }

   .board-table th.sortable::after {
     content: '';
     display: inline-block;
     width: 0;
     height: 0;
     margin-left: 8px;
     vertical-align: middle;
     border-left: 4px solid transparent;
     border-right: 4px solid transparent;
     border-top: 4px solid #676879;
     opacity: 0.4;
     transition: all 0.3s ease;
   }

   .board-table th.sortable:hover::after {
     opacity: 0.8;
     transform: scale(1.2);
   }

   .board-table th.sort-asc {
     background: linear-gradient(135deg, #e3f2fd, #bbdefb);
     color: #1976d2;
     box-shadow: 0 2px 8px rgba(25, 118, 210, 0.2);
   }

   .board-table th.sort-asc::after {
     border-top: 6px solid #1976d2;
     border-bottom: 0;
     border-left: 4px solid transparent;
     border-right: 4px solid transparent;
     opacity: 1;
     transform: translateY(-1px);
   }

   .board-table th.sort-desc {
     background: linear-gradient(135deg, #e3f2fd, #bbdefb);
     color: #1976d2;
     box-shadow: 0 2px 8px rgba(25, 118, 210, 0.2);
   }

   .board-table th.sort-desc::after {
     border-bottom: 6px solid #1976d2;
     border-top: 0;
     border-left: 4px solid transparent;
     border-right: 4px solid transparent;
     opacity: 1;
     transform: translateY(1px);
   }

   .board-table th.sort-asc:hover,
   .board-table th.sort-desc:hover {
     background: linear-gradient(135deg, #bbdefb, #90caf9);
     transform: translateY(-2px);
     box-shadow: 0 4px 12px rgba(25, 118, 210, 0.3);
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
     background: linear-gradient(135deg, #f8f9fd, #ffffff);
     transform: translateY(-1px);
     box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
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
     gap: 6px;
     align-items: center;
   }

   .status-dropdown {
     padding: 4px 8px;
     border: 1px solid #e6e9ef;
     border-radius: 4px;
     font-size: 12px;
     background: white;
     cursor: pointer;
     min-width: 100px;
     transition: all 0.3s ease;
   }

   .status-dropdown:focus {
     outline: none;
     border-color: #0085ff;
     box-shadow: 0 0 0 2px rgba(0, 133, 255, 0.1);
   }

   .status-dropdown:hover {
     border-color: #0085ff;
     transform: translateY(-1px);
     box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
       <div class="board-icon">T</div>
       TASK - <?php echo htmlspecialchars($resultProjectById["nom"]); ?>
     </h1>
     <div class="board-actions">
       <button class="monday-btn monday-btn-secondary" onclick="openProjectModal()">
         Détails projet
       </button>
       <form method="post">
         <input type='hidden' name='export_project_pdf'
           value='<?php echo htmlspecialchars($resultProjectById['id']); ?>'>
         <button type="submit" name="export-pdf" class="monday-btn monday-btn-secondary" title="Exporter en PDF"
           onclick="exportProjectToPDF(<?php echo $resultProjectById['id']; ?>)">
           📄 Export PDF
         </button>
       </form>
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
       <button id="clearFilters" class="filter-clear-btn">Effacer les filtres</button>
     </div>
   </div>

   <!-- Task Management Table -->
   <table class="board-table">
     <thead>
       <tr>
         <th style="width: 40px;"></th>
         <th class="sortable" data-column="id" onclick="sortTaskTable('id')" style="width: 100px;">Task ID</th>
         <th class="sortable" data-column="titre" onclick="sortTaskTable('titre')" style="width: 200px;">Titre</th>
         <th class="sortable" data-column="description" onclick="sortTaskTable('description')" style="width: 250px;">
           Description</th>
         <th class="sortable" data-column="statut" onclick="sortTaskTable('statut')" style="width: 120px;">Statut</th>
         <th class="sortable" data-column="assignee" onclick="sortTaskTable('assignee')" style="width: 100px;">Assigné
           ID</th>
         <th class="sortable" data-column="priorite" onclick="sortTaskTable('priorite')" style="width: 100px;">Priorité
         </th>
         <th class="sortable" data-column="date_echeance" onclick="sortTaskTable('date_echeance')"
           style="width: 120px;">Date Échéance</th>
         <th style="width: 80px;">Actions</th>
       </tr>
     </thead>
     <tbody>
       <!-- Tasks Rows -->


       <?php if (isset($projectTasks) && !empty($projectTasks)): ?>
         <?php foreach ($projectTasks as $task): ?>
           <tr class="task-row" data-task-id="<?php echo $task['id']; ?>"
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
                   <div class="user-avatar"
                     title="<?php echo htmlspecialchars($userName ?: 'Utilisateur ID: ' . $assigneeId); ?>">
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
                 <form method="POST" style="display: inline;">
                   <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                   <select class="status-dropdown" name="modify-status-task-collaborateur" onchange="this.form.submit()"
                     onclick="event.stopPropagation();">
                     <option value="todo" <?php echo ($task['statut'] ?? $task['status']) === 'todo' ? 'selected' : ''; ?>>À
                       faire</option>
                     <option value="in_progress"
                       <?php echo ($task['statut'] ?? $task['status']) === 'in_progress' ? 'selected' : ''; ?>>En cours
                     </option>
                     <option value="completed"
                       <?php echo ($task['statut'] ?? $task['status']) === 'completed' ? 'selected' : ''; ?>>Terminée
                     </option>
                     <option value="on_hold"
                       <?php echo ($task['statut'] ?? $task['status']) === 'on_hold' ? 'selected' : ''; ?>>En attente
                     </option>
                   </select>
                   <input type="submit" style="display: none;">
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
     </tbody>
   </table>
   <?php include 'taskCreationModal.php'; ?>
 </div>

 <script>
   // Task Table Sorting Functionality
   let currentTaskSort = {
     column: null,
     direction: 'asc'
   };

   function sortTaskTable(column) {
     const table = document.querySelector('.board-table tbody');
     const rows = Array.from(table.querySelectorAll('.task-row'));

     // Determine sort direction
     if (currentTaskSort.column === column) {
       currentTaskSort.direction = currentTaskSort.direction === 'asc' ? 'desc' : 'asc';
     } else {
       currentTaskSort.direction = 'asc';
     }
     currentTaskSort.column = column;

     // Update header classes
     document.querySelectorAll('.board-table th').forEach(th => {
       th.classList.remove('sort-asc', 'sort-desc');
     });

     const currentHeader = document.querySelector(`th[data-column="${column}"]`);
     if (currentHeader) {
       currentHeader.classList.add(currentTaskSort.direction === 'asc' ? 'sort-asc' : 'sort-desc');
     }

     // Sort rows
     rows.sort((a, b) => {
       let aValue, bValue;

       switch (column) {
         case 'id':
           aValue = parseInt(a.getAttribute('data-task-id'));
           bValue = parseInt(b.getAttribute('data-task-id'));
           break;
         case 'titre':
           aValue = a.getAttribute('data-task-title').toLowerCase();
           bValue = b.getAttribute('data-task-title').toLowerCase();
           break;
         case 'description':
           aValue = a.getAttribute('data-task-description').toLowerCase();
           bValue = b.getAttribute('data-task-description').toLowerCase();
           break;
         case 'statut':
           aValue = a.getAttribute('data-task-status').toLowerCase();
           bValue = b.getAttribute('data-task-status').toLowerCase();
           break;
         case 'assignee':
           aValue = a.getAttribute('data-task-assignee') || '';
           bValue = b.getAttribute('data-task-assignee') || '';
           break;
         case 'priorite':
           // Sort by priority order: urgent > high > medium > low
           const priorityOrder = {
             'urgent': 4,
             'high': 3,
             'medium': 2,
             'low': 1
           };
           aValue = priorityOrder[a.getAttribute('data-task-priority')] || 0;
           bValue = priorityOrder[b.getAttribute('data-task-priority')] || 0;
           break;
         case 'date_echeance':
           aValue = new Date(a.getAttribute('data-task-due-date') || '9999-12-31');
           bValue = new Date(b.getAttribute('data-task-due-date') || '9999-12-31');
           break;
         default:
           return 0;
       }

       if (aValue < bValue) return currentTaskSort.direction === 'asc' ? -1 : 1;
       if (aValue > bValue) return currentTaskSort.direction === 'asc' ? 1 : -1;
       return 0;
     });

     // Re-append sorted rows
     rows.forEach(row => table.appendChild(row));

     // Keep the add-item-row at the bottom
     const addItemRow = table.querySelector('.add-item-row');
     if (addItemRow) {
       table.appendChild(addItemRow);
     }

     // Reapply task filters if they exist
     if (typeof applyTaskFilters === 'function') {
       applyTaskFilters();
     }
   }

   // Task Filtering Functionality
   function applyTaskFilters() {
     console.log('Applying filters...'); // Debug

     const statusFilter = document.getElementById('statusFilter');
     const priorityFilter = document.getElementById('priorityFilter');

     const statusValue = statusFilter ? statusFilter.value.trim() : '';
     const priorityValue = priorityFilter ? priorityFilter.value.trim() : '';

     console.log('Status filter:', statusValue, 'Priority filter:', priorityValue); // Debug

     const taskRows = document.querySelectorAll('.task-row[data-task-id]');
     let visibleCount = 0;
     let totalCount = taskRows.length;

     console.log('Found', totalCount, 'task rows'); // Debug

     taskRows.forEach(row => {
       const taskStatus = (row.getAttribute('data-task-status') || '').trim();
       const taskPriority = (row.getAttribute('data-task-priority') || '').trim();

       console.log('Task', row.getAttribute('data-task-id'), '- Status:', taskStatus, 'Priority:',
         taskPriority); // Debug

       let shouldShow = true;

       // Status filter
       if (statusValue && statusValue !== '' && taskStatus !== statusValue) {
         shouldShow = false;
         console.log('Hidden by status filter'); // Debug
       }

       // Priority filter  
       if (priorityValue && priorityValue !== '' && taskPriority !== priorityValue) {
         shouldShow = false;
         console.log('Hidden by priority filter'); // Debug
       }

       if (shouldShow) {
         row.classList.remove('hidden');
         row.style.display = '';
         visibleCount++;
         console.log('Showing row'); // Debug
       } else {
         row.classList.add('hidden');
         row.style.display = 'none';
         console.log('Hiding row'); // Debug
       }
     });

     console.log('Visible:', visibleCount, 'Total:', totalCount); // Debug

     // Update filter stats
     updateTaskFilterStats(visibleCount, totalCount);

     // Update empty state if needed
     updateEmptyState(visibleCount);
   }

   function updateTaskFilterStats(visibleCount, totalCount) {
     let statsElement = document.querySelector('.filter-stats');

     // Create stats element if it doesn't exist
     if (!statsElement) {
       const filtersContainer = document.querySelector('.task-filters');
       if (filtersContainer) {
         statsElement = document.createElement('div');
         statsElement.className = 'filter-stats';
         filtersContainer.appendChild(statsElement);
       }
     }

     if (statsElement) {
       if (visibleCount === totalCount) {
         statsElement.textContent = `${totalCount} tâche${totalCount !== 1 ? 's' : ''}`;
         statsElement.style.color = '#676879';
         statsElement.style.fontWeight = '500';
       } else {
         statsElement.textContent = `${visibleCount} sur ${totalCount} tâche${totalCount !== 1 ? 's' : ''}`;
         statsElement.style.color = '#0085ff';
         statsElement.style.fontWeight = '600';
       }
     }
   }

   // Update empty state when no tasks match filters
   function updateEmptyState(visibleCount) {
     const tableBody = document.querySelector('.board-table tbody');
     let emptyStateRow = tableBody.querySelector('.filter-empty-state');

     if (visibleCount === 0) {
       if (!emptyStateRow) {
         emptyStateRow = document.createElement('tr');
         emptyStateRow.className = 'filter-empty-state';
         emptyStateRow.innerHTML = `
           <td colspan="9">
             <div class="empty-state">
               <div class="empty-state-icon">🔍</div>
               <h3 class="empty-state-title">Aucune tâche trouvée</h3>
               <p class="empty-state-text">
                 Aucune tâche ne correspond aux filtres sélectionnés.
               </p>
             </div>
           </td>
         `;
         // Insert before add-item-row
         const addItemRow = tableBody.querySelector('.add-item-row');
         if (addItemRow) {
           tableBody.insertBefore(emptyStateRow, addItemRow);
         } else {
           tableBody.appendChild(emptyStateRow);
         }
       }
       emptyStateRow.style.display = '';
     } else {
       if (emptyStateRow) {
         emptyStateRow.style.display = 'none';
       }
     }
   }

   // Initialize task filters
   document.addEventListener('DOMContentLoaded', function() {
     // Check for task notifications from session
     <?php if (isset($_SESSION['task_creation_status']) && $_SESSION['task_creation_status'] === 'success'): ?>
       showNotification('<?php echo addslashes($_SESSION['task_creation_message']); ?>', 'success');
       <?php unset($_SESSION['task_creation_status'], $_SESSION['task_creation_message']); ?>
     <?php endif; ?>

     <?php if (isset($_SESSION['task_update_status']) && $_SESSION['task_update_status'] === 'success'): ?>
       showNotification('<?php echo addslashes($_SESSION['task_update_message']); ?>', 'success');
       <?php unset($_SESSION['task_update_status'], $_SESSION['task_update_message']); ?>
     <?php endif; ?>

     <?php if (isset($_SESSION['task_creation_status']) && $_SESSION['task_creation_status'] === 'error'): ?>
       showNotification('<?php echo addslashes($_SESSION['task_creation_message']); ?>', 'error');
       <?php unset($_SESSION['task_creation_status'], $_SESSION['task_creation_message']); ?>
     <?php endif; ?>

     <?php if (isset($_SESSION['task_update_status']) && $_SESSION['task_update_status'] === 'error'): ?>
       showNotification('<?php echo addslashes($_SESSION['task_update_message']); ?>', 'error');
       <?php unset($_SESSION['task_update_status'], $_SESSION['task_update_message']); ?>
     <?php endif; ?>

     <?php if (isset($_SESSION['task_deletion_status']) && $_SESSION['task_deletion_status'] === 'success'): ?>
       showNotification('<?php echo addslashes($_SESSION['task_deletion_message']); ?>', 'success');
       <?php unset($_SESSION['task_deletion_status'], $_SESSION['task_deletion_message']); ?>
     <?php endif; ?>


     const statusFilter = document.getElementById('statusFilter');
     const priorityFilter = document.getElementById('priorityFilter');
     const clearFiltersBtn = document.getElementById('clearFilters');

     console.log('Initializing filters...'); // Debug
     console.log('Status filter found:', !!statusFilter); // Debug
     console.log('Priority filter found:', !!priorityFilter); // Debug

     if (statusFilter) {
       statusFilter.addEventListener('change', function() {
         console.log('Status filter changed to:', this.value); // Debug
         applyTaskFilters();
       });
     }

     if (priorityFilter) {
       priorityFilter.addEventListener('change', function() {
         console.log('Priority filter changed to:', this.value); // Debug
         applyTaskFilters();
       });
     }

     if (clearFiltersBtn) {
       clearFiltersBtn.addEventListener('click', function() {
         console.log('Clearing filters...'); // Debug
         if (statusFilter) statusFilter.value = '';
         if (priorityFilter) priorityFilter.value = '';
         applyTaskFilters();
       });
     }

     // Initialize filter stats and apply initial filters
     setTimeout(() => {
       console.log('Initial filter application'); // Debug
       applyTaskFilters();
     }, 100);
   });

   // Export project to PDF function
   function exportProjectToPDF(projectId) {
     // Show notification
     showNotification('Génération du PDF en cours...', 'info');
   }

   // Show export notification
   function showNotification(message, type = 'success') {
     // Create notification element
     const notification = document.createElement('div');
     const bgColor = type === 'success' ? '#00c875' : type === 'info' ? '#0085ff' : '#e2445c';

     notification.style.cssText = `
    position: fixed;
    top: 20px;
    right: 20px;
    background: ${bgColor};
    color: white;
    padding: 12px 20px;
    border-radius: 6px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    z-index: 10000;
    font-weight: 500;
    animation: slideInRight 0.3s ease;
    max-width: 300px;
  `;
     notification.textContent = message;

     // Add animation keyframes
     if (!document.querySelector('#exportNotificationStyles')) {
       const style = document.createElement('style');
       style.id = 'exportNotificationStyles';
       style.textContent = `
      @keyframes slideInRight {
        from {
          transform: translateX(100%);
          opacity: 0;
        }
        to {
          transform: translateX(0);
          opacity: 1;
        }
      }
      @keyframes fadeOut {
        from {
          opacity: 1;
        }
        to {
          opacity: 0;
          transform: translateX(100%);
        }
      }
    `;
       document.head.appendChild(style);
     }

     document.body.appendChild(notification);

     // Remove notification after 3 seconds
     setTimeout(() => {
       notification.style.animation = 'fadeOut 0.3s ease forwards';
       setTimeout(() => {
         if (document.body.contains(notification)) {
           document.body.removeChild(notification);
         }
       }, 300);
     }, 3000);
   }
 </script>