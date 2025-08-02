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




        $resultProjectById = $result->fetch_assoc(); // Fetch user data

        $stmt->close();
        $connect_db->close();
        return $resultProjectById; // Return user data or null if not found

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

        $stmt = $connect_db->prepare("SELECT * FROM tasks WHERE id = ?");
        $stmt->bind_param("i", $id); // "i" means integer
        $stmt->execute();
        echo "<script>
              alert('resultProjectById: " . json_encode($id) . "');

            </script>";
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $tasks = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            $connect_db->close();
            return $tasks;
        } else {
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
}