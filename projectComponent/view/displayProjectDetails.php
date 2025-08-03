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
function getUserNameById($userId, $allUsers) {
  if (empty($userId) || empty($allUsers)) {
    return null;
  }
  
  foreach ($allUsers as $user) {
    if ($user['id'] == $userId || $user['numSS'] == $userId) {
      return $user['nom'] ?? ($user['fname'] . ' ' . $user['lname']);
    }
  }
  return null;
}

// Helper function to get user initials by ID  
function getUserInitialsById($userId, $allUsers) {
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

  /* Custom searchable dropdown */
  .searchable-dropdown {
    position: relative;
    width: 100%;
  }

  .dropdown-search {
    width: 100%;
    padding: 8px 12px;
    border: 1px solid #e9ecef;
    border-radius: 4px 4px 0 0;
    font-size: 0.9rem;
    border-bottom: none;
    background-color: #f8f9fa;
  }

  .dropdown-search:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.1);
  }

  .scrollable-select select {
    border-radius: 0 0 6px 6px;
    border-top: none;
  }

  .user-option {
    padding: 8px 12px;
    border-bottom: 1px solid #f0f0f0;
  }

  .user-option:hover {
    background-color: #f8f9fa;
  }

  .user-name {
    font-weight: 500;
    color: #333;
  }

  .user-email {
    font-size: 0.85em;
    color: #666;
    margin-left: 8px;
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

  /* Monday.com-inspired Board Layout */
  .monday-board {
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
</style>
<div class="content">

  <?php if ($resultProjectById): ?>

    <!-- Session Info Debug (remove in production) -->
    <div style="background: #e8f5e8; padding: 10px; margin: 10px 0; border-radius: 4px; font-size: 12px;">
      <strong>Session Status:</strong>
      Project ID: <?php echo isset($_SESSION['current_project_id']) ? $_SESSION['current_project_id'] : 'Not set'; ?> |
      Project Name:
      <?php echo isset($_SESSION['current_project']['nom']) ? $_SESSION['current_project']['nom'] : 'Not set'; ?> |
      Session ID: <?php echo session_id(); ?>
    </div>

    <!-- Monday.com-inspired Project Board -->
    <div class="monday-board">
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
    </div>

  <?php else: ?>

    <!-- Session Debug for Error Case -->
    <div style="background: #ffebee; padding: 15px; margin: 10px 0; border-radius: 4px; color: #c62828;">
      <h4>Debug Information:</h4>
      <p><strong>$resultProjectById:</strong> <?php var_dump($resultProjectById); ?></p>
      <p><strong>Session current_project:</strong>
        <?php var_dump(isset($_SESSION['current_project']) ? $_SESSION['current_project'] : 'Not set'); ?></p>
      <p><strong>Session current_project_id:</strong>
        <?php var_dump(isset($_SESSION['current_project_id']) ? $_SESSION['current_project_id'] : 'Not set'); ?></p>
      <p><strong>Session ID:</strong> <?php echo session_id(); ?></p>
      <p><strong>All Session Data:</strong> <?php var_dump($_SESSION); ?></p>
    </div>

    <!-- Error State Board -->
    <div class="monday-board">
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

          <!-- Session Debug Info -->
          <div
            style="background: #f0f8ff; padding: 10px; border-radius: 4px; margin-bottom: 15px; font-size: 11px; color: #666;">
            Session Project ID:
            <strong><?php echo isset($_SESSION['current_project_id']) ? $_SESSION['current_project_id'] : 'Non défini'; ?></strong>
            |
            Form Project ID:
            <strong><?php echo isset($resultProjectById['id']) ? $resultProjectById['id'] : 'Non défini'; ?></strong>
          </div>

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
              <div class="searchable-dropdown">
                <input type="text" id="user-search" class="dropdown-search" placeholder="Rechercher un utilisateur...">
                <div class="scrollable-select">
                  <select id="assignee_id" name="assignee_id" class="task-form-select" size="1">
                    <option value="">-- Sélectionner un utilisateur --</option>
                    <?php if (isset($allUsers) && !empty($allUsers)): ?>
                      <?php foreach ($allUsers as $user): ?>
                        <option value="<?php echo htmlspecialchars($user['id']); ?>" 
                                data-name="<?php echo htmlspecialchars(strtolower($user['nom'] )); ?>" 
                        >Id: <?php echo htmlspecialchars($user['id']); ?> - Nom: <?php echo htmlspecialchars($user['nom']); ?></option>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <option value="" disabled>Aucun utilisateur disponible</option>
                    <?php endif; ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="task-form-group">
              <label class="task-form-label" for="date_echeance">Date d'échéance</label>
              <input type="date" id="date_echeance" name="date_echeance" class="task-form-input">
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

      </div>
      </form>
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
    
    // Clear search field
    const userSearch = document.getElementById('user-search');
    if (userSearch) {
      userSearch.value = '';
    }
    
    // Reset assignee dropdown to show all users
    const assigneeSelect = document.getElementById('assignee_id');
    if (assigneeSelect && window.originalAssigneeOptions) {
      assigneeSelect.innerHTML = '';
      window.originalAssigneeOptions.forEach(option => {
        assigneeSelect.appendChild(option.cloneNode(true));
      });
    }
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

    console.log('Session Project ID:', sessionProjectId);
    console.log('Form Project ID:', formProjectId);
    console.log('Using Project ID:', projectId);

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

          // Reload the page to show updated data
          window.location.reload();

        } else {
          alert('Erreur lors de ' + (isEditing ? 'la mise à jour' : 'la création') + ': ' + (result.message || 'Erreur inconnue'));
        }
      })
      .catch(error => {
        console.error('Erreur:', error);
        alert('Erreur lors de ' + (isEditing ? 'la mise à jour' : 'la création') + ' de la tâche. La tâche pourrait avoir été ' + (isEditing ? 'mise à jour' : 'créée') + ' malgré l\'erreur.');

        // Close modal and reload anyway since the task might have been processed
        closeTaskModal();
        window.location.reload();
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
    const userSearch = document.getElementById('user-search');
    
    if (assigneeSelect && userSearch) {
      // Store original options for filtering
      window.originalAssigneeOptions = Array.from(assigneeSelect.options);
      
      // Search functionality
      userSearch.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        // Clear current options (except the first one)
        assigneeSelect.innerHTML = '';
        assigneeSelect.appendChild(window.originalAssigneeOptions[0].cloneNode(true));
        
        // Filter and add matching options
        window.originalAssigneeOptions.slice(1).forEach(option => {
          const name = option.getAttribute('data-name') || '';
          const email = option.getAttribute('data-email') || '';
          const optionText = option.textContent.toLowerCase();
          
          if (name.includes(searchTerm) || 
              email.includes(searchTerm) || 
              optionText.includes(searchTerm)) {
            assigneeSelect.appendChild(option.cloneNode(true));
          }
        });
        
        // Reset selection if search is cleared
        if (searchTerm === '') {
          assigneeSelect.selectedIndex = 0;
        }
      });
      
      // Clear search when option is selected
      assigneeSelect.addEventListener('change', function() {
        if (this.value) {
          const selectedOption = this.options[this.selectedIndex];
          userSearch.value = selectedOption.textContent.trim();
        }
      });
      
      // Handle keyboard navigation
      userSearch.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowDown') {
          e.preventDefault();
          assigneeSelect.focus();
          if (assigneeSelect.options.length > 1) {
            assigneeSelect.selectedIndex = 1;
          }
        } else if (e.key === 'Enter') {
          e.preventDefault();
          if (assigneeSelect.options.length > 1) {
            assigneeSelect.selectedIndex = 1;
            assigneeSelect.dispatchEvent(new Event('change'));
          }
        }
      });
    }
  });

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
    if (assigneeSelect && taskData.assignee_id) {
      assigneeSelect.value = taskData.assignee_id;
      
      // Update search field with selected user name
      const selectedOption = assigneeSelect.options[assigneeSelect.selectedIndex];
      const userSearch = document.getElementById('user-search');
      if (selectedOption && userSearch) {
        userSearch.value = selectedOption.textContent.trim();
      }
    }
    
    // Handle date
    if (taskData.date_echeance && taskData.date_echeance !== '-') {
      document.getElementById('date_echeance').value = taskData.date_echeance;
    }
  }

  function deleteTask(taskId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette tâche? Cette action est irréversible.')) {
      // Send delete request
      window.location.href = '/task/delete/' + taskId;
    }
  }
</script>