 
<?php
class DatabaseConnection
{
  private $host = "localhost";
  private $username = "root";
  private $password = "randon";
  private $database = "cnam_php";
  private $conn;

  public function connect()
  {
    $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }

    return $this->conn; // Return the connection for use in other classes
  }

  public function close()
  {
    $this->conn->close();
  }
}
?>