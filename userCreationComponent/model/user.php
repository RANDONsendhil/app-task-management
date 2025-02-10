<?php

require_once(BASE_PATH . '/config/database.php');
class User
{
  public $genre;
  public $numSS;
  public $lname;
  public $fname;
  public $inputEmail;
  public $inputPassword;
  public $mobileNum;
  public $phoneNum;
  public $inputAddress;
  public $inputCity;
  public $inputZip;


  public function __construct(
    $genre,
    $numSS,
    $lname,
    $fname,
    $inputEmail,
    $inputPassword,
    $mobileNum,
    $phoneNum,
    $inputAddress,
    $inputCity,
    $inputZip,

  ) {

    $this->genre = $genre;
    $this->numSS = $numSS;
    $this->lname = $lname;
    $this->fname = $fname;
    $this->inputEmail = $inputEmail;
    $this->inputPassword = $inputPassword;
    $this->mobileNum = $mobileNum;
    $this->phoneNum = $phoneNum;
    $this->inputAddress = $inputAddress;
    $this->inputCity = $inputCity;
    $this->inputZip = $inputZip;
  }

  function getGenre()
  {
    return $this->genre;
  }

  function getNumSS()
  {
    return $this->numSS;
  }

  function getLname()
  {
    return $this->lname;
  }

  function getFname()
  {
    return $this->fname;
  }

  function getInputEmail()
  {
    return $this->inputEmail;
  }

  function getInputPassword()
  {
    return $this->inputPassword;
  }

  function getMobileNum()
  {
    return $this->mobileNum;
  }

  function getPhoneNum()
  {
    return $this->phoneNum;
  }

  function getInputAddress()
  {
    return $this->inputAddress;
  }

  function getInputCity()
  {
    return $this->inputCity;
  }

  function getinputZip()
  {
    return $this->inputZip;
  }
}