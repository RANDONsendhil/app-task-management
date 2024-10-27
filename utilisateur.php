<?php
class Utilisateur
{

  private $user_name;
  private $user_id;
  private $user_address;
  private $db;


  public function __construct(DatabaseConnection $db_conn, $user_name, $user_id, $user_address)
  {
    $this->db = $db_conn;
    $this->user_name = $user_name;
    $this->user_id = $user_id;
    $this->user_address = $user_address;
  }

  public function add_user(): bool
  {

    //establish database connection
    $connect_db = $this->db->connect();

    $sql = "INSERT INTO users (idusers, username, useraddress) VALUES (?, ?, ?)";

    //prepare stateement
    $stmt =  $connect_db->prepare($sql);

    $data_userid = $this->getUserId();
    $data_username = $this->getUserName();
    $data_useraddress = $this->getUserAddress();

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
