<?php
/**
* Formulaire de connexion d'un responsable legal
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
    <label for="mail_resp_leg">Mail :</label>
    <input class="form-control" type="text" name="mail_resp_leg" id="mail_resp_leg" placeholder="responsable@outlook.fr" value="">
  </div>

  <br />

  <div class="form-group">
    <label for="mdp_resp_leg">Mot de passe :</label>
    <input class="form-control" type="password" name="mdp_resp_leg" id="mdp_resp_leg" placeholder="0000" value="">
  </div>

  <br/>
    
    <input type="submit" name="submit" class="form-control btn btn-primary" value="Se connecter">

  </fieldset>
</form>

<br />