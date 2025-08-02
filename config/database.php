 <?php
  class DatabaseConnection
  {
    private $host = "localhost";
    private $username = "root";
    private $password = "randon";
    private $database = "app-task-management";
    private $conn;

    public function connect()
    {
      $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
      $this->conn->set_charset("utf8");

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