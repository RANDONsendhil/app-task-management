<?php
session_start();
require_once(BASE_PATH . '/config/database.php');
class UserAdmin
{
  public $id_amdin;
  public $lname;
  public $fname;
  public $email;
  public $password;
  public $phone;


  public function __construct(
    $id_amdin,
    $lname,
    $fname,
    $email,
    $password,
    $phone,


  ) {

    $this->id_amdin = $id_amdin;
    $this->lname = $lname;
    $this->fname = $fname;
    $this->email = $email;
    $this->password = $password;
    $this->phone = $phone;
  }

  function getId_admin()
  {
    return $this->id_amdin;
  }

  function getLname()
  {
    return $this->lname;
  }

  function getFname()
  {
    return $this->fname;
  }

  function getPassword()
  {
    return $this->password;
  }

  function getPhoneNum()
  {
    return $this->phone;
  }

  function getEmail()
  {
    return $this->email;
  }
}
