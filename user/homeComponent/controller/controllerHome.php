<?php
session_start();
require_once(BASE_PATH . '/config/database.php');
require_once(BASE_PATH . '/user/homeComponent/model/home.php');

class ControllerHome
{
    private $homeModel;
    private $db;
    private $taskModel;
    public function __construct()
    {
        $this->db = new DatabaseConnection();
        $this->homeModel = new Home($this->db);
        require_once(BASE_PATH . '/taskComponent/model/task.php');
        $this->taskModel = new TaskModel($this->db);
    }

    public function index()
    {
        $listProjects = $this->homeModel->get_projects();
    }

    public function controlledisplayProjects()
    {
        $listProjects = $this->homeModel->get_projects();
        require(BASE_PATH . '/user/homeComponent/view/displayHome.php');
    }


    public function controllerDeleteProject($id_project)
    {
        $listProjects = $this->homeModel->get_projects();
        $this->homeModel->delete_project($id_project);
    }

    public function controllerCreateProject($objProject)
    {
        if ($this->homeModel->create_project($objProject)) {
            $listProjects = $this->homeModel->get_projects();
            return true;
        } else {
            return false;
        }
    }
    public function controllerEditProject($id, $objProject)
    {
        if ($this->homeModel->edit_project($id, $objProject)) {
            return true;
        } else {
            return false;
        }
    }

    public function controllerExportProjectToPDF($projectId)
    {
        // Clear any output buffer to prevent FPDF errors
        while (ob_get_level()) {
            ob_end_clean();
        }

        // Get project data
        $project = $this->homeModel->get_project_by_id($projectId);
        if (!$project) {
            return false;
        }

        // Get tasks for this project (using project model)
        require_once(BASE_PATH . '/projectComponent/model/project.php');
        $projectModel = new ProjectModel($this->db);
        $tasks = $this->taskModel->get_tasks_by_project_id($projectId);

        // Get all users for assignee names
        $users = $projectModel->get_all_users();

        // Generate PDF
        $this->generateProjectPDF($project, $tasks, $users);
        return true;
    }

    private function generateProjectPDF($project, $tasks, $users)
    {
        // Include FPDF library
        require_once(BASE_PATH . '/lib/fpdf/fpdf.php');

        // Create user mapping
        $userMap = [];
        foreach ($users as $user) {
            $nom = $user['nom'] ?? '';
            $fullName = trim($nom);

            if (empty($fullName)) {
                $fullName = $user['email'] ?? $user['nom'] ?? 'Utilisateur ' . $user['id'];
            }

            $userMap[$user['id']] = $fullName;
        }

        // Status mappings
        $statusMap = [
            'todo' => 'À faire',
            'in_progress' => 'En cours',
            'completed' => 'Terminée',
            'on_hold' => 'En attente'
        ];

        $priorityMap = [
            'low' => 'Basse',
            'medium' => 'Moyenne',
            'high' => 'Haute',
            'urgent' => 'Urgente'
        ];

        // Generate PDF using FPDF
        $this->createPDFReport($project, $tasks, $userMap, $statusMap, $priorityMap);
    }

    private function createPDFReport($project, $tasks, $userMap, $statusMap, $priorityMap)
    {
        // Clear any existing output
        if (ob_get_length()) {
            ob_clean();
        }

        // Create new PDF document
        $pdf = new FPDF();
        $pdf->AddPage();

        // Set title
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, iconv('UTF-8', 'windows-1252', 'RAPPORT DE PROJET - ' . strtoupper($project['nom'])), 0, 1, 'C');
        $pdf->Ln(5);

