<?php
require_once(BASE_PATH . '/config/database.php');
class Project
{
  public $nom;
  public $description;
  public $date_debut;
  public $date_fin;
  public $cree_par_user_id;


  public function __construct(
    $nom,
    $description,
    $date_debut,
    $date_fin,
    $cree_par_user_id
  ) {
    $this->nom = $nom;
    $this->description = $description;
    $this->date_debut = $date_debut;
    $this->date_fin = $date_fin;
    $this->cree_par_user_id = $cree_par_user_id;
  }

  function getNom(): string
  {

    return $this->nom;
  }
  function getDescription(): string
  {

    return $this->description;
  }

  function getDateDebut(): string
  {

    return $this->date_debut;
  }

  function getDateFin(): string
  {

    return $this->date_fin;
  }
  function getCreeParUserId(): int
  {

    return $this->cree_par_user_id;
  }
  function setNom($nom)
  {
    $this->nom = $nom;
  }
  function setDescription($description)
  {
    $this->description = $description;
  }
  function setDateDebut($date_debut)
  {
    $this->date_debut = $date_debut;
  }
  function setDateFin($date_fin)
  {
    $this->date_fin = $date_fin;
  }
  function setCreeParUserId($cree_par_user_id)
  {
    $this->cree_par_user_id = $cree_par_user_id;
  }
}
