<?php
define('BASE_PATH', __DIR__);

// Function to determine project status based on dates
if (!function_exists('getProjectStatus')) {
  function getProjectStatus($dateDebut, $dateFin)
  {
    $today = date('Y-m-d');
    $startDate = date('Y-m-d', strtotime($dateDebut));
    $endDate = date('Y-m-d', strtotime($dateFin));

    if ($today < $startDate) {
      return 'pending'; // Project hasn't started yet
    } elseif ($today >= $startDate && $today <= $endDate) {
      return 'active'; // Project is currently active
    } else {
      return 'completed'; // Project is finished
    }
  }
}
?>
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
  background: #e9ecef;
  transform: translateY(-1px);
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

/* Dashboard Header Styles */
.dashboard-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
  padding: 15px 20px;
  background: #f8f9fa;
  border-radius: 8px;
  border: 1px solid #e9ecef;
}

.dashboard-title h3 {
  margin: 0;
  color: #343a40;
  font-weight: 600;
}

/* Enhanced Title with Logo Styles */
.title-container {
  display: flex;
  align-items: center;
  gap: 15px;
  padding: 5px 0;
}

.title-logo {
  background: linear-gradient(135deg, #007bff, #0056b3);
  color: white;
  width: 45px;
  height: 45px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
  position: relative;
  overflow: hidden;
  transition: all 0.3s ease;
}

.title-logo::before {
  content: '';
  position: absolute;
  top: -50%;
  left: -50%;
  width: 200%;
  height: 200%;
  background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  transform: rotate(45deg);
  transition: all 0.6s ease;
  opacity: 0;
}

.title-logo:hover {
  transform: translateY(-2px) scale(1.05);
  box-shadow: 0 6px 20px rgba(0, 123, 255, 0.4);
}

.title-logo:hover::before {
  opacity: 1;
  left: 100%;
  top: 100%;
}

.title-container h3 {
  margin: 0;
  color: #2c3e50;
  font-weight: 700;
  font-size: 1.8rem;
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  background: linear-gradient(135deg, #2c3e50, #3498db);
  background-clip: text;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-size: 200% 200%;
  animation: gradientShift 4s ease-in-out infinite;
  position: relative;
}

.title-container h3::after {
  content: '';
  position: absolute;
  bottom: -5px;
  left: 0;
  width: 0;
  height: 3px;
  background: linear-gradient(90deg, #007bff, #28a745);
  border-radius: 2px;
  transition: width 0.8s ease;
}

.title-container:hover h3::after {
  width: 100%;
}

@keyframes gradientShift {
  0% {
    background-position: 0% 50%;
  }

  50% {
    background-position: 100% 50%;
  }

  100% {
    background-position: 0% 50%;
  }
}

/* Responsive design for title */
@media (max-width: 768px) {
  .title-container {
    gap: 10px;
  }

  .title-logo {
    width: 35px;
    height: 35px;
    font-size: 16px;
  }

  .title-container h3 {
    font-size: 1.4rem;
  }
}

.dashboard-actions {
  display: flex;
  gap: 10px;
}

/* Project Creation Modal */
.project-creation-modal {
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

.project-creation-modal-content {
  background-color: #fefefe;
  margin: 3% auto;
  padding: 0;
  border: none;
  width: 90%;
  max-width: 700px;
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

.project-creation-modal-header {
  background: linear-gradient(135deg, #007bff, #0056b3);
  color: white;
  padding: 20px;
  border-radius: 8px 8px 0 0;
  position: relative;
}

.project-creation-modal-title {
  margin: 0;
  font-size: 1.5rem;
  font-weight: 600;
}

.project-creation-close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
  position: absolute;
  right: 15px;
  top: 15px;
  cursor: pointer;
}

.project-creation-close:hover {
  color: #ccc;
}

.project-creation-modal-body {
  padding: 30px;
}

.project-form-group {
  margin-bottom: 20px;
}

.project-form-label {
  display: block;
  font-weight: 600;
  color: #495057;
  margin-bottom: 8px;
  font-size: 0.9rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.project-form-input,
.project-form-textarea,
.project-form-select {
  width: 100%;
  padding: 12px;
  border: 2px solid #e9ecef;
  border-radius: 6px;
  font-size: 1rem;
  transition: border-color 0.3s ease;
  box-sizing: border-box;
}

.project-form-input:focus,
.project-form-textarea:focus,
.project-form-select:focus {
  outline: none;
  border-color: #007bff;
  box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
}

.project-form-textarea {
  height: 120px;
  resize: vertical;
}

.project-creation-modal-footer {
  padding: 20px 30px;
  border-top: 1px solid #e9ecef;
  text-align: right;
  border-radius: 0 0 8px 8px;
  background-color: #f8f9fa;
}

.project-form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 15px;
}

.project-btn {
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

.project-btn-success {
  background: #28a745;
  color: white;
}

.project-btn-success:hover {
  background: #218838;
  transform: translateY(-2px);
}

.project-btn-secondary {
  background: #6c757d;
  color: white;
  margin-right: 10px;
}

.project-btn-secondary:hover {
  background: #5a6268;
  transform: translateY(-2px);
}

/* Projects Table Styles */
.projects-table-container {
  background: white;
  border-radius: 12px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  overflow: hidden;
  border: 1px solid #e9ecef;
  transition: box-shadow 0.3s ease;
}

.projects-table-container:hover {
  box-shadow: 0 6px 28px rgba(0, 0, 0, 0.12);
}

.table-filters {
  padding: 25px;
  background: linear-gradient(135deg, #f8f9fa, #e9ecef);
  border-bottom: 2px solid #dee2e6;
  border-radius: 8px 8px 0 0;
  display: grid;
  grid-template-columns: 2fr 1fr 1fr auto;
  gap: 20px;
  align-items: end;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.filter-group {
  display: flex;
  flex-direction: column;
  position: relative;
}

.filter-label {
  font-weight: 600;
  color: #495057;
  margin-bottom: 8px;
  font-size: 0.85rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.filter-input,
.filter-select {
  padding: 12px 16px;
  border: 2px solid #e1e5e9;
  border-radius: 6px;
  font-size: 0.95rem;
  transition: all 0.3s ease;
  background: white;
  min-height: 45px;
  box-sizing: border-box;
}

.filter-input:focus,
.filter-select:focus {
  outline: none;
  border-color: #007bff;
  box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
  transform: translateY(-1px);
}

.filter-input:hover,
.filter-select:hover {
  border-color: #c3cad0;
}

.clear-filters-btn {
  padding: 12px 20px;
  background: linear-gradient(135deg, #6c757d, #5a6268);
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 0.9rem;
  font-weight: 500;
  transition: all 0.3s ease;
  min-height: 45px;
  white-space: nowrap;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.clear-filters-btn:hover {
  background: linear-gradient(135deg, #5a6268, #495057);
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.clear-filters-btn:active {
  transform: translateY(0);
}

.projects-table {
  width: 100%;
  border-collapse: collapse;
  margin: 0;
}

.projects-table th {
  background: linear-gradient(135deg, #f8f9fa, #e9ecef);
  color: #495057;
  font-weight: 600;
  padding: 15px 12px;
  text-align: left;
  border-bottom: 2px solid #e9ecef;
  font-size: 0.9rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  cursor: pointer;
  position: relative;
  transition: all 0.3s ease;
  user-select: none;
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.5);
}

.projects-table th:hover {
  background: linear-gradient(135deg, #e9ecef, #dee2e6);
  transform: translateY(-1px);
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.5);
}

.projects-table th.sortable {
  border-right: 1px solid rgba(255, 255, 255, 0.3);
}

.projects-table th.sortable::after {
  content: '';
  display: inline-block;
  width: 0;
  height: 0;
  margin-left: 8px;
  vertical-align: middle;
  border-left: 4px solid transparent;
  border-right: 4px solid transparent;
  border-top: 4px solid #6c757d;
  opacity: 0.4;
  transition: all 0.3s ease;
}

.projects-table th.sortable:hover::after {
  opacity: 0.8;
  transform: scale(1.2);
}

.projects-table th.sort-asc {
  background: linear-gradient(135deg, #e3f2fd, #bbdefb);
  color: #1976d2;
  box-shadow: 0 2px 8px rgba(25, 118, 210, 0.2), inset 0 1px 0 rgba(255, 255, 255, 0.6);
}

.projects-table th.sort-asc::after {
  border-top: 6px solid #1976d2;
  border-bottom: 0;
  border-left: 4px solid transparent;
  border-right: 4px solid transparent;
  opacity: 1;
  transform: translateY(-1px);
}

.projects-table th.sort-desc {
  background: linear-gradient(135deg, #e3f2fd, #bbdefb);
  color: #1976d2;
  box-shadow: 0 2px 8px rgba(25, 118, 210, 0.2), inset 0 1px 0 rgba(255, 255, 255, 0.6);
}

.projects-table th.sort-desc::after {
  border-bottom: 6px solid #1976d2;
  border-top: 0;
  border-left: 4px solid transparent;
  border-right: 4px solid transparent;
  opacity: 1;
  transform: translateY(1px);
}

.projects-table th.sort-asc:hover,
.projects-table th.sort-desc:hover {
  background: linear-gradient(135deg, #bbdefb, #90caf9);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(25, 118, 210, 0.3), inset 0 1px 0 rgba(255, 255, 255, 0.7);
}

/* Enhanced table styling */
.projects-table thead {
  position: relative;
}

.projects-table thead::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 2px;
  background: linear-gradient(90deg, #007bff, #0056b3, #007bff);
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

.projects-table tbody tr {
  transition: all 0.3s ease;
  border-bottom: 1px solid #f1f3f4;
}

.projects-table tbody tr:hover {
  background: linear-gradient(135deg, #f8f9fa, #ffffff);
  transform: translateY(-1px);
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

.projects-table td {
  padding: 15px 12px;
  border-bottom: 1px solid #e9ecef;
  vertical-align: middle;
}

.projects-table tbody tr {
  transition: background-color 0.3s ease;
}

.projects-table tbody tr:hover {
  background-color: #f8f9fa;
}

.project-id-cell {
  font-weight: bold;
  color: #007bff;
  font-size: 0.9rem;
}

.project-name-cell {
  font-weight: 600;
  color: #343a40;
  max-width: 200px;
}

.project-description-cell {
  max-width: 300px;
  color: #6c757d;
  font-size: 0.9rem;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.project-date-cell {
  color: #28a745;
  font-weight: 500;
  font-size: 0.9rem;
  white-space: nowrap;
}

.project-status-badge {
  padding: 4px 8px;
  border-radius: 12px;
  font-size: 0.8rem;
  font-weight: 500;
  text-transform: uppercase;
}

.status-active {
  background: #d4edda;
  color: #155724;
}

.status-completed {
  background: #cce5ff;
  color: #004085;
}

.status-pending {
  background: #fff3cd;
  color: #856404;
}

.project-actions-cell {
  white-space: nowrap;
}

.table-action-btn {
  padding: 6px 12px;
  border: none;
  border-radius: 4px;
  font-size: 0.8rem;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.3s ease;
  text-decoration: none;
  display: inline-block;
}

.btn-view {
  background: #007bff;
  color: white;
}

.btn-view:hover {
  background: #0056b3;
  color: white;
}

.filter-stats {
  padding: 10px 20px;
  background: #e9ecef;
  color: #6c757d;
  font-size: 0.9rem;
  text-align: center;
  border-top: 1px solid #dee2e6;
}

.hidden {
  display: none !important;
}

.no-projects-row {
  text-align: center;
  padding: 40px;
  color: #6c757d;
  font-style: italic;
}

@media (max-width: 768px) {
  .table-filters {
    grid-template-columns: 1fr;
    gap: 15px;
    padding: 20px;
  }

  .projects-table {
    font-size: 0.8rem;
  }

  .projects-table th,
  .projects-table td {
    padding: 10px 8px;
  }

  .project-description-cell {
    max-width: 150px;
  }
}

@media (max-width: 1024px) {
  .table-filters {
    grid-template-columns: 1fr 1fr;
    gap: 15px;
  }
}
</style>

<script src="/user/homeComponent/view/js/dashboard.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  if (window.initializeProjectFilters) {
    window.initializeProjectFilters();
  }
});
<?php if (isset($_SESSION['project_creation_status']) && $_SESSION['project_creation_status'] === 'success'): ?>
showNotification('<?php echo addslashes($_SESSION['project_creation_message']); ?>', 'success');
<?php unset($_SESSION['project_creation_status'], $_SESSION['project_creation_message']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['project_deletion_status']) && $_SESSION['project_deletion_status'] === 'success'): ?>
showNotification('<?php echo addslashes($_SESSION['project_deletion_message']); ?>', 'success');
<?php unset($_SESSION['project_deletion_status'], $_SESSION['project_deletion_message']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['project_edit_status']) && $_SESSION['project_edit_status'] === 'success'): ?>
showNotification('<?php echo addslashes($_SESSION['project_edit_message']); ?>', 'success');
<?php unset($_SESSION['project_edit_status'], $_SESSION['project_edit_message']); ?>
<?php endif; ?>


// Export project function - PDF only
function exportProject(projectId) {
  // Generate PDF directly from the application

  showNotification('Génération du PDF en cours...', 'info, Project ID');
}

// Show export notification
function showNotification(message, type = 'success') {
  // Create notification element
  const notification = document.createElement('div');
  const bgColor = type === 'success' ? '#28a745' : type === 'info' ? '#007bff' : '#dc3545';

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
<div id="projectCreationModal" class="project-creation-modal" style="display:none;">
  <div class="project-creation-modal-content">
    <div class="project-creation-modal-header">
      <span class="project-creation-close" onclick="closeProjectCreationModal()">&times;</span>
      <h2 class="project-creation-modal-title">Créer un nouveau projet</h2>
    </div>

    <div class="project-creation-modal-body">
      <form id="projectCreationForm" method="POST">
        <input type="hidden" name="session_id" value="<?php echo session_id(); ?>">

        <div class="project-form-group">
          <label class="project-form-label" for="project_nom">Nom du projet *</label>
          <input type="text" id="project_nom" name="nom" class="project-form-input" required
            placeholder="Entrez le nom du projet">
        </div>

        <div class="project-form-group">
          <label class="project-form-label" for="project_description">Description</label>
          <textarea id="project_description" name="description" class="project-form-textarea"
            placeholder="Décrivez le projet en détail"></textarea>
        </div>

        <div class="project-form-row">
          <div class="project-form-group">
            <label class="project-form-label" for="project_date_debut">Date début *</label>
            <input type="date" required id="project_date_debut" name="date_debut" class="project-form-input">
          </div>

          <div class="project-form-group">
            <label class="project-form-label" for="project_date_fin">Date fin *</label>
            <input type="date" required id="project_date_fin" name="date_fin" class="project-form-input">
          </div>
        </div>



        <div class="project-creation-modal-footer">
          <button type="button" class="project-btn project-btn-secondary" onclick="closeProjectCreationModal()">
            Annuler
          </button>
          <button type="submit" class="project-btn project-btn-success" id="projectCreationSubmitBtn"
            name="submit-project">
            Créer le projet
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
</form>
<div class="content">
  <!-- Edit Project Modal -->
  <div id="editProjectModal" class="project-creation-modal" style="display:none;">
    <div class="project-creation-modal-content">
      <div class="project-creation-modal-header">
        <span class="project-creation-close" onclick="closeEditProjectModal()">&times;</span>
        <h2 class="project-creation-modal-title">Modifier le projet</h2>
      </div>
      <div class="project-creation-modal-body">
        <form id="editProjectForm" method="POST">
          <input type="hidden" name="project_id" id="edit_project_id">
          <div class="project-form-group">
            <label class="project-form-label" for="edit_project_nom">Nom du projet *</label>
            <input type="text" id="edit_project_nom" name="nom" class="project-form-input" required>
          </div>
          <div class="project-form-group">
            <label class="project-form-label" for="edit_project_description">Description</label>
            <textarea id="edit_project_description" name="description" class="project-form-textarea"></textarea>
          </div>
          <div class="project-form-row">
            <div class="project-form-group">
              <label class="project-form-label" for="edit_project_date_debut">Date début *</label>
              <input type="date" required id="edit_project_date_debut" name="date_debut" class="project-form-input">
            </div>
            <div class="project-form-group">
              <label class="project-form-label" for="edit_project_date_fin">Date fin *</label>
              <input type="date" required id="edit_project_date_fin" name="date_fin" class="project-form-input">
            </div>
          </div>
          <div class="project-creation-modal-footer">
            <button type="button" class="project-btn project-btn-secondary"
              onclick="closeEditProjectModal()">Annuler</button>
            <button type="submit" class="project-btn project-btn-success" id="editProjectSubmitBtn"
              name="submit-edit-project">Enregistrer</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <fieldset>
    <legend>
      <h3>Tableau de bord</h3>
    </legend>
    <div class="content-container">
      <div class="projects-table-container">
        <div class="dashboard-header">
          <div class="dashboard-title">
            <div class="title-container">
              <div class="title-logo">
                📋
              </div>
              <h3>Gestion des projets</h3>
            </div>
          </div>
          <div class="dashboard-actions">
            <button class="btn btn-success" onclick="openProjectCreationModal()">
              <i class="fas fa-plus"></i> Créer un nouveau projet
            </button>
          </div>
        </div>
        <!-- Table Filters -->
        <div class="table-filters">
          <div class="filter-group">
            <label class="filter-label" for="searchFilter">Rechercher</label>
            <input type="text" id="searchFilter" class="filter-input"
              placeholder="Rechercher par nom ou description...">
          </div>

          <div class="filter-group">
            <label class="filter-label" for="statusFilter">Statut</label>
            <select id="statusFilter" class="filter-select">
              <option value="">Tous les statuts</option>
              <option value="active">Actif</option>
              <option value="completed">Terminé</option>
              <option value="pending">En attente</option>
            </select>
          </div>

          <div class="filter-group">
            <label class="filter-label" for="dateFilter">Période</label>
            <select id="dateFilter" class="filter-select">
              <option value="">Toutes les périodes</option>
              <option value="current">En cours</option>
              <option value="upcoming">À venir</option>
              <option value="past">Terminées</option>
            </select>
          </div>

          <div class="filter-group">
            <label class="filter-label">&nbsp;</label>
            <button type="button" class="clear-filters-btn" onclick="clearAllProjectFilters()">
              Effacer les filtres
            </button>
          </div>
        </div>

        <!-- Projects Table -->
        <table class="projects-table">
          <thead>
            <tr>
              <th class="sortable" data-column="id" onclick="sortTable('id')">ID</th>
              <th class="sortable" data-column="nom" onclick="sortTable('nom')">Nom du projet</th>
              <th class="sortable" data-column="description" onclick="sortTable('description')">Description</th>
              <th class="sortable" data-column="date_debut" onclick="sortTable('date_debut')">Date début</th>
              <th class="sortable" data-column="date_fin" onclick="sortTable('date_fin')">Date fin</th>
              <th class="sortable" data-column="date_creation" onclick="sortTable('date_creation')">Date création</th>
              <th class="sortable" data-column="status" onclick="sortTable('status')">Statut</th>
              <th style="width: 60px;">EXPORT PDF</th>
              <th style="width: 60px;">Afficher</th>
              <th style="width: 120px;">Actions</th>
            </tr>
          </thead>
          <tbody id="projectsTableBody">
            <?php if (!empty($listProjects)): ?>
            <?php foreach ($listProjects as $row): ?>
            <tr class="project-row" data-project-id="<?php echo htmlspecialchars($row['id']); ?>"
              data-project-name="<?php echo htmlspecialchars(strtolower($row['nom'])); ?>"
              data-project-description="<?php echo htmlspecialchars(strtolower($row['description'])); ?>"
              data-project-start="<?php echo htmlspecialchars($row['date_debut']); ?>"
              data-project-end="<?php echo htmlspecialchars($row['date_fin']); ?>"
              data-project-status="<?php echo htmlspecialchars(getProjectStatus($row['date_debut'], $row['date_fin'])); ?>"
              data-date-creation="<?php echo htmlspecialchars($row['date_creation']); ?>">

              <td class="project-id-cell">
                #<?php echo htmlspecialchars($row['id']); ?>
              </td>

              <td class="project-name-cell">
                <?php echo htmlspecialchars($row['nom']); ?>
                <?php if (!empty($row['specialization'])): ?>
                <br><small style="color: #af0a0a; font-variant-caps: small-caps;">
                  <?php echo htmlspecialchars($row['specialization']); ?>
                </small>
                <?php endif; ?>
              </td>

              <td class="project-description-cell" title="<?php echo htmlspecialchars($row['description']); ?>">
                <?php echo htmlspecialchars($row['description']); ?>
              </td>

              <td class="project-date-cell">
                <?php echo htmlspecialchars($row['date_debut']); ?>
              </td>

              <td class="project-date-cell">
                <?php echo htmlspecialchars($row['date_fin']); ?>
              </td>

              <td class="project-date-cell">
                <?php echo htmlspecialchars($row['date_creation']); ?>
              </td>

              <td>
                <?php
                    $status = getProjectStatus($row['date_debut'], $row['date_fin']);
                    $statusClass = 'status-' . $status;
                    $statusText = '';
                    switch ($status) {
                      case 'active':
                        $statusText = 'Actif';
                        break;
                      case 'completed':
                        $statusText = 'Terminé';
                        break;
                      case 'pending':
                        $statusText = 'En attente';
                        break;
                      default:
                        $statusText = 'Inconnu';
                        break;
                    }
                    ?>
                <span class="project-status-badge <?php echo $statusClass; ?>">
                  <?php echo $statusText; ?>
                </span>
              </td>
              <form method="post">
                <td class="project-actions-cell">
                  <input type='hidden' name='export_project_pdf' value='<?php echo htmlspecialchars($row['id']); ?>'>
                  <button type="submit" name="export-pdf" class="action-btn export-btn" title="Exporter en PDF"
                    onclick="event.stopPropagation(); exportProject(<?php echo $row['id']; ?>)"
                    style="display:flex;justify-content:center;align-items:center;">
                    📄
                  </button>
              </form>
              </td>

              <td class="project-actions-cell">
                <form action='/project/tasks' method='POST'
                  style="display:flex;justify-content:center;align-items:center;">
                  <input type='hidden' name='select-project' value="<?php echo htmlspecialchars($row['id']); ?>">
                  <button type='submit' class='action-btn' title="Afficher" onclick="event.stopPropagation();"
                    style="display:flex;justify-content:center;align-items:center;">
                    <img src="/images/eye.svg" alt="Afficher" style="width:20px;height:20px;display:block;margin:auto;">
                  </button>
                </form>
              </td>
              <td class="project-actions-cell">
                <div style="display: flex; gap: 4px;">
                  <button class="action-btn" title="Modifier"
                    onclick="event.stopPropagation(); editProject(<?php echo $row['id']; ?>)">
                    ✏️
                  </button>
                  <form method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?');">
                    <input type='hidden' name='delete-project' value='<?php echo $row['id']; ?>'>
                    <button class="action-btn" type="submit" title="Supprimer" onclick="event.stopPropagation();">
                      🗑️
                    </button>
                  </form>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr>
              <td colspan="10" class="no-projects-row">
                Aucun projet trouvé.
                <a href="#" onclick="openProjectCreationModal()">Créer votre premier projet</a>
              </td>
            </tr>
            <?php endif; ?>
          </tbody>
        </table>

        <!-- Filter Stats -->
        <div class="filter-stats" id="filterStats">
          <?php 
            if ($listProjects instanceof mysqli_result) {
              $projectsArray = [];
              while ($row = $listProjects->fetch_assoc()) {
                $projectsArray[] = $row;
              }
              echo count($projectsArray);
            } else {
              echo count($listProjects);
            }
          ?> projet<?php 
            if ($listProjects instanceof mysqli_result) {
              echo (isset($projectsArray) && count($projectsArray) > 1) ? 's' : '';
            } else {
              echo count($listProjects) > 1 ? 's' : '';
            }
          ?>
        </div>
      </div>
    </div>
  </fieldset>
</div>