        // Project status
        $projectStatus = $this->getProjectStatus($project['date_debut'], $project['date_fin']);
        $statusText = [
            'active' => 'Actif',
            'completed' => 'Terminé',
            'pending' => 'En attente'
        ];

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 8, iconv('UTF-8', 'windows-1252', 'Projet #' . $project['id'] . ' - Statut: ' . $statusText[$projectStatus]), 0, 1);
        $pdf->Ln(5);

        // General Information Section
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 8, iconv('UTF-8', 'windows-1252', 'INFORMATIONS GENERALES'), 0, 1);
        $pdf->SetFont('Arial', '', 10);

        $pdf->Cell(40, 6, 'Nom:', 0, 0);
        $pdf->Cell(0, 6, iconv('UTF-8', 'windows-1252', $project['nom']), 0, 1);

        $pdf->Cell(40, 6, 'Description:', 0, 0);
        $pdf->MultiCell(0, 6, iconv('UTF-8', 'windows-1252', $project['description']));

        $pdf->Cell(40, 6, iconv('UTF-8', 'windows-1252', 'Date début:'), 0, 0);
        $pdf->Cell(0, 6, date('d/m/Y', strtotime($project['date_debut'])), 0, 1);

        $pdf->Cell(40, 6, 'Date fin:', 0, 0);
        $pdf->Cell(0, 6, date('d/m/Y', strtotime($project['date_fin'])), 0, 1);

        $pdf->Cell(40, 6, iconv('UTF-8', 'windows-1252', 'Date création:'), 0, 0);
        $pdf->Cell(0, 6, date('d/m/Y H:i', strtotime($project['date_creation'])), 0, 1);
        $pdf->Ln(5);

        // Task Statistics
        $taskStats = $this->calculateTaskStats($tasks);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 8, iconv('UTF-8', 'windows-1252', 'STATISTIQUES DES TACHES'), 0, 1);
        $pdf->SetFont('Arial', '', 10);

        $pdf->Cell(40, 6, 'Total:', 0, 0);
        $pdf->Cell(0, 6, iconv('UTF-8', 'windows-1252', $taskStats['total'] . ' tâches'), 0, 1);

        $pdf->Cell(40, 6, iconv('UTF-8', 'windows-1252', 'Terminées:'), 0, 0);
        $pdf->Cell(0, 6, $taskStats['completed'], 0, 1);

        $pdf->Cell(40, 6, 'En cours:', 0, 0);
        $pdf->Cell(0, 6, $taskStats['in_progress'], 0, 1);

        $pdf->Cell(40, 6, iconv('UTF-8', 'windows-1252', 'À faire:'), 0, 0);
        $pdf->Cell(0, 6, $taskStats['todo'], 0, 1);

        $pdf->Cell(40, 6, 'En attente:', 0, 0);
        $pdf->Cell(0, 6, $taskStats['on_hold'], 0, 1);
        $pdf->Ln(10);

        // Tasks List
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 8, iconv('UTF-8', 'windows-1252', 'LISTE DÉTAILLÉE DES TÂCHES'), 0, 1);
        $pdf->SetFont('Arial', '', 10);

        if (empty($tasks)) {
            $pdf->Cell(0, 6, iconv('UTF-8', 'windows-1252', 'Aucune tâche trouvée pour ce projet.'), 0, 1);
        } else {
            foreach ($tasks as $index => $task) {
                // Add new page if needed
                if ($pdf->GetY() > 250) {
                    $pdf->AddPage();
                }

                $pdf->SetFont('Arial', 'B', 11);
                $pdf->Cell(0, 8, iconv('UTF-8', 'windows-1252', ($index + 1) . '. ' . $task['titre']), 0, 1);

                $pdf->SetFont('Arial', '', 9);
                $pdf->Cell(20, 5, 'Statut:', 0, 0);
                $pdf->Cell(0, 5, iconv('UTF-8', 'windows-1252', $statusMap[$task['statut']] ?? $task['statut']), 0, 1);

                $pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', 'Priorité:'), 0, 0);
                $pdf->Cell(0, 5, iconv('UTF-8', 'windows-1252', $priorityMap[$task['priorite']] ?? $task['priorite']), 0, 1);

                $pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', 'Assigné à:'), 0, 0);
                $pdf->Cell(0, 5, iconv('UTF-8', 'windows-1252', $userMap[$task['assignee_id']] ?? 'Non assigné'), 0, 1);

                if (!empty($task['date_echeance'])) {
                    $pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', 'Échéance:'), 0, 0);
                    $pdf->Cell(0, 5, date('d/m/Y', strtotime($task['date_echeance'])), 0, 1);
                }

                if (!empty($task['description'])) {
                    $pdf->Cell(20, 5, 'Description:', 0, 0);
                    $pdf->SetX(30);
                    $pdf->MultiCell(0, 5, iconv('UTF-8', 'windows-1252', $task['description']));
                }

                if (!empty($task['date_creation'])) {
                    $pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', 'Créée le:'), 0, 0);
                    $pdf->Cell(0, 5, date('d/m/Y H:i', strtotime($task['date_creation'])), 0, 1);
                }

                $pdf->Ln(3);
            }
        }

        // Footer
        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Cell(0, 5, iconv('UTF-8', 'windows-1252', 'Document généré le ' . date('d/m/Y à H:i')), 0, 1, 'C');
        $pdf->Cell(0, 5, 'Application de Gestion de Projets', 0, 1, 'C');

        // Output PDF
        $filename = 'projet_' . $project['id'] . '_' . $this->sanitizeFilename($project['nom']) . '.pdf';
        $pdf->Output('D', $filename);
    }


    private function calculateTaskStats($tasks)
    {
        $stats = [
            'total' => count($tasks),
            'completed' => 0,
            'in_progress' => 0,
            'todo' => 0,
            'on_hold' => 0
        ];

        foreach ($tasks as $task) {
            switch ($task['statut']) {
                case 'completed':
                    $stats['completed']++;
                    break;
                case 'in_progress':
                    $stats['in_progress']++;
                    break;
                case 'todo':
                    $stats['todo']++;
                    break;
                case 'on_hold':
                    $stats['on_hold']++;
                    break;
            }
        }

        return $stats;
    }

    private function getProjectStatus($dateDebut, $dateFin)
    {
        $today = date('Y-m-d');
        $startDate = date('Y-m-d', strtotime($dateDebut));
        $endDate = date('Y-m-d', strtotime($dateFin));

        if ($today < $startDate) {
            return 'pending';
        } elseif ($today >= $startDate && $today <= $endDate) {
            return 'active';
        } else {
            return 'completed';
        }
    }

    private function sanitizeFilename($filename)
    {
        return preg_replace('/[^a-zA-Z0-9_-]/', '_', $filename);
    }
}
