<?php
require_once(BASE_PATH . '/config/database.php');
class Task
{
  public $id;
  public $projet_id;
  public $titre;
  public $description;
  public $statut;
  public $assignee_id;
  public $priorite;
  public $date_echeance;
  public $date_creation;
 


  public function __construct(
    $projet_id,
    $titre,
    $description,
    $statut,
    $assignee_id,
    $priorite,
    $date_echeance,
    $date_creation = null,
    $id = null
  ) {
    $this->id = $id;
    $this->projet_id = $projet_id;
    $this->titre = $titre;
    $this->description = $description;
    $this->statut = $statut;
    $this->assignee_id = $assignee_id;
    $this->priorite = $priorite;
    $this->date_echeance = $date_echeance;
    $this->date_creation = $date_creation ? $date_creation : date('Y-m-d H:i:s');
  }

  function getId()
  {
    return $this->id;
  }

  function getProjetId()
  {
    return $this->projet_id;
  } 

  function getTitre()
  {
    return $this->titre;
  }

  function getDescription()
  {
    return $this->description;
  }

  function getStatut()
  {
    return $this->statut;
  }

  function getAssigneeId()
  {
    return $this->assignee_id;
  }

  function getPriorite()
  {
    return $this->priorite;
  }

  function getDateEcheance()
  {
    return $this->date_echeance;
  }
 
  function getDateCreation()
  {
    return $this->date_creation;
  }
 
}
