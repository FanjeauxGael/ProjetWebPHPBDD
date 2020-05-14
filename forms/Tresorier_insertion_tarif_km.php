


<?php
/**
* Formulaire Tarif KM
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
  <p>Tarif kilométrique  :<br/><input class="form-control" type="number" step="0.01" name="tarif_kilometrique" required="required"  value="11,50" /></p>
  </div>
  
    <input type="submit" name="submit" value="Enregister" class="form-control btn btn-primary">
    </fieldset>
</form>
