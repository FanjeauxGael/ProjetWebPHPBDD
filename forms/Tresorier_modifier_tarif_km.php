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
  <p>Tarif kilométrique :<br/><input class="form-control" type="numeric" name="tarif_kilometrique" value="<?php echo $indemnite->getTarif_kilometrique(); ?>" /></p>
</div>

  <div class="form-group">
  <p><br/><input class="form-control" type="hidden" name="annee" value="<?php echo $annee; ?>" /></p>
</div>
  
  <input type="submit" name="submit" value="Enregister" class="form-control btn btn-primary">
  </fieldset>
</form>
