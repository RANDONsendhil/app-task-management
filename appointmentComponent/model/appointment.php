<?php

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
    }
}
