<?php

session_start();
class Profil
{
  private $user_id;
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

  public function update_user($objUser)
  {
    $connect_db = $this->db->connect();
    $sql = "UPDATE INTO users SET (genre,
            numSS,
            lname,
            fname,
            inputEmail,
            inputPassword,
            mobileNum,
            phoneNum,
            inputAddress,
            inputCity,
            inputZip
            ) VALUES 
            (?, ?, ?, ?, ? ,?, ?, ?, ?, ? ,? )";
    //prepare stateement
    $stmt =  $connect_db->prepare($sql);
    $stmt->bind_param(
      "sssssssssss",
      $objUser->getGenre(),
      $objUser->getNumSS(),
      $objUser->getLname(),
      $objUser->getFname(),
      $objUser->getInputEmail(),
      $objUser->getInputPassword(),
      $objUser->getMobileNum(),
      $objUser->getPhoneNum(),
      $objUser->getInputAddress(),
      $objUser->getInputCity(),
      $objUser->getinputZip()
    );
    echo "<script type='text/javascript'>alert('" . $objUser->getGenre(),
    $objUser->getNumSS(),
    $objUser->getLname(),
    $objUser->getFname(),
    $objUser->getInputEmail(),
    $objUser->getInputPassword(),
    $objUser->getMobileNum(),
    $objUser->getPhoneNum(),
    $objUser->getInputAddress(),
    $objUser->getInputCity(),
    $objUser->getinputZip() . "DATA INSERTED');</script>";
    if ($stmt->execute()) {
      echo "<script type='text/javascript'>alert(' DATA INSERTED');</script>";
      return true;
    } else {
      echo "<script type='text/javascript'>alert(' DATA NOT INSERTED');</script>";
      return false;
    }
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