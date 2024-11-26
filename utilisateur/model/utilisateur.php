<?php

session_start();
class Utilisateur
{
    private $user_id;
    private $user_name;
    private $user_address;
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

    public function fetch_all_users()
    {
        $connect_db = $this->db->connect();
        if ($connect_db->connect_error) {
            die("Connection failed: " . $connect_db->connect_error);
        }
        $sql = "SELECT idusers, username, useraddress FROM users";
        $result = $connect_db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function deleteUserById(int $userid)
    {
        $connect_db = $this->db->connect();
        if (!$connect_db) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $stmt = $connect_db->prepare("DELETE FROM users WHERE idUsers = ?");
        if ($stmt === false) {
            die('Error preparing query: ' . $connect_db->error);
        }
        // Bind the user ID parameter to the prepared statement (i for integer)
        $stmt->bind_param("i", $userid);
        // Execute the query
        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error deleting user: " . $stmt->error;
            return false;
        }

        // Close the prepared statement
        $stmt->close();
    }

    public function modifyUserInfo($userid, $username, $useraddress)
    {
        $connect_db = $this->db->connect();
        $sql = "UPDATE users SET username = ?, useraddress = ? WHERE idusers = ?";
        //prepare stateement
        $stmt =  $connect_db->prepare($sql);
        $stmt->bind_param("ssi", $username, $useraddress, $userid);

        if ($stmt->execute()) {
            return true;
        } else {

            return false;
        }
        // prepare and bind
        $stmt->close();
    }

    public function closeConnection()
    {
        $this->db->close();
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
