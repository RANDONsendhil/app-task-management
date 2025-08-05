
  // Table sorting functionality
  let currentSort = { column: null, direction: 'asc' };

  window.sortTable = function(column) {
    const table = document.querySelector('.projects-table tbody');
    const rows = Array.from(table.querySelectorAll('.project-row'));
    
    // Determine sort direction
    if (currentSort.column === column) {
      currentSort.direction = currentSort.direction === 'asc' ? 'desc' : 'asc';
    } else {
      currentSort.direction = 'asc';
    }
    currentSort.column = column;

    // Update header classes
    document.querySelectorAll('.projects-table th').forEach(th => {
      th.classList.remove('sort-asc', 'sort-desc');
    });
    
    const currentHeader = document.querySelector(`th[data-column="${column}"]`);
    if (currentHeader) {
      currentHeader.classList.add(currentSort.direction === 'asc' ? 'sort-asc' : 'sort-desc');
    }

    // Sort rows
    rows.sort((a, b) => {
      let aValue, bValue;
      
      switch(column) {
        case 'id':
          aValue = parseInt(a.getAttribute('data-project-id'));
          bValue = parseInt(b.getAttribute('data-project-id'));
          break;
        case 'nom':
          aValue = a.getAttribute('data-project-name').toLowerCase();
          bValue = b.getAttribute('data-project-name').toLowerCase();
          break;
        case 'description':
          aValue = a.getAttribute('data-project-description').toLowerCase();
          bValue = b.getAttribute('data-project-description').toLowerCase();
          break;
        case 'date_debut':
          aValue = new Date(a.getAttribute('data-project-start'));
          bValue = new Date(b.getAttribute('data-project-start'));
          break;
        case 'date_fin':
          aValue = new Date(a.getAttribute('data-project-end'));
          bValue = new Date(b.getAttribute('data-project-end'));
          break;
        case 'date_creation':
          aValue = new Date(a.getAttribute('data-date-creation'));
          bValue = new Date(b.getAttribute('data-date-creation'));
          break;
        case 'status':
          aValue = a.getAttribute('data-project-status').toLowerCase();
          bValue = b.getAttribute('data-project-status').toLowerCase();
          break;
        default:
          return 0;
      }

      if (aValue < bValue) return currentSort.direction === 'asc' ? -1 : 1;
      if (aValue > bValue) return currentSort.direction === 'asc' ? 1 : -1;
      return 0;
    });

    // Re-append sorted rows
    rows.forEach(row => table.appendChild(row));
    
    // Reapply filters after sorting
    if (window.applyProjectFilters) {
      window.applyProjectFilters();
    }
  }

  window.clearAllProjectFilters = function() {
    const searchFilter = document.getElementById('searchFilter');
    const statusFilter = document.getElementById('statusFilter');
    const dateFilter = document.getElementById('dateFilter');

    if (searchFilter) searchFilter.value = '';
    if (statusFilter) statusFilter.value = '';
    if (dateFilter) dateFilter.value = '';

    // Trigger filter application
    applyProjectFilters();
  }
  // Open Project Creation Modal
  window.openProjectCreationModal = function() {
    console.log("here projectCreationModal");
    var modal = document.getElementById('projectCreationModal');
    if (modal) {
      modal.style.display = 'block';
    }
  }
  // Close Project Creation Modal
  window.closeProjectCreationModal = function() {
    var modal = document.getElementById('projectCreationModal');
    if (modal) {
      modal.style.display = 'none';
    }
  }
  window.applyProjectFilters = function() {


    const searchTerm = document.getElementById('searchFilter')?.value.toLowerCase().trim() || '';
    const statusFilterValue = document.getElementById('statusFilter')?.value || '';
    const dateFilterValue = document.getElementById('dateFilter')?.value || '';



    const projectRows = document.querySelectorAll('.project-row');
    let visibleCount = 0;
    let totalCount = projectRows.length;



    projectRows.forEach(row => {
      const projectName = (row.getAttribute('data-project-name') || '').toLowerCase();
      const projectDescription = (row.getAttribute('data-project-description') || '').toLowerCase();
      const projectStatus = row.getAttribute('data-project-status') || '';
      const projectStart = row.getAttribute('data-project-start') || '';
      const projectEnd = row.getAttribute('data-project-end') || '';


      // Search filter - search in both name and description
      const searchMatch = !searchTerm ||
        projectName.includes(searchTerm) ||
        projectDescription.includes(searchTerm);

      // Status filter
      const statusMatch = !statusFilterValue || projectStatus === statusFilterValue;

      // Date filter
      let dateMatch = true;
      if (dateFilterValue && projectStart && projectEnd) {
        const today = new Date();
        const todayStr = today.toISOString().split('T')[0];
        const startDate = new Date(projectStart);
        const endDate = new Date(projectEnd);
        const todayDate = new Date(todayStr);

        switch (dateFilterValue) {
          case 'current':
            dateMatch = todayDate >= startDate && todayDate <= endDate;
            break;
          case 'upcoming':
            dateMatch = todayDate < startDate;
            break;
          case 'past':
            dateMatch = todayDate > endDate;
            break;
          default:
            dateMatch = true;
        }
      }

      const shouldShow = searchMatch && statusMatch && dateMatch;



      // Show/hide row based on all filters
      if (shouldShow) {
        row.classList.remove('hidden');
        row.style.display = '';
        visibleCount++;
      } else {
        row.classList.add('hidden');
        row.style.display = 'none';
      }
    });

    updateProjectFilterStats(visibleCount, totalCount);
    updateProjectEmptyState(visibleCount);
  }

  window.updateProjectFilterStats = function(visibleCount, totalCount) {
    const statsElement = document.getElementById('filterStats');
    if (statsElement) {
      if (visibleCount === totalCount) {
        statsElement.textContent = `${totalCount} projet${totalCount !== 1 ? 's' : ''}`;
        statsElement.style.color = '#6c757d';
      } else {
        statsElement.textContent = `${visibleCount} sur ${totalCount} projet${totalCount !== 1 ? 's' : ''}`;
        statsElement.style.color = '#007bff';
        statsElement.style.fontWeight = '600';
      }
    }
  }

  window.updateProjectEmptyState = function(visibleCount) {
    const tableBody = document.getElementById('projectsTableBody');
    if (!tableBody) return;

    // Remove existing empty state row if it exists
    const existingEmptyRow = tableBody.querySelector('.empty-state-row');
    if (existingEmptyRow) {
      existingEmptyRow.remove();
    }

    if (visibleCount === 0) {
      // Check if we have any actual project rows (not including no-projects-row)
      const hasProjects = tableBody.querySelectorAll('.project-row').length > 0;

      if (hasProjects) {
        // Add empty state row for filtered results
        const emptyRow = document.createElement('tr');
        emptyRow.className = 'empty-state-row';
        emptyRow.innerHTML = `
          <td colspan="8" class="no-projects-row">
            <div style="padding: 20px;">
              <div style="font-size: 1.2em; margin-bottom: 10px;">🔍</div>
              <strong>Aucun projet ne correspond aux filtres sélectionnés.</strong>
              <br><small style="color: #6c757d;">Essayez de modifier vos critères de recherche ou 
              <a href="#" onclick="clearAllProjectFilters(); return false;" style="color: #007bff;">effacer les filtres</a>.</small>
            </div>
          </td>
        `;
        tableBody.appendChild(emptyRow);
      }
    }
  }

  // Initialize project filters when DOM is loaded
  window.initializeProjectFilters = function() {

    const searchFilter = document.getElementById('searchFilter');
    const statusFilter = document.getElementById('statusFilter');
    const dateFilter = document.getElementById('dateFilter');


    if (searchFilter) {
      searchFilter.addEventListener('input', function() {
        applyProjectFilters();
      });
    }

    if (statusFilter) {
      statusFilter.addEventListener('change', function() {
        applyProjectFilters();
      });
    }

    if (dateFilter) {
      dateFilter.addEventListener('change', function() {
        applyProjectFilters();
      });
    }

    // Initial filter application - delay to ensure DOM is ready
    setTimeout(() => {
      applyProjectFilters();
    }, 100);
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

 
  // Edit Project Modal Logic
  function editProject(projectId) {
    // Find the row for the project
    var row = document.querySelector('tr[data-project-id="' + projectId + '"]');
    if (!row) return;
    // Reset all fields before populating
    document.getElementById('editProjectForm').reset();
    document.getElementById('edit_project_id').value = projectId;
    document.getElementById('edit_project_nom').value = row.querySelector('.project-name-cell').innerText.trim();
    document.getElementById('edit_project_description').value = row.querySelector('.project-description-cell').innerText.trim();
    document.getElementById('edit_project_date_debut').value = row.querySelectorAll('.project-date-cell')[0].innerText.trim();
    document.getElementById('edit_project_date_fin').value = row.querySelectorAll('.project-date-cell')[1].innerText.trim();
    document.getElementById('editProjectModal').style.display = 'block';
  }

  function closeEditProjectModal() {
    document.getElementById('editProjectModal').style.display = 'none';
  }
