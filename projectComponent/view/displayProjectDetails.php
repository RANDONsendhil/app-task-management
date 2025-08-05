<?php
define('BASE_PATH', __DIR__);

// Store current project in session if available
if (isset($resultProjectById) && !empty($resultProjectById)) {
  $_SESSION['current_project'] = $resultProjectById;
  $_SESSION['current_project_id'] = $resultProjectById['id'];
}

// Retrieve project from session if not available in current context
if (!isset($resultProjectById) && isset($_SESSION['current_project'])) {
  $resultProjectById = $_SESSION['current_project'];
}

// Store project tasks in session if available
if (isset($projectTasks) && !empty($projectTasks)) {
  $_SESSION['current_project_tasks'] = $projectTasks;
} elseif (!isset($projectTasks) && isset($_SESSION['current_project_tasks'])) {
  $projectTasks = $_SESSION['current_project_tasks'];
}

// Helper function to get user name by ID
function getUserNameById($userId, $allUsers)
{
  if (empty($userId) || empty($allUsers)) {
    return null;
  }

  foreach ($allUsers as $user) {
    if ($user['id'] == $userId || $user['nom'] == $userId) {
      return $user['nom'] ?? ($user['nom'] . ' ' . $user['nom']);
    }
  }
  return null;
}

// Helper function to get user initials by ID  
function getUserInitialsById($userId, $allUsers)
{
  $userName = getUserNameById($userId, $allUsers);
  if ($userName) {
    $nameParts = explode(' ', trim($userName));
    if (count($nameParts) >= 2) {
      return strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1));
    } else {
      return strtoupper(substr($userName, 0, 2));
    }
  }
  return substr($userId, 0, 2); // Fallback to ID if name not found
}

