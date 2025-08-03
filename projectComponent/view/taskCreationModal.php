<?php
// Task Creation Modal Component
// This component contains the modal for creating and editing tasks
?>

<style>
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
  <div class="task-modal-content">
    <div class="task-modal-header">
      <span class="task-close" onclick="closeTaskModal()">&times;</span>
      <h2 class="task-modal-title" id="taskModalTitle">Créer une nouvelle tâche</h2>
    </div>

    <div class="task-modal-body">
      <form id="taskForm" method="POST">
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
          <input type='hidden' name='idproject' value='<?= $row['id'] ?>' ?>
          <button type="submit" class="tile-btn tile-btn-success" id="taskSubmitBtn" name="submit-task">
            <span id="taskSubmitText">Créer la tâche</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
