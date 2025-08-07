

<script>
 function goBack() {
    window.history.back();
  }

  function modifyProject(projectId) {
    // Redirect to edit project page
    window.location.href = '/project/edit/' + projectId;
  }

  function deleteProject(projectId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce projet? Cette action est irréversible.')) {
      // Send delete request
      window.location.href = '/project/delete/' + projectId;
    }
  }

  // Project Modal Functions
  function openProjectModal() {
    document.getElementById('projectModal').style.display = 'block';
    document.body.style.overflow = 'hidden'; // Prevent scrolling
  }

  function closeProjectModal() {
    document.getElementById('projectModal').style.display = 'none';
    document.body.style.overflow = 'auto'; // Restore scrolling
  }

  // Task Modal Functions
  function openTaskModal() {
    // Reset modal for create mode
    resetTaskModal();
    document.getElementById('taskModalTitle').textContent = 'Créer une nouvelle tâche';
    document.getElementById('taskSubmitText').textContent = 'Créer la tâche';
    document.getElementById('edit_mode').value = '0';
    document.getElementById('task_id').value = '';
    
    // Reset submit button name for create mode
    document.getElementById('taskSubmitBtn').setAttribute('name', 'submit-task');

    document.getElementById('taskModal').style.display = 'block';
    document.body.style.overflow = 'hidden'; // Prevent scrolling
  }

  function closeTaskModal() {
    document.getElementById('taskModal').style.display = 'none';
    document.body.style.overflow = 'auto'; // Restore scrolling
    // Reset form
    resetTaskModal();
  }

  function resetTaskModal() {
    document.getElementById('taskForm').reset();

    // Reset hidden fields
    document.getElementById('edit_mode').value = '0';
    document.getElementById('task_id').value = '';
    
    // Reset submit button name to default (create mode)
    document.getElementById('taskSubmitBtn').setAttribute('name', 'submit-task');
  }

  function submitTaskForm(event) {
    // Prevent default form submission
    if (event) {
      event.preventDefault();
    }

    // Get project ID from session or PHP
    const sessionProjectId =
      <?php echo isset($_SESSION['current_project_id']) ? $_SESSION['current_project_id'] : 'null'; ?>;
    const formProjectId = <?php echo isset($resultProjectById['id']) ? $resultProjectById['id'] : 'null'; ?>;
    const projectId = sessionProjectId || formProjectId;

 

    if (!projectId) {
      alert('Erreur: Aucun projet sélectionné. Impossible de créer la tâche.');
      return false;
    }

    // Get form data
    const form = document.getElementById('taskForm');
    const formData = new FormData(form);

    // Ensure project ID is set correctly
    formData.set('projet_id', projectId);
    formData.set('idproject', projectId); // This is what the backend expects

    // Check if we're in edit mode
    const editMode = document.getElementById('edit_mode').value;
    const isEditing = editMode === '1';

    // Validate required fields
    const titre = formData.get('titre');
    if (!titre || titre.trim() === '') {
      alert('Veuillez saisir un titre pour la tâche');
      return false;
    }

    // Show loading state
    const submitButton = form.querySelector('button[name="submit-task"]');
    const originalText = submitButton.textContent;
    submitButton.textContent = isEditing ? 'Mise à jour en cours...' : 'Création en cours...';
    submitButton.disabled = true;

    // Debug: Log form data
    console.log('Form data:');
    for (let [key, value] of formData.entries()) {
      console.log(key + ': ' + value);
    }

    // Submit form with AJAX to the current page (which handles the POST)
    fetch(window.location.href, {
        method: 'POST',
        body: formData
      })
      .then(response => {
        console.log('Response status:', response.status);
        if (!response.ok) {
          throw new Error('Erreur réseau: ' + response.status);
        }
        return response.text(); // Changed from json() to text() to handle any response
      })
      .then(data => {
        console.log('Response data:', data);

        // Try to parse as JSON, fallback to treating as success
        let result;
        try {
          result = JSON.parse(data);
        } catch (e) {
          // If not JSON, assume success if no error in response
          result = {
            success: true,
            message: isEditing ? 'Tâche mise à jour avec succès' : 'Tâche créée avec succès'
          };
        }

        if (result.success !== false) {
          alert(isEditing ? 'Tâche mise à jour avec succès!' : 'Tâche créée avec succès!');
          closeTaskModal();

          // No need to reload - the server redirect will handle page refresh

        } else {
          alert('Erreur lors de ' + (isEditing ? 'la mise à jour' : 'la création') + ': ' + (result.message || 'Erreur inconnue'));
        }
      })
      .catch(error => {
        console.error('Erreur:', error);
        alert('Erreur lors de ' + (isEditing ? 'la mise à jour' : 'la création') + ' de la tâche. La tâche pourrait avoir été ' + (isEditing ? 'mise à jour' : 'créée') + ' malgré l\'erreur.');

        // Close modal - no need to reload as server handles redirect
        closeTaskModal();
      })
      .finally(() => {
        // Restore button state
        submitButton.textContent = originalText;
        submitButton.disabled = false;
      });

    return false; // Always prevent default form submission
  }

  // Close modal with Escape key
  document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
      const taskModal = document.getElementById('taskModal');
      const projectModal = document.getElementById('projectModal');

      if (taskModal && taskModal.style.display === 'block') {
        closeTaskModal();
      }
      if (projectModal && projectModal.style.display === 'block') {
        closeProjectModal();
      }
    }
  });

  // Set default dates and form event listeners
  document.addEventListener('DOMContentLoaded', function() {
    const today = new Date().toISOString().split('T')[0];
    const dateEcheanceField = document.getElementById('date_echeance');
    if (dateEcheanceField) {
      // Set default due date to one week from today
      const nextWeek = new Date();
      nextWeek.setDate(nextWeek.getDate() + 7);
      dateEcheanceField.value = nextWeek.toISOString().split('T')[0];
    }

    // Add search functionality to assignee dropdown
    const assigneeSelect = document.getElementById('assignee_id');

    // Initialize task filters
    initializeTaskFilters();
  });

  // Task Filter Functions
  function initializeTaskFilters() {
    const statusFilter = document.getElementById('statusFilter');
    const priorityFilter = document.getElementById('priorityFilter');
    const assigneeFilter = document.getElementById('assigneeFilter');
    const clearFiltersBtn = document.getElementById('clearFilters');

    if (statusFilter) {
      statusFilter.addEventListener('change', applyTaskFilters);
    }
    if (priorityFilter) {
      priorityFilter.addEventListener('change', applyTaskFilters);
    }
    if (assigneeFilter) {
      assigneeFilter.addEventListener('change', applyTaskFilters);
    }
    if (clearFiltersBtn) {
      clearFiltersBtn.addEventListener('click', clearAllFilters);
    }

    // Initial filter application
    applyTaskFilters();
  }

  function applyTaskFilters() {
    const statusFilter = document.getElementById('statusFilter')?.value.toLowerCase() || '';
    const priorityFilter = document.getElementById('priorityFilter')?.value.toLowerCase() || '';
    const assigneeFilter = document.getElementById('assigneeFilter')?.value || '';

    const taskRows = document.querySelectorAll('.task-row[data-task-id]');
    let visibleCount = 0;
    let totalCount = taskRows.length;

    taskRows.forEach(row => {
      const taskStatus = row.getAttribute('data-task-status')?.toLowerCase() || '';
      const taskPriority = row.getAttribute('data-task-priority')?.toLowerCase() || '';
      const taskAssignee = row.getAttribute('data-task-assignee') || '';

      // Check status filter
      const statusMatch = !statusFilter || taskStatus === statusFilter;

      // Check priority filter
      const priorityMatch = !priorityFilter || taskPriority === priorityFilter;

      // Check assignee filter
      let assigneeMatch = true;
      if (assigneeFilter) {
        if (assigneeFilter === 'unassigned') {
          assigneeMatch = !taskAssignee || taskAssignee === '';
        } else {
          assigneeMatch = taskAssignee === assigneeFilter;
        }
      }

      // Show/hide row based on all filters
      if (statusMatch && priorityMatch && assigneeMatch) {
        row.classList.remove('hidden');
        visibleCount++;
      } else {
        row.classList.add('hidden');
      }
    });

    updateFilterStats(visibleCount, totalCount);
    updateEmptyState(visibleCount);
  }

  function submitTaskForm(event) {
    // Prevent default form submission
    if (event) {
      event.preventDefault();
    }

    // Get project ID from session or PHP
    const sessionProjectId =
      <?php echo isset($_SESSION['current_project_id']) ? $_SESSION['current_project_id'] : 'null'; ?>;
    const formProjectId = <?php echo isset($resultProjectById['id']) ? $resultProjectById['id'] : 'null'; ?>;
    const projectId = sessionProjectId || formProjectId;

 

    if (!projectId) {
      alert('Erreur: Aucun projet sélectionné. Impossible de créer la tâche.');
      return false;
    }

    // Get form data
    const form = document.getElementById('taskForm');
    const formData = new FormData(form);

    // Ensure project ID is set correctly
    formData.set('projet_id', projectId);
    formData.set('idproject', projectId); // This is what the backend expects

    // Check if we're in edit mode
    const editMode = document.getElementById('edit_mode').value;
    const isEditing = editMode === '1';

    // Validate required fields
    const titre = formData.get('titre');
    if (!titre || titre.trim() === '') {
      alert('Veuillez saisir un titre pour la tâche');
      return false;
    }

    // Show loading state
    const submitButton = form.querySelector('button[name="submit-task"]');
    const originalText = submitButton.textContent;
    submitButton.textContent = isEditing ? 'Mise à jour en cours...' : 'Création en cours...';
    submitButton.disabled = true;

    // Debug: Log form data
    console.log('Form data:');
    for (let [key, value] of formData.entries()) {
      console.log(key + ': ' + value);
    }

    // Submit form with AJAX to the current page (which handles the POST)
    fetch(window.location.href, {
        method: 'POST',
        body: formData
      })
      .then(response => {
        console.log('Response status:', response.status);
        if (!response.ok) {
          throw new Error('Erreur réseau: ' + response.status);
        }
        return response.text(); // Changed from json() to text() to handle any response
      })
      .then(data => {
        console.log('Response data:', data);

        // Try to parse as JSON, fallback to treating as success
        let result;
        try {
          result = JSON.parse(data);
        } catch (e) {
          // If not JSON, assume success if no error in response
          result = {
            success: true,
            message: isEditing ? 'Tâche mise à jour avec succès' : 'Tâche créée avec succès'
          };
        }

        if (result.success !== false) {
          alert(isEditing ? 'Tâche mise à jour avec succès!' : 'Tâche créée avec succès!');
          closeTaskModal();

          // No need to reload - the server redirect will handle page refresh

        } else {
          alert('Erreur lors de ' + (isEditing ? 'la mise à jour' : 'la création') + ': ' + (result.message || 'Erreur inconnue'));
        }
      })
      .catch(error => {
        console.error('Erreur:', error);
        alert('Erreur lors de ' + (isEditing ? 'la mise à jour' : 'la création') + ' de la tâche. La tâche pourrait avoir été ' + (isEditing ? 'mise à jour' : 'créée') + ' malgré l\'erreur.');

        // Close modal - no need to reload as server handles redirect
        closeTaskModal();
      })
      .finally(() => {
        // Restore button state
        submitButton.textContent = originalText;
        submitButton.disabled = false;
      });

    return false; // Always prevent default form submission
  }

  function clearAllFilters() {
    const statusFilter = document.getElementById('statusFilter');
    const priorityFilter = document.getElementById('priorityFilter');
    const assigneeFilter = document.getElementById('assigneeFilter');

    if (statusFilter) statusFilter.value = '';
    if (priorityFilter) priorityFilter.value = '';
    if (assigneeFilter) assigneeFilter.value = '';

    applyTaskFilters();
  }

  function updateFilterStats(visibleCount, totalCount) {
    // Add or update filter stats display
    let statsElement = document.querySelector('.filter-stats');
    if (!statsElement) {
      statsElement = document.createElement('div');
      statsElement.className = 'filter-stats';
      document.querySelector('.task-filters')?.appendChild(statsElement);
    }

    if (visibleCount === totalCount) {
      statsElement.textContent = `${totalCount} tâche${totalCount !== 1 ? 's' : ''}`;
    } else {
      statsElement.textContent = `${visibleCount} sur ${totalCount} tâche${totalCount !== 1 ? 's' : ''}`;
    }
  }

  function updateEmptyState(visibleCount) {
    const emptyStateRow = document.querySelector('.board-table tbody tr:not(.task-row):not(.add-item-row)');
    const addItemRow = document.querySelector('.add-item-row');

    if (visibleCount === 0) {
      // Show "no results" message
      if (emptyStateRow) {
        const emptyStateContent = emptyStateRow.querySelector('.empty-state');
        if (emptyStateContent) {
          emptyStateContent.innerHTML = `
            <div class="empty-state-icon">🔍</div>
            <h3 class="empty-state-title">Aucune tâche trouvée</h3>
            <p class="empty-state-text">
              Aucune tâche ne correspond aux filtres sélectionnés.
            </p>
          `;
        }
        emptyStateRow.style.display = '';
      }
      if (addItemRow) {
        addItemRow.style.display = 'none';
      }
    } else {
      // Hide empty state when there are visible tasks
      if (emptyStateRow) {
        emptyStateRow.style.display = 'none';
      }
      if (addItemRow) {
        addItemRow.style.display = '';
      }
    }
  }

  // Task Management Functions
  function editTask(taskId) {
    // Find task data from the table row
    const taskData = getTaskDataFromTable(taskId);

    if (!taskData) {
      alert('Erreur: Impossible de récupérer les données de la tâche');
      return;
    }

    // Reset all form fields FIRST, before setting edit mode
    resetTaskModal();

    // Set modal to edit mode AFTER reset
    document.getElementById('taskModalTitle').textContent = 'Modifier la tâche '+ taskId;
    document.getElementById('taskSubmitText').textContent = 'Mettre à jour la tâche';
    document.getElementById('edit_mode').value = '1';
    document.getElementById('task_id').value = taskId;
    
    // Change submit button name for edit mode (after reset)
    document.getElementById('taskSubmitBtn').setAttribute('name', 'submit-edit-task');

    // Pre-fill form fields
    populateTaskForm(taskData);

    // Open modal
    document.getElementById('taskModal').style.display = 'block';
    document.body.style.overflow = 'hidden';
  }

  function getTaskDataFromTable(taskId) {
    // Find the task row by task ID using data attribute
    const taskRow = document.querySelector(`tr[data-task-id="${taskId}"]`);

    if (!taskRow) {
      return null;
    }

    return {
      id: taskId,
      titre: taskRow.getAttribute('data-task-title') || '',
      description: taskRow.getAttribute('data-task-description') || '',
      statut: taskRow.getAttribute('data-task-status') || 'todo',
      assignee_id: taskRow.getAttribute('data-task-assignee') || '',
      priorite: taskRow.getAttribute('data-task-priority') || 'medium',
      date_echeance: taskRow.getAttribute('data-task-due-date') || ''
    };
  }

  function populateTaskForm(taskData) {
    // Populate form fields
    document.getElementById('titre').value = taskData.titre || '';
    document.getElementById('description').value = taskData.description || '';
    document.getElementById('priorite').value = taskData.priorite || 'medium';
    document.getElementById('statut').value = taskData.statut || 'todo';

    // Handle assignee selection
    const assigneeSelect = document.getElementById('assignee_id');
    if (assigneeSelect) {
      assigneeSelect.value = taskData.assignee_id || '';
    }

    // Handle date
    if (taskData.date_echeance && taskData.date_echeance !== '-') {
      document.getElementById('date_echeance').value = taskData.date_echeance;
    } else {
      document.getElementById('date_echeance').value = '';
    }
  }

  function deleteTask(taskId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette tâche? Cette action est irréversible.')) {
      // Send delete request
      window.location.href = '/task/delete/' + taskId;
    }
  }</script>
