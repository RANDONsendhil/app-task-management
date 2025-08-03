<?php
session_start();
class ProjectModel
{

    private $db;

    public function __construct(DatabaseConnection $db_conn)
    {
        $this->db = $db_conn;
    }



    public function get_project_by_id($id)
    {
        $connect_db = $this->db->connect();
        if ($connect_db->connect_error) {
            die("Connection failed: " . $connect_db->connect_error);
        }

        $stmt = $connect_db->prepare("SELECT * FROM projects WHERE id = ?");
        $stmt->bind_param("i", $id); // "i" means integer
        $stmt->execute();

        $result = $stmt->get_result();
        $resultProjectById = $result->fetch_assoc(); // Fetch project data

        if ($resultProjectById) {
            // Store project in session for persistence
            $_SESSION['current_project'] = $resultProjectById;
            $_SESSION['current_project_id'] = $resultProjectById['id'];
            $_SESSION['project_loaded_at'] = date('Y-m-d H:i:s');
        }

        $stmt->close();
        $connect_db->close();
        return $resultProjectById; // Return project data or null if not found
    }

    public function get_all_projects()
    {
        $connect_db = $this->db->connect();
        if ($connect_db->connect_error) {
            die("Connection failed: " . $connect_db->connect_error);
        }

        $stmt = $connect_db->prepare("SELECT * FROM projects");
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $projects = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            $connect_db->close();

            return $projects;
        } else {
            $stmt->close();
            $connect_db->close();
            return [];
        }
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
    public function get_appointments($numSS)
    {
        $connect_db = $this->db->connect();
        if ($connect_db->connect_error) {
            die("Connection failed: " . $connect_db->connect_error);
        }

        $sql = "SELECT r.*, 
        d.full_name, d.specialization,
        d.phone FROM reservation r
        JOIN doctors d ON r.id_doctor = d.id
        WHERE r.numSS = ? LIMIT 5";

        $stmt = $connect_db->prepare($sql);
        $stmt->bind_param("s", $numSS);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }
    function delete_appointment_byId($id)
    {

        $connect_db = $this->db->connect();
        if ($connect_db->connect_error) {
            die("Connection failed: " . $connect_db->connect_error);
        }
        $checkSql = "SELECT id FROM reservation WHERE id = ?";
        $stmt = $connect_db->prepare($checkSql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // ID exists, proceed with deletion
            $stmt->close();

            $deleteSql = "DELETE FROM reservation WHERE id = ?";
            $stmt = $connect_db->prepare($deleteSql);
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                $_SESSION['statusDelete'] = "success";
                $_SESSION['message'] = "Votre réservation à bien été annulé!";
            } else {
                $_SESSION['statusDelete'] = "error";
                $_SESSION['message'] = "Error deleting reservation: " . $stmt->error;
                return true;
            }
        } else {

            return false;
        }

        $stmt->close();
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

    public function get_all_users()
    {
        $connect_db = $this->db->connect();
        if ($connect_db->connect_error) {
            die("Connection failed: " . $connect_db->connect_error);
        }

        $stmt = $connect_db->prepare("SELECT * FROM users");
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $projects = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            $connect_db->close();

            return $projects;
        } else {
            $stmt->close();
            $connect_db->close();
            return [];
        }
    }

    public function get_user_by_id($id)
    {
        $connect_db = $this->db->connect();
        if ($connect_db->connect_error) {
            die("Connection failed: " . $connect_db->connect_error);
        }

        $stmt = $connect_db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id); // "i" means integer
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc(); // Fetch user data

        $stmt->close();
        $connect_db->close();
        return $user; // Return user data or null if not found
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
            $stmt->close();
            $connect_db->close();
            return true; // Task deleted successfully
        } else {
            $stmt->close();
            $connect_db->close();
            return false; // Failed to delete task
        }
    }
}