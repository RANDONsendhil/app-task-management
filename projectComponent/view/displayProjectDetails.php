<?php
define('BASE_PATH', __DIR__); ?>
<?php
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
  max-width: 800px;
  margin: 20px auto;
  background: white;
  border-radius: 12px;
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
  overflow: hidden;
}

.tile-header {
  background: linear-gradient(135deg, #007bff, #0056b3);
  color: white;
  padding: 30px;
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
  padding: 40px;
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

/* Task Creation Modal */
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
<div class="content">

  <?php if ($resultProjectById): ?>

  <!-- Project Details Tile -->
  <div class="project-tile">
    <div class="tile-header">
      <h1 class="tile-title">
        Projet #<?php echo ($resultProjectById["id"]); ?>
      </h1>
      <p class="tile-subtitle">
        <?php echo ($resultProjectById["nom"]); ?>
      </p>
    </div>

    <div class="tile-body">
      <div class="tile-grid">
        <div class="tile-item">
          <span class="tile-label">Nom du projet</span>
          <div class="tile-value"><?php echo ($resultProjectById["nom"]); ?></div>
        </div>

        <div class="tile-item">
          <span class="tile-label">Spécialisation</span>
          <div class="tile-value"><?php echo ($resultProjectById["specialization"]); ?></div>
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
        <button type="button" class="tile-btn tile-btn-primary" onclick="openTaskModal()">
          Ajouter une tâche
        </button>
        <button type="button" class="tile-btn tile-btn-success"
          onclick="modifyProject(<?php echo ($resultProjectById['id']); ?>)">
          Modifier le projet
        </button>
        <button type="button" class="tile-btn tile-btn-danger"
          onclick="deleteProject(<?php echo ($resultProjectById['id']); ?>)">
          Supprimer le projet
        </button>
        <button type="button" class="tile-btn tile-btn-secondary" onclick="goBack()">
          Retour
        </button>
      </div>
    </div>
  </div>

  <?php else: ?>
  <div class="project-tile">
    <div class="tile-header" style="background: linear-gradient(135deg, #dc3545, #c82333);">
      <h1 class="tile-title">Erreur</h1>
      <p class="tile-subtitle">Projet non trouvé</p>
    </div>
    <div class="tile-body">
      <div class="alert alert-warning">
        <h4>Projet non trouvé</h4>
        <p>Le projet demandé n'existe pas ou n'a pas pu être chargé.</p>
      </div>
      <div class="tile-actions">
        <button type="button" class="tile-btn tile-btn-secondary" onclick="goBack()">
          Retour
        </button>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <!-- Task Creation Modal -->
  <div id="taskModal" class="task-modal">
    <div class="task-modal-content">
      <div class="task-modal-header">
        <span class="task-close" onclick="closeTaskModal()">&times;</span>
        <h2 class="task-modal-title">Créer une nouvelle tâche</h2>
      </div>

      <div class="task-modal-body">
        <form id="taskForm" action="/task/create" method="POST">
          <input type="hidden" name="project_id"
            value="<?php echo isset($resultProjectById['id']) ? $resultProjectById['id'] : ''; ?>">

          <div class="task-form-group">
            <label class="task-form-label" for="task_name">Nom de la tâche *</label>
            <input type="text" id="task_name" name="task_name" class="task-form-input" required
              placeholder="Entrez le nom de la tâche">
          </div>

          <div class="task-form-group">
            <label class="task-form-label" for="task_description">Description</label>
            <textarea id="task_description" name="task_description" class="task-form-textarea"
              placeholder="Décrivez la tâche en détail"></textarea>
          </div>

          <div class="task-form-row">
            <div class="task-form-group">
              <label class="task-form-label" for="task_priority">Priorité</label>
              <select id="task_priority" name="task_priority" class="task-form-select">
                <option value="low">Basse</option>
                <option value="medium" selected>Moyenne</option>
                <option value="high">Haute</option>
                <option value="urgent">Urgente</option>
              </select>
            </div>

            <div class="task-form-group">
              <label class="task-form-label" for="task_status">Statut</label>
              <select id="task_status" name="task_status" class="task-form-select">
                <option value="todo" selected>À faire</option>
                <option value="in_progress">En cours</option>
                <option value="completed">Terminée</option>
                <option value="on_hold">En attente</option>
              </select>
            </div>
          </div>

          <div class="task-form-row">
            <div class="task-form-group">
              <label class="task-form-label" for="task_start_date">Date de début</label>
              <input type="date" id="task_start_date" name="task_start_date" class="task-form-input">
            </div>

            <div class="task-form-group">
              <label class="task-form-label" for="task_due_date">Date d'échéance</label>
              <input type="date" id="task_due_date" name="task_due_date" class="task-form-input">
            </div>
          </div>

          <div class="task-form-group">
            <label class="task-form-label" for="assigned_to">Assigné à (User ID)</label>
            <input type="number" id="assigned_to" name="assigned_to" class="task-form-input"
              placeholder="ID de l'utilisateur assigné à cette tâche">
          </div>
        </form>
      </div>

      <div class="task-modal-footer">
        <button type="button" class="tile-btn tile-btn-secondary" onclick="closeTaskModal()">
          Annuler
        </button>
        <button type="button" class="tile-btn tile-btn-success" onclick="submitTaskForm()">
          Créer la tâche
        </button>
      </div>
    </div>
  </div>

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

// Task Modal Functions
function openTaskModal() {
  document.getElementById('taskModal').style.display = 'block';
  document.body.style.overflow = 'hidden'; // Prevent scrolling
}

function closeTaskModal() {
  document.getElementById('taskModal').style.display = 'none';
  document.body.style.overflow = 'auto'; // Restore scrolling
  // Reset form
  document.getElementById('taskForm').reset();
}

function submitTaskForm() {
  const form = document.getElementById('taskForm');
  const taskName = document.getElementById('task_name').value.trim();

  // Basic validation
  if (!taskName) {
    alert('Le nom de la tâche est obligatoire.');
    document.getElementById('task_name').focus();
    return;
  }

  // Validate dates
  const startDate = document.getElementById('task_start_date').value;
  const dueDate = document.getElementById('task_due_date').value;

  if (startDate && dueDate && new Date(startDate) > new Date(dueDate)) {
    alert('La date de début ne peut pas être postérieure à la date d\'échéance.');
    return;
  }

  // Submit form
  form.submit();
}

// Close modal when clicking outside
window.onclick = function(event) {
  const modal = document.getElementById('taskModal');
  if (event.target == modal) {
    closeTaskModal();
  }
}

// Close modal with Escape key
document.addEventListener('keydown', function(event) {
  if (event.key === 'Escape') {
    const modal = document.getElementById('taskModal');
    if (modal.style.display === 'block') {
      closeTaskModal();
    }
  }
});

// Set default dates
document.addEventListener('DOMContentLoaded', function() {
  const today = new Date().toISOString().split('T')[0];
  document.getElementById('task_start_date').value = today;
});
</script>