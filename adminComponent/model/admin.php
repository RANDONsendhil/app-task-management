<?php
class AdminModel
{
  private $user_id;
  private $user_name;
  private $user_address;
  private $db;

  public function __construct(DatabaseConnection $db_conn)
  {
    $this->db = $db_conn;
  }

  public function verifyAdminLogin($id_admin, $password)
  {
    $connect_db = $this->db->connect();
    $sql = "SELECT * FROM admin WHERE id_admin = ? AND password = ?";
    $stmt = $connect_db->prepare($sql);
    $stmt->bind_param("ss", $id_admin, $password);
    $stmt->execute();
    $userLoginData = $stmt->get_result();

    if ($row = $userLoginData->fetch_assoc()) {

      return $row;
    } else {
      return false;
    }
    $stmt->close();
  }

  public function displayAdminById($id)
  {

    $connect_db = $this->db->connect();
    if ($connect_db->connect_error) {
      die("Connection failed: " . $connect_db->connect_error);
    }

    $sql = "SELECT *  FROM admin where id_admin = '$id'";
    $result = $connect_db->query($sql);

    if ($result->num_rows > 0) {

      return $result->fetch_all(MYSQLI_ASSOC);
    }
  }

  public function updateProfilAdmin($objUserAdmin)
  {
    $connect_db = $this->db->connect();
    $sql = "UPDATE admin 
SET password = ?, fname = ?, lname = ?, email = ?, phone = ?
WHERE id_admin = ?";

    // Prepare the statement
    $stmt = $connect_db->prepare($sql);


    $stmt->bind_param(
      "ssssss",
      $objUserAdmin->getPassword(),
      $objUserAdmin->getFname(),
      $objUserAdmin->getLname(),
      $objUserAdmin->getEmail(),
      $objUserAdmin->getPhoneNum(),
      $objUserAdmin->getId_admin()

    );
    if ($stmt->execute()) {
      $_SESSION['statusUpdateProfilAdmin'] = "success";
      $_SESSION['messageUpdateProfilAdmin'] = "Votre profil ADMIN est à jour avec succès";
      return true;
    } else {
      $_SESSION['statusUpdateProfilAdmin'] = "error";
      $_SESSION['messageUpdateProfilAdmin'] = "Echec de mise à jour du profil Admin!" . $stmt->error;
      return false;
    }
    $stmt->close();
  }

  public function disAppointementUser()
  {
    $connect_db = $this->db->connect();
    $sql = "SELECT 
            u.fname AS Prénom,
            u.lname AS Nom,
            u.numSS AS `Numéro SS`,
            r.date AS Date,
            r.slot AS Créneau,
              r.id AS id_res,
            CONCAT(d.full_name) AS Médecin,
            d.specialization AS Spécialisation
        FROM reservation r
        JOIN users u ON r.numSS = u.numSS
        JOIN doctors d ON r.id_doctor = d.id
        ORDER BY r.date DESC, r.slot ASC";

    // Exécution de la requête
    $result = $connect_db->query($sql);

    // Vérification des résultats
    if ($result->num_rows > 0) {
      return $result;
    } else {
      return;
    }

    // Fermeture de la connexion
    $connect_db->close();
  }

  public function displayDoctors() {}


  public function deleteAppointmentPatientByIdAppoint($id)
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
        $_SESSION['statusDeleteAppointmentAdmin'] = "success";
        $_SESSION['messageDeleteAppointmentAdmin'] = "Le rendez vous patient '" . $id . "' a bien été supprimé!";
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


  public function disAppointementDoctor()
  {
    $connect_db = $this->db->connect();
    if ($connect_db->connect_error) {
      die("Connexion échouée : " . $connect_db->connect_error);
    }

    // Définition de la requête SQL
    $sql = "SELECT 
              r.id, 
              r.date, 
              r.slot, 
              d.id AS doctor_id, 
              d.full_name, 
              d.specialization 
            FROM reservation r
            JOIN doctors d ON r.id_doctor = d.id
            ORDER BY r.date, r.slot";
    $result = $connect_db->query($sql);

    // Vérification des résultats
    if ($result->num_rows > 0) {

      return $result;
    } else {
      return;
    }
  }

  public function deleteAppointmentDoctorByIdAppoint($id)
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
        $_SESSION['statusDeleteAppointmentAdminDoctor'] = "success";
        $_SESSION['messageDeleteAppointmentAdminDoctor'] = "Le rendez Médecin  '" . $id . "' a bien été supprimé!";
        return true;
      } else {
        $_SESSION['statusDelete'] = "error";
        $_SESSION['message'] = "Error deleting reservation: " . $stmt->error;
        return false;
      }
    } else {

      return false;
    }

    $stmt->close();
  }
  public function display_list_users()
  {

    $connect_db = $this->db->connect();
    if ($connect_db->connect_error) {
      die("Connection failed: " . $connect_db->connect_error);
    }
    $query = "SELECT * FROM users";

    // Exécution de la requête
    $result = $connect_db->query($query);
    if ($result->num_rows > 0) {
      return $result;
      $stmt->close();
    } else {
      return [];
    }
  }

  public function modelAdminDeleteUserBynumSS($numSS)
  {
    $connect_db = $this->db->connect();
    if ($connect_db->connect_error) {
      die("Connection failed: " . $connect_db->connect_error);
    }

    $deleteSql = "DELETE FROM users WHERE numSS = ?";
    $stmt = $connect_db->prepare($deleteSql);
    $stmt->bind_param("s", $numSS);

    if ($stmt->execute()) {
      $_SESSION['statusDeleteAdminPatient'] = "success";
      $_SESSION['messageDeleteAdminPatient'] = "Utilsateur " . $numSS . "a bien été supprimé!";
      return true;
    } else {
      $_SESSION['statusDeleteAdminPatient'] = "error";
      $_SESSION['messageDeleteAdminPatient'] = "Error deleting reservation: " . $stmt->error;
      return true;
    }


    $stmt->close();
  }

  public function controllerDisplayListAdmin()
  {
    $connect_db = $this->db->connect();
    $sql = "SELECT * FROM admin";
    $result = $connect_db->query($sql);


    if ($result->num_rows > 0) {
      return $result;
    } else {
      return;
    }

    $connect_db->close();
  }
}