include(BASE_PATH . '/user/homeComponent/view/home.php');
?>
<style>
  .card-body a {
    font-size: 14px;
  }

  .btn {
    width: 230px;
  }

  .project-header {
    margin-bottom: 15px;
    border-bottom: 2px solid #e9ecef;
    padding-bottom: 10px;
    text-align: center;
  }

  .project-id {
    font-weight: bold;
    color: #007bff;
    display: block;
  }

  .project-name {
    font-weight: 600;
    color: #343a40;
    display: block;
    min-height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 5px 0;
  }

  .project-info {
    margin-bottom: 8px;
  }

  .date-label {
    font-weight: 600;
    color: #6c757d;
    margin-right: 8px;
  }

  .card-text {
    font-size: 14px;
    line-height: 1.4;
  }

  .specialization-title {
    font-size: 16px;
    font-weight: 500;
    margin-bottom: 10px;
  }

  .description-highlight {
    background-color: #f8f9fa;
    border-left: 4px solid #007bff;
    padding: 10px;
    margin: 10px 0;
    border-radius: 4px;
  }

  .description-text {
    font-weight: 500;
    color: #495057;
    margin: 0;
  }

  .date-value {
    color: #28a745;
    font-weight: 500;
  }

  .project-actions {
    margin-top: 20px;
    padding-top: 15px;
    border-top: 1px solid #e9ecef;
    text-align: center;
  }

  .alert {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
  }

  .alert-warning {
    color: #856404;
    background-color: #fff3cd;
    border-color: #ffeaa7;
  }

  .card {
    max-width: 600px;
    margin: 0 auto;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    padding: 20px;
  }

  /* Tile Styles */
  .project-tile {
    max-width: 1300px;
    margin: 20px auto;
    background: white;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    overflow: hidden;
  }

  .tile-header {
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
    /* padding: 30px; */
    text-align: center;
  }

  .tile-title {
    margin: 0;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 10px;
  }

  .tile-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
    margin: 0;
  }

  .tile-body {
    padding: 20px;
  }

  .tile-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 25px;
    margin-bottom: 30px;
  }

  .tile-item {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    border-left: 4px solid #007bff;
    transition: transform 0.2s ease;
  }

  .tile-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  }

  .tile-label {
    font-weight: 600;
    color: #495057;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
    display: block;
  }

  .tile-value {
    color: #28a745;
    font-weight: 600;
    font-size: 1.1rem;
  }

  .tile-description {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border: none;
    border-left: 4px solid #007bff;
    padding: 25px;
    border-radius: 8px;
    margin: 25px 0;
    font-size: 1rem;
    line-height: 1.6;
    color: #495057;
  }

  .tile-actions {
    display: flex;
    justify-content: center;
    gap: 15px;
    padding-top: 25px;
    border-top: 2px solid #e9ecef;
  }

  .tile-btn {
    padding: 12px 30px;
    border: none;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.95rem;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .tile-btn-success {
    background: #28a745;
    color: white;
  }

  .tile-btn-success:hover {
    background: #218838;
    transform: translateY(-2px);
  }

  .tile-btn-danger {
    background: #dc3545;
    color: white;
  }

  .tile-btn-danger:hover {
    background: #c82333;
    transform: translateY(-2px);
  }

  .tile-btn-secondary {
    background: #6c757d;
    color: white;
  }

  .tile-btn-secondary:hover {
    background: #5a6268;
    transform: translateY(-2px);
  }

  .tile-btn-primary {
    background: #007bff;
    color: white;
  }

  .tile-btn-primary:hover {
    background: #0056b3;
    transform: translateY(-2px);
  }

  /* Tasks Display Section */
  .tasks-section {
    max-width: 800px;
    margin: 20px auto;
    background: white;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    overflow: hidden;
  }

  .tasks-header {
    background: linear-gradient(135deg, #28a745, #1e7e34);
    color: white;
    padding: 20px;
    text-align: center;
  }

  .tasks-title {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 600;
  }

  .tasks-body {
    padding: 30px;
  }

  .task-card {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 15px;
    border-left: 4px solid #007bff;
    transition: all 0.3s ease;
  }

  .task-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  }

  .task-card:last-child {
    margin-bottom: 0;
  }

  .task-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
  }

  .task-name {
    font-size: 1.2rem;
    font-weight: 600;
    color: #343a40;
    margin: 0;
  }

  .task-priority {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
  }

  .priority-low {
    background: #d4edda;
    color: #155724;
  }

  .priority-medium {
    background: #fff3cd;
    color: #856404;
  }

  .priority-high {
    background: #f8d7da;
    color: #721c24;
  }

  .priority-urgent {
    background: #dc3545;
    color: white;
  }

  .task-status {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    margin-left: 10px;
  }

  .status-todo {
    background: #e9ecef;
    color: #495057;
  }

  .status-in_progress {
    background: #cce5ff;
    color: #004085;
  }

  .status-completed {
    background: #d4edda;
    color: #155724;
  }

  .status-on_hold {
    background: #fff3cd;
    color: #856404;
  }

  .task-meta {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    margin-bottom: 15px;
  }

  .task-meta-item {
    display: flex;
    flex-direction: column;
  }

  .task-meta-label {
    font-size: 0.8rem;
    font-weight: 600;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 4px;
  }

  .task-meta-value {
    color: #28a745;
    font-weight: 500;
  }

  .task-description {
    color: #495057;
    line-height: 1.5;
    margin-top: 10px;
  }

  .task-actions {
    margin-top: 15px;
    display: flex;
    gap: 10px;
  }

  .task-btn {
    padding: 6px 16px;
    border: none;
    border-radius: 4px;
    font-size: 0.8rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .task-btn-edit {
    background: #007bff;
    color: white;
  }

  .task-btn-edit:hover {
    background: #0056b3;
  }

  .task-btn-delete {
    background: #dc3545;
    color: white;
  }

  .task-btn-delete:hover {
    background: #c82333;
  }

  .no-tasks {
    text-align: center;
    color: #6c757d;
    font-style: italic;
    padding: 40px;
  }

  /* Project Modal Styles */
  .project-modal {
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

  .project-modal-content {
    background-color: #fefefe;
    margin: 3% auto;
    padding: 0;
    border: none;
    width: 90%;
    max-width: 900px;
    border-radius: 12px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
    animation: modalSlideIn 0.3s;
  }

  .project-modal-header {
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
    padding: 20px;
    border-radius: 12px 12px 0 0;
    position: relative;
  }

  .project-close {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
    position: absolute;
    right: 20px;
    top: 20px;
    cursor: pointer;
    transition: color 0.3s ease;
  }

  .project-close:hover {
    color: #ccc;
  }

  .project-modal-title {
    margin: 0;
    font-size: 2rem;
    font-weight: 700;
  }

  .project-modal-body {
    padding: 30px;
  }

  /* Clickable Header Styles */
  .project-header-clickable {
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
    padding: 30px;
    text-align: center;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    margin: 20px auto;
    max-width: 600px;
  }

  .project-header-clickable:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    background: linear-gradient(135deg, #0056b3, #004085);
  }

  .project-header-title {
    margin: 0;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 10px;
  }

  .project-header-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
    margin: 0;
  }
</style>
<div class="content">

  <?php if ($resultProjectById): ?>

    <?php include 'taskManagementTable.php'; ?>

    <!-- Project Details Modal -->
    <div id="projectModal" class="project-modal">
      <div class="project-modal-content">
        <div class="project-modal-header">
          <span class="project-close" onclick="closeProjectModal()">&times;</span>
          <h1 class="project-modal-title">
            Projet #<?php echo ($resultProjectById["id"]); ?>
          </h1>
        </div>

        <div class="project-modal-body">
          <div class="tile-grid">
            <div class="tile-item">
              <span class="tile-label">Nom du projet</span>
              <div class="tile-value"><?php echo ($resultProjectById["nom"]); ?></div>
            </div>

            <div class="tile-item">
              <span class="tile-label">Date début</span>
              <div class="tile-value"><?php echo ($resultProjectById["date_debut"]); ?></div>
            </div>

            <div class="tile-item">
              <span class="tile-label">Date fin</span>
              <div class="tile-value"><?php echo ($resultProjectById["date_fin"]); ?></div>
            </div>

            <div class="tile-item">
              <span class="tile-label">Date création</span>
              <div class="tile-value"><?php echo ($resultProjectById["date_creation"]); ?></div>
            </div>

            <div class="tile-item">
              <span class="tile-label">Créé par (User ID)</span>
              <div class="tile-value"><?php echo ($resultProjectById["cree_par_user_id"]); ?></div>
            </div>
          </div>

         
            <button type="button" class="tile-btn tile-btn-secondary" onclick="closeProjectModal()">
              Fermer
            </button>
          </div>
        </div>
      </div>
    </div>

  <?php else: ?>

    <!-- Error State Board -->
    <div class="taskPanel-board">
      <div class="board-header">
        <h1 class="board-title">
          <div class="board-icon" style="background: #ff6b6b;">!</div>
          Projet introuvable
        </h1>
        <div class="board-actions">
          <button class="monday-btn monday-btn-secondary" onclick="goBack()">
            Retour
          </button>
        </div>
      </div>

      <div class="empty-state">
        <div class="empty-state-icon">📋</div>
        <h3 class="empty-state-title">Projet non trouvé</h3>
        <p class="empty-state-text">
          Le projet demandé n'existe pas ou n'a pas pu être chargé.
        </p>
        <button class="monday-btn monday-btn-primary" onclick="goBack()">
          Retourner à la liste
        </button>
      </div>
    </div>

  <?php endif; ?>

  <!-- Project Details Modal (for detailed view) -->
  <div id="projectModal" class="project-modal">
    <div class="project-modal-content">
      <div class="project-modal-header">
        <span class="project-close" onclick="closeProjectModal()">&times;</span>
        <h1 class="project-modal-title">
          Détails du Projet #<?php echo isset($resultProjectById['id']) ? $resultProjectById['id'] : ''; ?>
        </h1>
      </div>

      <div class="project-modal-body">
        <?php if ($resultProjectById): ?>
          <div class="tile-grid">
            <div class="tile-item">
              <span class="tile-label">Nom du projet</span>
              <div class="tile-value"><?php echo ($resultProjectById["nom"]); ?></div>
            </div>

            <div class="tile-item">
              <span class="tile-label">Date début</span>
              <div class="tile-value"><?php echo ($resultProjectById["date_debut"]); ?></div>
            </div>

            <div class="tile-item">
              <span class="tile-label">Date fin</span>
              <div class="tile-value"><?php echo ($resultProjectById["date_fin"]); ?></div>
            </div>

            <div class="tile-item">
              <span class="tile-label">Date création</span>
              <div class="tile-value"><?php echo ($resultProjectById["date_creation"]); ?></div>
            </div>

            <div class="tile-item">
              <span class="tile-label">Créé par (User ID)</span>
              <div class="tile-value"><?php echo ($resultProjectById["cree_par_user_id"]); ?></div>
            </div>
          </div>

          <div class="tile-description">
            <span class="tile-label">Description du projet</span>
            <div style="margin-top: 10px; font-weight: normal;">
              <?php echo ($resultProjectById["description"]); ?>
            </div>
          </div>

          <div class="tile-actions">
            <button type="button" class="tile-btn tile-btn-success"
              onclick="modifyProject(<?php echo ($resultProjectById['id']); ?>)">
              Modifier le projet
            </button>
            <button type="button" class="tile-btn tile-btn-danger"
              onclick="deleteProject(<?php echo ($resultProjectById['id']); ?>)">
              Supprimer le projet
            </button>
            <button type="button" class="tile-btn tile-btn-secondary" onclick="closeProjectModal()">
              Fermer
            </button>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <?php include 'taskCreationModal.php'; ?>

</div>

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

    // Set modal to edit mode
    document.getElementById('taskModalTitle').textContent = 'Modifier la tâche';
    document.getElementById('taskSubmitText').textContent = 'Mettre à jour la tâche';
    document.getElementById('edit_mode').value = '1';
    document.getElementById('task_id').value = taskId;

    // Reset all form fields before populating
    resetTaskModal();
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
  }
</script>