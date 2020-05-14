<?php
/**
* Formulaire de connexion d'un adhérent majeur
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
    <label for="mail_inscrit">Mail :</label>
    <input class="form-control" type="text" name="mail_inscrit" id="mail_inscrit" value="">
  </div>

  <div class="form-group">
    <label for="mdp_inscrit">Mot de passe :</label>
    <input class="form-control" type="password" name="mdp_inscrit" id="mdp_inscrit" value="">
  </div>
  
  <input type="submit" name="submit" class="form-control btn btn-primary" value="Se connecter">

  </fieldset>
</form>

<br />

