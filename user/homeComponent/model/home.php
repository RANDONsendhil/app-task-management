<?php
class Home
{
  private $user_id;
  private $user_name;
  private $user_address;
  private $db;

  public function __construct(DatabaseConnection $db_conn)
  {
    $this->db = $db_conn;
  }

  public function get_projects()
  {
    // echo "<script>alert('Tâche ajoutée avec succès');</script>";
    //establish database connection
    $connect_db = $this->db->connect();
    $sql = "SELECT * FROM projects";

    if ($listProjects = $connect_db->query($sql)) {
      // echo "<script>alert('Tâche ajoutée avec succès');</script> ";
      return $listProjects;
    } else {
      return false;
    }
    $stmt->close();
    $connect_db->close();
  }
}