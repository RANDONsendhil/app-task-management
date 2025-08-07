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
            $_SESSION['project_creation_status'] = 'success';
            $_SESSION['project_creation_message'] = 'Projet créé avec succès';
            $stmt->close();
            $connect_db->close();

            return $projects;
        } else {
            $_SESSION['project_creation_status'] = 'success';
            $_SESSION['project_creation_message'] = 'Projet créé avec succès';
            $stmt->close();
            $connect_db->close();
            return [];
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

}