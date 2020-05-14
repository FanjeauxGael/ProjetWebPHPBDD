<?php

/**
 * Classe d'accès AdherentDAO
 *
 * @author Paco
 */

class NotefraisDAO extends DAO {

    function findAll(){
        $sql = "select * from note_frais";
        $sth = $this->executer($sql);
        $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        $tableau = array();
        foreach ($rows as $row) {
          $tableau[] = new notefrais($row);
        }
        // Retourne un tableau d'objet métier
        return $tableau;
      }

      /*function findAllbynotefraisid($id_note_frais) {
        $sql = "select * from note-frais where salesRepEmployeeNumber=:salesRepEmployeeNumber";
        $params = array(":salesRepEmployeeNumber" => $employeeNumber);
        $sth = $this->executer($sql, $params);
        $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        $tableau = array();
        foreach ($rows as $row) {
          $tableau[] = new Customers($row);
        }
        // Retourne un tableau d\'objet métier
        return $tableau;
      } */

    function insert($licence_adh, $id_club){
        $sql = "insert into note_frais (licence_adh, annee, id_club) values (:licence_adh, YEAR(CURRENT_DATE), :id_club)";

        $params = array(":licence_adh" => $licence_adh,
                        ":id_club" => $id_club);
        $sth = $this->executer($sql, $params);
        $nb = $sth->rowcount();
        // Retourne le nombre de mise à jour
        return $nb;
  }

  function findbylicence($licence_adh){
  $sql ="select * from note_frais where licence_adh = :licence_adh";
  $params = array(":licence_adh" => $licence_adh);
  $sth = $this->executer($sql, $params);
        $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        $tableau = array();
        foreach ($rows as $row) {
          $tableau[] = new notefrais($row);
        }
        // Retourne un tableau d'objet métier
        return $tableau;
      }

      // On récupère l'année signifiant qu'il y a bien un bordereau qui sera crée en fonction de ses adhérents mineurs

  function findBordereauBy($id_resp_leg){

    $sql ="SELECT DISTINCT annee, is_validate
    FROM note_frais, adherent, responsable_legal 
    WHERE note_frais.licence_adh = adherent.licence_adh 
    AND adherent.id_resp_leg = responsable_legal.id_resp_leg
    AND adherent.id_resp_leg = :id_resp_leg
    AND is_validate = 1";

    $params = array(":id_resp_leg" => $id_resp_leg);

    $sth = $this->executer($sql, $params);
          $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
          $tableau = array();
          foreach ($rows as $row) {
            $tableau[] = new notefrais($row);
          }
          // Retourne un tableau d'objet métier
          return $tableau;
        }

  // Fonction pour afficher l'etat des notes de frais de chaques adhérents mineurs
  function findAllNoteFraisOfMineur($id_resp_leg){

    $sql ="SELECT note_frais.licence_adh, annee, is_validate
    FROM note_frais, adherent, responsable_legal 
    WHERE note_frais.licence_adh = adherent.licence_adh 
    AND adherent.id_resp_leg = responsable_legal.id_resp_leg
    AND adherent.id_resp_leg = $id_resp_leg";

    $params = array(":id_resp_leg" => $id_resp_leg);

    $sth = $this->executer($sql, $params);
          $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
          $tableau = array();
          foreach ($rows as $row) {
            $tableau[] = new notefrais($row);
          }
          return $tableau;
  }

  // Fonction pour vérifier si toutes les notes de frais des adhérents mineurs sont validées
  function findIfAllNoteFraisIsValidate($id_resp_leg){

    $sql ="SELECT note_frais.licence_adh, annee, is_validate
    FROM note_frais, adherent, responsable_legal 
    WHERE note_frais.licence_adh = adherent.licence_adh 
    AND adherent.id_resp_leg = responsable_legal.id_resp_leg
    AND adherent.id_resp_leg = $id_resp_leg";

    $params = array(":id_resp_leg" => $id_resp_leg);

    $sth = $this->executer($sql, $params);
          $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
          $tableau = array();
          foreach ($rows as $row) {
            $tableau[] = new notefrais($row);
          }

    $is_validate = false ;
    foreach($tableau as $uneNoteFrais){
      if($uneNoteFrais->getis_validate() == true){
        $is_validate = true ;
      }else{
        $is_validate = false ;
      }
    }
    return $is_validate ;
  }

}