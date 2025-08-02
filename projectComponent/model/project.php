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

        // Debug: Check if ID is received
        echo "<script>alert('Searching for project with ID: " . $id . "');</script>";

        $stmt = $connect_db->prepare("SELECT * FROM projects WHERE id = ?");
        $stmt->bind_param("i", $id); // "i" means integer
        $stmt->execute();

        $result = $stmt->get_result();

        // Debug: Check number of rows found


        $resultProjectById = $result->fetch_assoc(); // Fetch user data

        echo "<script>
  alert('resultProjectById: " . json_encode($resultProjectById) . "');
   
</script>";
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

    public function reserveAppointment($doctor_RPPS, $user_numSS,  $res_date, $res_time)
    {
        $sql = "INSERT INTO reservation (numSS, id_doctor, date, slot) VALUES (?, ?, ?, ?)";

        $connect_db = $this->db->connect();
        $stmt = $connect_db->prepare($sql);
        $stmt->bind_param("siss", $user_numSS, $doctor_RPPS, $res_date, $res_time);

        // Execute query
        if ($stmt->execute()) {
            $_SESSION['status'] = "success";
            $_SESSION['message'] = "Votre Rendez-vous a éte bien prise en compte";
            return true;
        } else {
            $_SESSION['status'] = "error";
            $_SESSION['message'] = "Error: " . $stmt->error;
            return false;
        }
        $stmt->close();
        $connect_db->close();
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