<?php
/**
* Formulaire de test de licence pour préremplir
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
    <label for="licence_adh_csv">Saisissez la Licence :</label>
    <input class="form-control" placeholder="Ex. : 170540010556" type="text" name="licence_adh_csv" id="licence_adh_csv" required="required" value="">
  </div>
  
  <input class="form-control btn btn-primary" type="submit" name="submit2" value="Vérifier">
  
  </fieldset>
</form>

<br />
