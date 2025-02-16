<?php

session_start();
class Profil
{
  private $user_id;
  private $user_name;
  private $user_address;
  private $db;

  public function __construct(DatabaseConnection $db_conn)
  {
    $this->db = $db_conn;
  }

  public function insert_user($data_username, $data_useraddress)
  {
    //establish database connection
    $connect_db = $this->db->connect();
    $sql = "INSERT INTO users (username, useraddress) VALUES (?, ?)";
    //prepare stateement
    $stmt =  $connect_db->prepare($sql);
    $stmt->bind_param("ss", $data_username, $data_useraddress);

    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
    $stmt->close();
  }

  public function displayUserList()
  {
    $connect_db = $this->db->connect();
    if ($connect_db->connect_error) {
      die("Connection failed: " . $connect_db->connect_error);
    }

    $sql = "SELECT *  FROM users";
    $result = $connect_db->query($sql);

    if ($result->num_rows > 0) {
      return $result->fetch_all(MYSQLI_ASSOC);
    }
  }


  public function displayUserbyNumSS($numSS)
  {

    $connect_db = $this->db->connect();
    if ($connect_db->connect_error) {
      die("Connection failed: " . $connect_db->connect_error);
    }

    $sql = "SELECT *  FROM users where numSS = $numSS";
    $result = $connect_db->query($sql);

    if ($result->num_rows > 0) {
      return $result->fetch_all(MYSQLI_ASSOC);
    }
  }
}
