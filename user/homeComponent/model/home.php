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

  public function create_project($objProject)
  {
    $connect_db = $this->db->connect();
    $stmt = $connect_db->prepare("INSERT INTO projects (nom, description, date_debut, date_fin) VALUES (?, ?, ?, ?)");
    $stmt->bind_param(
      "ssss",
      $objProject->getNom(),
      $objProject->getDescription(),
      $objProject->getDateDebut(),
      $objProject->getDateFin(),
      // $objProject->getCreeParUserId()
    );

    if ($stmt->execute()) {
      $_SESSION['project_creation_status'] = 'success';
      $_SESSION['project_creation_message'] = 'Projet créé avec succès';
      return true;
    } else {
      $_SESSION['project_creation_status'] = 'error';
      $_SESSION['project_creation_message'] = 'Erreur lors de la création du projet';
      return false;
    }
  }

  public function delete_project($id)
  {
    $connect_db = $this->db->connect();
    $stmt = $connect_db->prepare("DELETE FROM projects WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
      $_SESSION['project_deletion_status'] = 'success';
      $_SESSION['project_deletion_message'] = 'Projet supprimé avec succès';
      return true;
    } else {
      $_SESSION['project_deletion_status'] = 'error';
      $_SESSION['project_deletion_message'] = 'Erreur lors de la suppression du projet';
      return false;
    }
  }
  public function get_project_by_id($id)
  {
    $connect_db = $this->db->connect();
    $stmt = $connect_db->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      return $result->fetch_assoc();
    } else {
      return false;
    }
  }

  public function edit_project($id, $objProject)
  {
    $connect_db = $this->db->connect();
    $stmt = $connect_db->prepare("UPDATE projects SET nom = ?, description = ?, date_debut = ?, date_fin = ? WHERE id = ?");
    // Store values in variables first to avoid "passed by reference" error
    $nom = $objProject->getNom();
    $description = $objProject->getDescription();
    $dateDebut = $objProject->getDateDebut();
    $dateFin = $objProject->getDateFin();
    $stmt->bind_param("ssssi", $nom, $description, $dateDebut, $dateFin, $id);

    if ($stmt->execute()) {
      $_SESSION['project_edit_status'] = 'success';
      $_SESSION['project_edit_message'] = 'Projet modifié avec succès';
      return true;
    } else {
      $_SESSION['project_edit_status'] = 'error';
      $_SESSION['project_edit_message'] = 'Erreur lors de la modification du projet';
      return false;
    }
  }
  public function get_projects_collaborateur()
  {
    $connect_db = $this->db->connect();
    $stmt = $connect_db->prepare("SELECT * FROM projects WHERE id IN (SELECT project_id FROM project_collaborateurs WHERE user_id = ?)");
    $stmt->bind_param("i", $_SESSION["user_id"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      return $result->fetch_all(MYSQLI_ASSOC);
    } else {
      return [];
    }
  }
  public function get_id_userCollaborateur($user_name, $email)
  {
    echo ("<script> console.log('User ID found: " .  $user_name . ", " . $email . "'); </script>");
    $connect_db = $this->db->connect();
    $stmt = $connect_db->prepare("SELECT id FROM users WHERE nom = ? AND email = ?");
    $stmt->bind_param("ss", $user_name, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      return $result->fetch_assoc()['id'];
    } else {
      return false;
    }
  }

  public function get_project_by_assigned_id($id)
  {
    $connect_db = $this->db->connect();
    $sql = "
        SELECT DISTINCT p.*
        FROM projects p
        INNER JOIN tasks t ON p.id = t.projet_id
        WHERE t.assignee_id = ?
    ";

    $stmt = $connect_db->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $projects = $result->fetch_all(MYSQLI_ASSOC);
      $stmt->close();
      return $projects;
    } else {
      $stmt->close();
      return [];
    }
  }
}
