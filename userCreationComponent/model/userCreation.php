<?php
session_start();
class UserCreationModel
{
    private $user_id;
    private $user_name;
    private $user_address;
    private $db;

    public function __construct(DatabaseConnection $db_conn)
    {
        $this->db = $db_conn;
    }

    public function insert_user($objUser)
    {
        //establish database connection
        $connect_db = $this->db->connect();
        $sql = "INSERT INTO users (genre,
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
        $stmt->close();
    }

    // public function display_user($userNumSS)
    // {
    //     echo (" calle here ");
    //     //
    //     $connect_db = $this->db->connect();
    //     $sql = "select * from users where numSS='1'";  // Change the id to retrieve specific record
    //     $resultDisplayUser = $connect_db->query($sql);

    //     $userData = [];


    //     if ($resultDisplayUser->num_rows > 0) {
    //         // Loop through the result and store each row in the array
    //         while ($row = $resultDisplayUser->fetch_assoc()) {
    //             $userData[] = $row;  // Add the row to the array
    //             echo (count($userData));
    //         }
    //     } else {
    //         echo "0 results";
    //     }

    //     $connect_db->close();
    // }
    public function display_user($userNumSS)
    {

        $connect_db = $this->db->connect();
        if ($connect_db->connect_error) {
            die("Connection failed: " . $connect_db->connect_error);
        }
        $sql = "SELECT * FROM users";
        echo (" HERE ");
        $result = $connect_db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }
}