<style>
  .task-modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
  }

  .task-modal-content {
    background-color: #fefefe;
    margin: 3% auto;
    padding: 0;
    border: none;
    width: 90%;
    max-width: 600px;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    animation: modalSlideIn 0.3s;
  }

  @keyframes modalSlideIn {
    from {
      opacity: 0;
      transform: translateY(-30px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .task-modal-header {
    background: linear-gradient(135deg, #28a745, #1e7e34);
    color: white;
    padding: 20px;
    border-radius: 8px 8px 0 0;
    position: relative;
  }

  .task-modal-title {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 600;
  }

  .task-close {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
    position: absolute;
    right: 15px;
    top: 15px;
    cursor: pointer;
  }

  .task-close:hover {
    color: #ccc;
  }

  .task-modal-body {
    padding: 30px;
  }

  .task-form-group {
    margin-bottom: 20px;
  }

  .task-form-label {
    display: block;
    font-weight: 600;
    color: #495057;
    margin-bottom: 8px;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .task-form-input,
  .task-form-textarea,
  .task-form-select {
    width: 100%;
    padding: 12px;
    border: 2px solid #e9ecef;
    border-radius: 6px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
    box-sizing: border-box;
  }

  .task-form-select {
    max-height: 200px;
    overflow-y: auto;
  }

  .scrollable-select select {
    width: 100%;
    padding: 12px;
    border: 2px solid #e9ecef;
    border-radius: 6px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
    box-sizing: border-box;
    background-color: white;
    cursor: pointer;
    max-height: 200px;
    overflow-y: auto;
  }

  .scrollable-select select:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
  }

  /* For browsers that support it, limit visible options */
  .scrollable-select select {
    size: 1;
  }

  .scrollable-select select[multiple] {
    size: 8;
    max-height: 200px;
  }

  .task-form-input:focus,
  .task-form-textarea:focus,
  .task-form-select:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
  }

  .task-form-textarea {
    height: 100px;
    resize: vertical;
  }

  .task-modal-footer {
    padding: 20px 30px;
    border-top: 1px solid #e9ecef;
    text-align: right;
    border-radius: 0 0 8px 8px;
    background-color: #f8f9fa;
  }

  .task-form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
  }
</style>

<!-- Task Creation Modal -->
<div id="taskModal" class="task-modal">
   <?php    "HERE".(($_SESSION['current_project_id'])) ?>
  <div class="task-modal-content">
    <div class="task-modal-header">
      <span class="task-close" onclick="closeTaskModal()">&times;</span>
      <h2 class="task-modal-title" id="taskModalTitle">Créer une nouvelle tâchffffe</h2>
    </div>

    <div class="task-modal-body">
      
      <form id="taskForm" action="/home/selectProject/project" method="POST">
  
        <input type="hidden" name="projet_id"
          value="<?php echo isset($_SESSION['current_project_id']) ? $_SESSION['current_project_id'] : (isset($resultProjectById['id']) ? $resultProjectById['id'] : ''); ?>">
        <input type="hidden" name="session_id" value="<?php echo session_id(); ?>">
        <input type="hidden" id="task_id" name="task_id" value="">
        <input type="hidden" id="edit_mode" name="edit_mode" value="0">
       

        <div class="task-form-group">
          <label class="task-form-label" for="titre">Titre de la tâche *</label>
          <input type="text" id="titre" name="titre" class="task-form-input" required
            placeholder="Entrez le titre de la tâche">
        </div>

        <div class="task-form-group">
          <label class="task-form-label" for="description">Description</label>
          <textarea id="description" name="description" class="task-form-textarea"
            placeholder="Décrivez la tâche en détail"></textarea>
        </div>

        <div class="task-form-row">
          <div class="task-form-group">
            <label class="task-form-label" for="priorite">Priorité</label>
            <select id="priorite" name="priorite" class="task-form-select">
              <option value="low">Basse</option>
              <option value="medium" selected>Moyenne</option>
              <option value="high">Haute</option>
              <option value="urgent">Urgente</option>
            </select>
          </div>

          <div class="task-form-group">
            <label class="task-form-label" for="statut">Statut</label>
            <select id="statut" name="statut" class="task-form-select">
              <option value="todo" selected>À faire</option>
              <option value="in_progress">En cours</option>
              <option value="completed">Terminée</option>
              <option value="on_hold">En attente</option>
            </select>
          </div>
        </div>

        <div class="task-form-row">
          <div class="task-form-group">
            <label class="task-form-label" for="assignee_id">Assigné à</label>
            <select id="assignee_id" name="assignee_id" class="task-form-select">
              <option value="">-- Sélectionner un utilisateur --</option>
              <?php if (isset($allUsers) && !empty($allUsers)): ?>
                <?php foreach ($allUsers as $user): ?>
                  <option value="<?php echo htmlspecialchars($user['id']); ?>">Id: <?php echo htmlspecialchars($user['id']); ?> - Nom: <?php echo htmlspecialchars($user['nom']); ?></option>
                <?php endforeach; ?>
              <?php else: ?>
                <option value="" disabled>Aucun utilisateur disponible</option>
              <?php endif; ?>
            </select>
          </div>

          <div class="task-form-group">
            <label class="task-form-label" for="date_echeance">Date d'échéance</label>
            <input type="date" required id="date_echeance" name="date_echeance" class="task-form-input">
          </div>
        </div>

        <div class="task-modal-footer">
          <button type="button" class="tile-btn tile-btn-secondary" onclick="closeTaskModal()">
            Annuler 
          </button>
          <input type='hidden' name='idproject' value=<?php echo isset($_SESSION['current_project_id'])?>>
          <button type="submit" class="tile-btn tile-btn-success" id="taskSubmitBtn" name="submit-task">
            <span id="taskSubmitText">Créer la tâche</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
