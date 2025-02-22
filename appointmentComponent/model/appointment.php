<?php
session_start();
class AppointementModel
{
    private $user_id;
    private $user_name;
    private $user_address;
    private $db;

    public function __construct(DatabaseConnection $db_conn)
    {
        $this->db = $db_conn;
    }

    public function get_doctors_list()
    {
        //establish database connection
        $connect_db = $this->db->connect();
        $sql = "SELECT * FROM doctors";

        if ($resultDoctors = $connect_db->query($sql)) {
            return $resultDoctors;
        } else {
            return false;
        }
        $stmt->close();
        $connect_db->close();
    }


    public function get_doctor_by_id($docId)
    {

        $connect_db = $this->db->connect();
        if ($connect_db->connect_error) {
            die("Connection failed: " . $connect_db->connect_error);
        }

        $stmt = $connect_db->prepare("SELECT * FROM doctors WHERE id = ?");
        $stmt->bind_param("i", $docId); // "i" means integer
        $stmt->execute();

        $result = $stmt->get_result();
        $resultDoctorByid = $result->fetch_assoc(); // Fetch user data

        $stmt->close();
        $connect_db->close();
        return $resultDoctorByid; // Return user data or null if not found
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
            $_SESSION['message'] = "Reservation added successfully!";
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

        $stmt = $connect_db->prepare("SELECT * FROM reservation WHERE numSS = ? LIMIT 100");
        $stmt->bind_param("s", $numSS);
        $stmt->execute();

        $getUsersAppointments = $stmt->get_result();

        echo "<script>alert('" .   $getUsersAppointments->num_rows . "');</script>";
        $stmt->close();
        $connect_db->close();
        return $getUsersAppointments;
    }
}
