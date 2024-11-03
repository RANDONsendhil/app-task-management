<?php
class Utilisateur
{
  private $user_id;
  private $user_name;
  private $user_address;
  private $db;

  public function __construct(DatabaseConnection $db_conn)
  {
    $this->db = $db_conn;
  }

  public function add_user($data_userid,  $data_username, $data_useraddress): bool
  {
    //establish database connection
    $connect_db = $this->db->connect();

    $sql = "INSERT INTO users (idusers, username, useraddress) VALUES (?, ?, ?)";

    //prepare stateement
    $stmt =  $connect_db->prepare($sql);
    $stmt->bind_param("sss", $data_userid,  $data_username, $data_useraddress);

    if ($stmt->execute()) {
      echo "New article inserted successfully!";
      return true;
    } else {
      echo "Error: " . $stmt->error;
      return false;
    }
    // prepare and bind
    $stmt->close();
  }

  public function __destruct()
  {
    //Du code à exécuter
  }
  public function getUserName()
  {
    return $this->user_name;
  }

  public function getUserId()
  {
    return $this->user_id;
  }

  public function getUserAddress()
  {
    return $this->user_address;
  }

  public function setUserName($user_name)
  {
    $this->user_name = $user_name;
  }

  public function setUserId($user_id)
  {
    $this->user_id = $user_id;
  }

  public function setUserAddress($user_address)
  {
    $this->user_address = $user_address;
  }
}
