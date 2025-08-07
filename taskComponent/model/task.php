<?php
session_start();
class TaskModel
{
    private $user_id;
    private $user_name;
    private $user_address;
    private $db;

    public function __construct(DatabaseConnection $db_conn)
    {
        $this->db = $db_conn;
    }
        public function get_tasks_by_project_id($id)
    {
        $connect_db = $this->db->connect();
        if ($connect_db->connect_error) {
            die("Connection failed: " . $connect_db->connect_error);
        }

        $stmt = $connect_db->prepare("SELECT * FROM tasks WHERE projet_id = ? ORDER BY date_creation DESC");
        $stmt->bind_param("i", $id); // "i" means integer
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $tasks = $result->fetch_all(MYSQLI_ASSOC);
            
            // Store tasks in session for persistence
            $_SESSION['current_project_tasks'] = $tasks;
            $_SESSION['tasks_count'] = count($tasks);
            $_SESSION['tasks_loaded_at'] = date('Y-m-d H:i:s');
            
            $stmt->close();
            $connect_db->close();
            return $tasks;
        } else {
            // Store empty tasks array in session
            $_SESSION['current_project_tasks'] = [];
            $_SESSION['tasks_count'] = 0;
            $_SESSION['tasks_loaded_at'] = date('Y-m-d H:i:s');
            
            $stmt->close();
            $connect_db->close();
            return [];
        }
    }
    

 
    function create_task($objTask){
        $connect_db = $this->db->connect();
        
        if ($connect_db->connect_error) {
            die("Connection failed: " . $connect_db->connect_error);
        }
        
        // Debug: Log the task data being inserted
        error_log("Creating task with data: " . json_encode([
            'projet_id' => $objTask->getProjetId(),
            'titre' => $objTask->getTitre(),
            'description' => $objTask->getDescription(),
            'statut' => $objTask->getStatut(),
            'assignee_id' => $objTask->getAssigneeId(),
            'priorite' => $objTask->getPriorite(),
            'date_echeance' => $objTask->getDateEcheance(),
            'date_creation' => $objTask->getDateCreation()
        ]));
             
        $sql = "INSERT INTO tasks (
            projet_id,
            titre,
            description,
            statut,
            assignee_id,
            priorite,
            date_echeance,
            date_creation
            ) VALUES 
            (?, ?, ?, ?, ?, ?, ?, ?)";
            
        // Prepare statement
        $stmt = $connect_db->prepare($sql);
        
        if ($stmt === false) {
            die("Prepare failed: " . $connect_db->error);
        }
        
        // Validate and sanitize data
        $projet_id = (int)$objTask->getProjetId();
        $titre = substr($objTask->getTitre(), 0, 255); // Limit title length
        $description = $objTask->getDescription();
        $statut = substr($objTask->getStatut(), 0, 50); // Limit status length
        $assignee_id = $objTask->getAssigneeId() ? (int)$objTask->getAssigneeId() : null;
        $priorite = substr($objTask->getPriorite(), 0, 20); // Limit priority length
        $date_echeance = $objTask->getDateEcheance();
        $date_creation = $objTask->getDateCreation();
        
        // Debug: Log the sanitized data
        error_log("Sanitized data: " . json_encode([
            'projet_id' => $projet_id,
            'titre' => $titre,
            'description' => $description,
            'statut' => $statut,
            'assignee_id' => $assignee_id,
            'priorite' => $priorite,
            'date_echeance' => $date_echeance,
            'date_creation' => $date_creation
        ]));
        
        $stmt->bind_param(
            "isssisss",
            $projet_id,
            $titre,
            $description,
            $statut,
            $assignee_id,
            $priorite,
            $date_echeance,
            $date_creation
        );
        

        if ($stmt->execute()) {
            // Update session with task creation info
            $_SESSION['last_task_created'] = [
                'id' => $connect_db->insert_id,
                'projet_id' => $objTask->getProjetId(),
                'titre' => $objTask->getTitre(),
                'created_at' => date('Y-m-d H:i:s')
            ];
            $_SESSION['task_creation_status'] = 'success';
            $_SESSION['task_creation_message'] = 'Tâche créée avec succès';

            $stmt->close();
            $connect_db->close();
            return true;
        } else {
            $error_msg = "Execute failed: " . $stmt->error;
            $_SESSION['task_creation_status'] = 'error';
            $_SESSION['task_creation_message'] = $error_msg;
            
            $stmt->close();
            $connect_db->close();
            error_log($error_msg);
            return false;
        }
    }

    public function update_task($objTask) {
        $connect_db = $this->db->connect();
        
        if ($connect_db->connect_error) {
            die("Connection failed: " . $connect_db->connect_error);
        }
        
        // Debug: Log the task data being updated
        error_log("Updating task with data: " . json_encode([
            'id' => $objTask->getId(),
            'projet_id' => $objTask->getProjetId(),
            'titre' => $objTask->getTitre(),
            'description' => $objTask->getDescription(),
            'statut' => $objTask->getStatut(),
            'assignee_id' => $objTask->getAssigneeId(),
            'priorite' => $objTask->getPriorite(),
            'date_echeance' => $objTask->getDateEcheance()
        ]));
             
        $sql = "UPDATE tasks SET 
            projet_id = ?,
            titre = ?,
            description = ?,
            statut = ?,
            assignee_id = ?,
            priorite = ?,
            date_echeance = ?
            WHERE id = ?";
            
        // Prepare statement
        $stmt = $connect_db->prepare($sql);
        
        if ($stmt === false) {
            die("Prepare failed: " . $connect_db->error);
        }
        
        // Validate and sanitize data
        $id = (int)$objTask->getId();
        $projet_id = (int)$objTask->getProjetId();
        $titre = substr($objTask->getTitre(), 0, 255); // Limit title length
        $description = $objTask->getDescription();
        $statut = substr($objTask->getStatut(), 0, 50); // Limit status length
        $assignee_id = $objTask->getAssigneeId() ? (int)$objTask->getAssigneeId() : null;
        $priorite = substr($objTask->getPriorite(), 0, 20); // Limit priority length
        $date_echeance = $objTask->getDateEcheance();
        
        // Debug: Log the sanitized data
        error_log("Sanitized update data: " . json_encode([
            'id' => $id,
            'projet_id' => $projet_id,
            'titre' => $titre,
            'description' => $description,
            'statut' => $statut,
            'assignee_id' => $assignee_id,
            'priorite' => $priorite,
            'date_echeance' => $date_echeance
        ]));
        
        $stmt->bind_param(
            "isssissi",
            $projet_id,
            $titre,
            $description,
            $statut,
            $assignee_id,
            $priorite,
            $date_echeance,
            $id
        );
        

        if ($stmt->execute()) {
            // Update session with task update info
            $_SESSION['last_task_updated'] = [
                'id' => $id,
                'projet_id' => $objTask->getProjetId(),
                'titre' => $objTask->getTitre(),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $_SESSION['task_update_status'] = 'success';
            $_SESSION['task_update_message'] = 'Tâche mise à jour avec succès';
            
            $stmt->close();
            $connect_db->close();
            return true;
        } else {
            $error_msg = "Update failed: " . $stmt->error;
            $_SESSION['task_update_status'] = 'error';
            $_SESSION['task_update_message'] = $error_msg;
            
            $stmt->close();
            $connect_db->close();
            error_log($error_msg);
            return false;
        }
    }
     

    public function delete_task_by_id($id)
    {   
        $connect_db = $this->db->connect();
        if ($connect_db->connect_error) {
            die("Connection failed: " . $connect_db->connect_error);
        }

        $stmt = $connect_db->prepare("DELETE FROM tasks WHERE id = ?");
        $stmt->bind_param("i", $id); // "i" means integer

        if ($stmt->execute()) {
            $_SESSION['task_deletion_status'] = 'success';
            $_SESSION['task_deletion_message'] = 'Tâche supprimée avec succès';
            $stmt->close();
            $connect_db->close();
            return true; // Task deleted successfully
        } else {
            $error_msg = "suppression échouée: " . $stmt->error;
            $_SESSION['task_deletion_status'] = 'error';
            $_SESSION['task_deletion_message'] = $error_msg;
            $stmt->close();
            $connect_db->close();
            return false; // Failed to delete task
        }
    }
}