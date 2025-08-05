<?php
session_start();
require_once(BASE_PATH . '/config/database.php');
class User
{
  
  public $name;
  public $inputEmail;
  public $inputPassword;
  public $role;
  public $date_creation;

  public function __construct(
    
    $name,
    $inputEmail,
    $inputPassword,
    $role,
    $date_creation
  ) {
    $this->name = $name;
    $this->inputEmail = $inputEmail;
    $this->inputPassword = $inputPassword;
    $this->role = $role;
    $this->date_creation = $date_creation ? $date_creation : date('Y-m-d H:i:s');
  }
  function getName()
  {
    return $this->name;
  }
  function getInputEmail()
  { 
    return $this->inputEmail;
  }

  function getInputPassword()
  {
    return $this->inputPassword;
  }

  function getRole()
  {
    return $this->role;
  }

  function getDateCreation()
  {
    return $this->date_creation;
  }
  } 