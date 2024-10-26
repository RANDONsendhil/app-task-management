<?php
  class Utilisateur{

    protected $user_name;
    protected $user_id;
    protected $user_address;

     
  public function __construct($user_name, $user_id, $user_address){
    $this->user_name = $user_name;
    $this->user_id = $user_id;
    $this->user_address = $user_address;   
  }
 
    public function __destruct(){
      //Du code à exécuter
  }
    public function getUserName(){
      return $this->user_name;      
    }

    public function getUserId(){
      return $this->user_id;      
    }

    public function getUserAddress(){
      return $this->user_address;      
    }

    public function setUserName($user_name){
      $this->user_name = $user_name;      
    }

    public function setUserId($user_id){
      $this->user_id = $user_id;      
    }

    public function setUserAddress($user_address){
      $this->user_address = $user_address;      
    }
  }
?>