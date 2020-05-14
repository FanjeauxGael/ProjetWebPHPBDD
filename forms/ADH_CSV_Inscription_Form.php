<?php
/**
* Formulaire inscription Adherents + CSV
*
*/

// Si l'action n'est pas fournie, on la crée avec la valeur par défaut (le formulaire s'appelle lui-même)
if (!isset($action)) {
  $action = '#';
}

if (isset($erreur)) {   
  //Si une erreur est créée, elle s'affichera ici
  echo $erreur;
}

if (isset($message)) {   
  //Si un message est créée, elle s'affichera ici
  echo $message;
}

?>
<form role="form" action="<?php echo $action; ?>" method="post">
<fieldset>
<br />
  <div class="form-group">
    <label for="licence_adh">Licence :</label>
    <input class="form-control" placeholder="Ex. : 170540010556" type="text" name="licence_adh" id="licence_adh" required="required" value="<?php echo $adherent_csv->getLicence_adh_csv(); ?>">
  </div>

  <div class="form-group">
    <label for="nom_adh">Nom :</label>
    <input class="form-control" placeholder="Ex. : Jean" type="text" name="nom_adh" id="nom_adh" required="required" value="<?php echo $adherent_csv->getNom_adh_csv(); ?>">
  </div>

  <div class="form-group">
    <label for="prenom_adh">Prenom : </label>
    <input class="form-control" placeholder="Ex. : Bonneau" type="text" name="prenom_adh" id="prenom_adh" required="required" value="<?php echo $adherent_csv->getPrenom_adh_csv(); ?>">
  </div>

  <div class="form-group">
    <label for="sexe_adh">Selectionnez votre sexe :</label> 
    <select class="form-control" id="sexe_adh" name="sexe_adh" size="1" >
    <?php 
    $sexe = $adherent_csv->getSexe_adh_csv();
    if ($sexe === "M"){
      echo '<option value="F">Femme</option>';
      echo '<option selected="selected" value="H">Homme</option>';
    }elseif($sexe === "F"){
      echo '<option selected="selected" value="F">Femme</option>';
      echo '<option value="H">Homme</option>';
    }else{
    ?>
    <option value="F">Femme</option>
    <option value="H">Homme</option>
    <?php } ?>
    </select>
  </div>

  <div class="form-group">
    <label for="date_naissance_adh">Date de naissance (xxxx/xx/xx) : </label>
    <input class="form-control" type="date" name="date_naissance_adh" id="date_naissance_adh" required="required" value="<?php echo $adherent_csv->getDate_naissance_adh_csv(); ?>">
  </div>

  <div class="form-group">
    <label for="adresse_adh">Adresse :</label>
    <input class="form-control" placeholder="Ex. : 2, rue Picot" type="text" name="adresse_adh" id="adresse_adh" required="required" value="<?php echo $adherent_csv->getAdresse_adh_csv(); ?>">
  </div>

  <div class="form-group">
    <label for="cp_adh">Code postal :</label>
    <input class="form-control" placeholder="Ex. : 31400" type="text" name="cp_adh" id="cp_adh" required="required" value="<?php echo $adherent_csv->getCp_adh_csv(); ?>">
  </div>
  <div class="form-group">
    <label for="ville_adh">Ville :</label>
    <input class="form-control" placeholder="Ex. : Toulouse" type="ville_adh" name="ville_adh" id="ville_adh" required="required" value="<?php echo $adherent_csv->getVille_adh_csv(); ?>">
  </div>
  
  <!-- Si le responsable Legal est connecté, on cache le mail et mot de passe en hidden (les champs seront mis à null) -->
  <?php 
    if (isset($_SESSION['mail_resp_leg'])) {
  ?>

  <div class="form-group">
    <label for="resp_leg">Responsable Legal :</label>
    <input class="form-control" placeholder="" type="text" name="" id="resp_leg" disabled="disabled" required="required" value="<?php echo $responsable_legal->getPrenom_resp_leg() . " ". $responsable_legal->getNom_resp_leg() ; ?>">
    </div>

  <div class="form-group">
    <label for="id_resp_leg"></label>
    <input class="form-control" placeholder="" type="hidden" name="" id="id_resp_leg" required="required" value="<?php echo $id_resp_leg ; ?>">

    <input class="form-control" placeholder="" type="hidden" name="mail_inscrit" id="mail_inscrit" value="">
    <input class="form-control" placeholder="" type="hidden" name="mdp_inscrit" id="mdp_inscrit" value="">
    </div>

  <!-- Sinon -->
  <?php
    } else {
  ?>
  
    <div class="form-group">
      <label for="mail_inscrit">Mail :</label>
      <input class="form-control" placeholder="mail@outlook.fr" type="email" name="mail_inscrit" id="mail_inscrit" required="required" value="">
      </div>

  <div class="form-group">
    <label for="mdp_inscrit">Mot de passe :</label>
    <input class="form-control" placeholder="******" type="password" name="mdp_inscrit" id="mdp_inscrit" required="required" value="">
    </div>

<?php
  }
?>
  <div class="form-group">
    <label for="id_club">Club : </label>
    <select class="form-control" id="id_club" name="id_club">
      <?php
        //Affiche la liste des clubs :
        foreach($clubs as $club){
          echo '<option value="'.$club->getId_club().'">'.$club->getLibelle_club().'</option>';
        }
      ?>
    </select>
    </div>

  <input class="form-control btn btn-primary" type="submit" name="submit" value="S'inscrire">
  
  </fieldset>
</form>

<br />