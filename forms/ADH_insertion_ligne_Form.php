<?php
/**
* Formulaire Adherents
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
?>
<form role="form" action="<?php echo $action; ?>" method="post">
<fieldset>

 <div class="form-group">
    <p>Date du Trajet :<br/><input class="form-control" type="Date" name="date_frais" required="required"  value="<?php echo date('Y-m-d'); ?>" /></p>
</div>

  <div class="form-group">
    <p>Nom du Trajet :<br/><input class="form-control" placeholder="Nom du trajet..." name="trajet_frais" required="required"  type="text" value="" /></p>
    </div>

  <div class="form-group">
    <p>Nombre de Kilomètre(s) parcourus :<br/><input class="form-control" placeholder="kilometre parcourus" name="km_parcourus" required="required" type="text" value="" /></p>
    </div>

  <div class="form-group">
    <p>Coût du/des Péage(s)<br/><input class="form-control" placeholder="Frais de peage..." name="cout_peage" required="required"  type="text" value="" /></p>
  </div>

  <div class="form-group">
    <p>Coût du/des Repas<br/><input class="form-control" placeholder="Frais de repas..." name="cout_repas" required="required"  type="text" value="" /></p>
  </div>

  <div class="form-group">
    <p>Coût du/des Hébergement<br/><input class="form-control" placeholder="Frais d'herbergement" name="cout_hebergement" required="required" type="text" value=""/></p>
  </div>

  <div class="form-group">
    <label for="Id_motif">Motifs du Trajet : </label>
    <select class="form-control" id="Id_motif" name="Id_motif"></br>
    <?php
    //Affiche la liste des motifs:
    //print_r($motifs);
    foreach($motifs as $motif){
      echo '<option value="'.$motif->getId_motif().'">'.$motif->getLibelle_motif().'</option>';
    }
    ?>
    </select>
    </div>

    <input type="submit" name="submit" value="Enregister" class="form-control btn btn-primary">
  </fieldset>
</form>
