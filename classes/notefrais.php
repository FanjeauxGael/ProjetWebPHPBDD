<?php

class notefrais {

  private $id_note_frais;
  private $annee;
  private $is_validate;
  private $licence_adh;

  function __construct(array $tableau = null) {
    if ($tableau != null) {
          $this->hydrater($tableau);
   }
  }

  // function get & set
  public function getid_note_frais(){
    return $this->id_note_frais;
   }

   public function setid_note_frais($id_note_frais){
    $this->id_note_frais = $id_note_frais;
   }

   public function getannee(){
    return $this->annee;
   }

   public function setannee($annee){
    $this->annee = $annee;
   }

   public function getlicence_adh(){
    return $this->licence_adh;
   }

   public function setlicence_adh($licence_adh){
    $this->licence_adh = $licence_adh;
   }

   public function getis_validate(){
    return $this->is_validate;
   }

   public function setis_validate($is_validate){
    $this->is_validate = $is_validate;
   }

// hydrateur
function hydrater(array $tableau) {
  foreach ($tableau as $cle => $valeur) {
    $methode = 'set' . $cle;
    if (method_exists($this, $methode)) {
      $this->$methode($valeur);
    }
  }
}




}


?>