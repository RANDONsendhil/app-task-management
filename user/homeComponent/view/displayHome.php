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
</style>
<div class="content">

  <fieldset>
    <legend>
      <h5>Tableau de bord</h5>
    </legend>

    <!-- Dashboard Header with Create Project Button -->
    <div class="dashboard-header">
      <div class="dashboard-title">
        <h3>Mes Projets</h3>
      </div>
      <div class="dashboard-actions">
        <button class="btn btn-success" onclick="openProjectCreationModal()">
          <i class="fas fa-plus"></i> Créer un nouveau projet
        </button>
      </div>
    </div>

    <div class="content-container">
      <div id="containerCreationCompte">
        <div class="container-card">
          <div class="card">

            <?php foreach ($listProjects as $row): ?>

            <div class="card-body">

              <form action='/home/selectProject/project' method='POST'>
                <div class="project-header">
                  <h4>
                    <span class="project-id">
                      <?php echo ($row["id"]); ?>
                    </span>
                    <span class="project-name">
                      <?php echo ($row["nom"]); ?>
                    </span>
                  </h4>

                  <div style="color: #af0a0a; font-variant-caps: small-caps;" class="card-title specialization-title">
                    <?php echo ($row["specialization"]); ?>
                  </div>
                </div>

                <div class="project-info">
                  <div class="description-highlight">
                    <p class="card-text description-text">
                      <span class="date-label">Description:</span>
                      <?php echo ($row["description"]); ?>
                    </p>
                  </div>
                  <p class="card-text">
                    <span class="date-label">Date début:</span>
                    <span class="date-value"><?php echo ($row["date_debut"]); ?></span>
                  </p>
                  <p class="card-text">
                    <span class="date-label">Date fin:</span>
                    <span class="date-value"><?php echo ($row["date_fin"]); ?></span>
                  </p>
                  <p class="card-text">
                    <span class="date-label">Date création:</span>
                    <span class="date-value"><?php echo ($row["date_creation"]); ?></span>
                  </p>
                </div>

                <input type='hidden' name='select-project' value=<?php echo $row["id"]; ?>>
                <button style="width: 221px!important; margin:0px;" type='submit' class='btn btn-info btn-sm'>Afficher
                </button>
              </form>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </fieldset>

  <!-- Project Creation Modal -->
  <div id="projectCreationModal" class="project-creation-modal">
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
            <button type="submit" class="project-btn project-btn-success" id="projectCreationSubmitBtn" name="submit-project">
              Créer le projet
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>

<script>
  // Project Creation Modal Functions
  function openProjectCreationModal() {
    // Set default dates
    const today = new Date().toISOString().split('T')[0];
    const nextMonth = new Date();
    nextMonth.setMonth(nextMonth.getMonth() + 1);
    const nextMonthDate = nextMonth.toISOString().split('T')[0];
    
    document.getElementById('project_date_debut').value = today;
    document.getElementById('project_date_fin').value = nextMonthDate;

    document.getElementById('projectCreationModal').style.display = 'block';
    document.body.style.overflow = 'hidden'; // Prevent scrolling
  }

  function closeProjectCreationModal() {
    document.getElementById('projectCreationModal').style.display = 'none';
    document.body.style.overflow = 'auto'; // Restore scrolling
    // Reset form
    document.getElementById('projectCreationForm').reset();
  }

  function submitProjectCreationForm(event) {
    // Prevent default form submission
    event.preventDefault();

    // Get form data
    const form = document.getElementById('projectCreationForm');
    const formData = new FormData(form);

    // Validate required fields
    const nom = formData.get('nom');
    const dateDebut = formData.get('date_debut');
    const dateFin = formData.get('date_fin');

    if (!nom || nom.trim() === '') {
      alert('Veuillez saisir un nom pour le projet');
      return false;
    }

    if (!dateDebut) {
      alert('Veuillez sélectionner une date de début');
      return false;
    }

    if (!dateFin) {
      alert('Veuillez sélectionner une date de fin');
      return false;
    }

    // Validate date order
    if (new Date(dateDebut) >= new Date(dateFin)) {
      alert('La date de fin doit être postérieure à la date de début');
      return false;
    }

    // Show loading state
    const submitButton = form.querySelector('button[name="submit-project"]');
    const originalText = submitButton.textContent;
    submitButton.textContent = 'Création en cours...';
    submitButton.disabled = true;

    // Submit form with AJAX
    fetch(window.location.href, {
        method: 'POST',
        body: formData
      })
      .then(response => {
        console.log('Response status:', response.status);
        if (!response.ok) {
          throw new Error('Erreur réseau: ' + response.status);
        }
        return response.text();
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
            message: 'Projet créé avec succès'
          };
        }

        if (result.success !== false) {
          alert('Projet créé avec succès!');
          closeProjectCreationModal();

          // Reload page to show the new project
          setTimeout(() => {
            window.location.reload();
          }, 1000);

        } else {
          alert('Erreur lors de la création: ' + (result.message || 'Erreur inconnue'));
        }
      })
      .catch(error => {
        console.error('Erreur:', error);
        alert('Erreur lors de la création du projet. Le projet pourrait avoir été créé malgré l\'erreur.');

        // Close modal and reload
        closeProjectCreationModal();
        setTimeout(() => {
          window.location.reload();
        }, 1000);
      })
      .finally(() => {
        // Restore button state
        submitButton.textContent = originalText;
        submitButton.disabled = false;
      });

    return false;
  }

  // Close modal with Escape key
  document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
      const projectCreationModal = document.getElementById('projectCreationModal');
      if (projectCreationModal && projectCreationModal.style.display === 'block') {
        closeProjectCreationModal();
      }
    }
  });

  // Set up form submission event listener
  document.addEventListener('DOMContentLoaded', function() {
    const projectCreationForm = document.getElementById('projectCreationForm');
    if (projectCreationForm) {
      projectCreationForm.addEventListener('submit', submitProjectCreationForm);
    }
  });
</script>