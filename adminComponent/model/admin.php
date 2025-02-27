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
}
