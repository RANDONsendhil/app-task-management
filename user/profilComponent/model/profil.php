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

  public function insert_user($objUser)
  { 
    //establish database connection
    $connect_db = $this->db->connect();
    
    // Check if connection is successful
    if ($connect_db->connect_error) {
        echo "<script>alert('Erreur de connexion: " . $connect_db->connect_error . "');</script>";
        return false;
    }
    
    $sql = "INSERT INTO users (nom, email, mot_de_passe, role, date_creation) VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $connect_db->prepare($sql);
    
    $name = $objUser->getName();
    $email = $objUser->getInputEmail();
    $password = $objUser->getInputPassword();
    $role = $objUser->getRole();
    $dateCreation = $objUser->getDateCreation();
 
    $stmt->bind_param("sssss", $name, $email, $password, $role, $dateCreation);

    if ($stmt->execute()) {
       echo "<script>alert('Utilisateur ajouté avec succès');</script>";
       $stmt->close();
       return true;
    } else {
      echo "<script>alert('Erreur SQL: " . $stmt->error . "');</script>";
      $stmt->close();
      return false;
    }
  }

  public function update_user($id, $objUser)
  {
    $connect_db = $this->db->connect();
    
    // Check if connection is successful
    if ($connect_db->connect_error) {
        echo "<script>alert('Erreur de connexion: " . $connect_db->connect_error . "');</script>";
        return false;
    }
    
    $sql = "UPDATE users SET 
          nom = ?,
          email = ?,
          role = ?
          WHERE id = ?";
    
    $stmt = $connect_db->prepare($sql);
    
    if (!$stmt) {
        echo "<script>alert('Erreur de préparation SQL: " . $connect_db->error . "');</script>";
        return false;
    }
    
    $name = $objUser->getName();
    $email = $objUser->getInputEmail();
    $role = $objUser->getRole();
    
    $stmt->bind_param("sssi", $name, $email, $role, $id);

    if ($stmt->execute()) {
      echo "<script>alert('Utilisateur mis à jour avec succès');</script>";
      $stmt->close();
      return true;
    } else {
      echo "<script>alert('Erreur SQL: " . $stmt->error . "');</script>";
      $stmt->close();
      return false;
    }
  }


  public function displayProfils()
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


  public function delete_user($id)
  {
    $connect_db = $this->db->connect();
    $stmt = $connect_db->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function getUserById($id)
  {
    $connect_db = $this->db->connect();
    $stmt = $connect_db->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      return $result->fetch_assoc();
    } else {
      return false;
    }
  }
}
