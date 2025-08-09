 <?php
  class DatabaseConnection
  {
    private $host = "sql309.infinityfree.com";
    private $username = "if0_39660919";
    private $password = "MuIAyGj0QKQ1U";
    private $database = "if0_39660919_gestask";
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