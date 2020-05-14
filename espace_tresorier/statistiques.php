<?php
session_start();
// Head
include('../inc/head_niveau2.php') ;

// Configuration des classes / DAO / BDD
include '../config/init.php';

//On récupère le mail de l'adhérent (pour trouver ses details personnels)
if (isset($_SESSION['mail_tresorier'])) {
    $mail_tresorier = $_SESSION['mail_tresorier'];
  }else{
  header('Location: ../index.php?private=1');
  }

$id_club=isset($_GET['id_club']) ? $_GET['id_club'] : '_';


$adherentDAO = new AdherentDAO;
$adherents = $adherentDAO->nb_adh($id_club);

$responsable_legalDAO = new Responsable_legalDAO;
$responsables = $responsable_legalDAO->nb_declarants($id_club);

$lignes_fraisDAO = new LignefraisDAO;
$lignes = $lignes_fraisDAO->nb_deplacements($id_club);

$lignes_fraisDAO = new LignefraisDAO;
$montant_lignes = $lignes_fraisDAO->montant_frais($id_club);

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo APPLINAME ; ?></title>
<link rel="stylesheet" type="text/css" href="css/styles.css" />
</head>
<body>
<h1><?php echo APPLINAME ; ?></h1>
<h2>Comptage des bureaux, employés et clients</h2>
<?php print_r ($montant_lignes);?>
<?php echo "nombre d'adherents : ".count($adherents); ?>
<?php echo '</br>';?>
<?php echo "nombre de déclarants : ".count($responsables); ?>
<?php echo '</br>';?>
<?php echo "Montant des frais : ".$montant_lignes[0]["mt"];?>
<?php echo '</br>';?>
<?php echo "Nombre de déplacements : ".count($lignes); ?>
<?php echo '</br>';?>
<?php echo "Infos déplacements : ".count($responsables); ?>
<?php echo '</br>';?>


  

</body>
</html>
