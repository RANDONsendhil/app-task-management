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
}