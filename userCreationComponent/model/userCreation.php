<?php
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
        if ($stmt->execute()) {
            $_SESSION['statusCreationProfil'] = "success";
            $_SESSION['messageCreationProfil'] = "Votre profil est à jour avec succès";
            return true;
        } else {
            $_SESSION['statusCreationProfil'] = "error";
            $_SESSION['messageCreationProfil'] = "Echec de mise à jour du profil !" . $stmt->error;
            return false;
        }
        $stmt->close();
    }

    public function update_user($objUser)
    {
        //echo "<script type='text/javascript'>alert(' update_user');</script>";
        $connect_db = $this->db->connect();
        $sql = "UPDATE users 
        SET genre = ?, 
            lname = ?, 
            fname = ?, 
            inputEmail = ?, 
            inputPassword = ?, 
            mobileNum = ?, 
            phoneNum = ?, 
            inputAddress = ?, 
            inputCity = ?, 
            inputZip = ? 
        WHERE numSS = ?";

        // Prepare the statement
        $stmt = $connect_db->prepare($sql);

        // Bind parameters to the query ("ssssssssssi" = string, string, string, string, string, string, string, string, string, integer)
        $stmt->bind_param(
            "sssssssssss",
            $objUser->getGenre(),
            $objUser->getLname(),
            $objUser->getFname(),
            $objUser->getInputEmail(),
            $objUser->getInputPassword(),
            $objUser->getMobileNum(),
            $objUser->getPhoneNum(),
            $objUser->getInputAddress(),
            $objUser->getInputCity(),
            $objUser->getinputZip(),
            $objUser->getNumSS()
        );

        if ($stmt->execute()) {
            $_SESSION['statusUpdateProfil'] = "success";
            $_SESSION['message'] = "Votre profil est à jour avec succès";
            return true;
        } else {
            $_SESSION['statusUpdateProfil'] = "error";
            $_SESSION['message'] = "Echec de mise à jour du profil !" . $stmt->error;
            return false;
        }
        $stmt->close();
    }

    public function display_user($userNumSS)
    {

        $connect_db = $this->db->connect();
        if ($connect_db->connect_error) {
            die("Connection failed: " . $connect_db->connect_error);
        }
        $sql = "SELECT * FROM users";
        $result = $connect_db->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
        $stmt->close();
    }

    public function verifyLogin($email, $password)
    {
        $connect_db = $this->db->connect();
        $sql = "SELECT * FROM users WHERE inputEmail = ? AND inputPassword = ?";
        $stmt = $connect_db->prepare($sql);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $userLoginData = $stmt->get_result();

        if ($row = $userLoginData->fetch_assoc()) {
            echo ("<script> alert(" . $row . ") </script>");
            return $row;
        } else {
            return false;
        }
        $stmt->close();
    }
}