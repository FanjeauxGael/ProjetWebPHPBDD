<?php 
// Demarrage session
session_start();

// Head
include('../inc/head_niveau2.php') ;

// Configuration des classes / DAO / BDD
include '../config/init.php';

if (isset($_SESSION['mail_inscrit'])) {
    // Si l'adhérent MAJEUR est connecté, on récupère son mail stocké en SESSION lors de la connexion
    $mail_inscrit = $_SESSION['mail_inscrit'];
  
    // Et les infos de l'adherent majeur dans $adherent (tableau objet) et notamment sa licence
    $adherentDAO = new AdherentDAO();
    $adherent= $adherentDAO->findByMail($mail_inscrit);
    $licence_adh = $adherent->getLicence_adh();
  }else{
    // Sinon on redirige vers la page d'accueil avec un message d'erreur
    header('Location:../index.php?private=1');
  }
  
  // Récupération des lignes de frais associées à l'ID note frais (du bordereau)
  $lignefraisDAO = new LignefraisDAO;
  $id_note_frais = $_GET['id_note_frais'];
  $lignes = $lignefraisDAO->find($id_note_frais);

?>

<body>

<?php
// Barre verticale avec logo
include('../inc/header.php') ; 

// Barre horizontale de navigation
include('../inc/navbar.php') ;
?>
	<!-- PAGE -->
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

		<!-- BREADCRUMB -->
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
                </a></li>
                <li><a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">
					Frais
				</a></li>
				<li class="active">Visualisation frais</li>
			</ol>
		</div>
		
		<!-- TITRE -->
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Visualisation des frais</h1>
			</div>
		</div>
		
		<!--====== VISUEL FRAIS =====-->
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Licencié : <?php echo $adherent->getPrenom_adh() . ' ' . $adherent->getNom_adh() ;?>
						<span class="pull-right clickable panel-toggle"><em class="fas fa-toggle-on"></em></span>
					</div>
					<div class="panel-body">
                    <?php
                        if (isset($_GET["ligne_ajoutee"])){
                        echo '<p align="center"><strong>Votre frais a bien été ajouté !</strong></p>';
                        }elseif(isset($_GET["ligne_delete"])){
                        echo '<p align="center"><strong>Votre frais a bien été supprimé !</strong></p>';
                        }

                        if (count($lignes) !== 0){
                            echo "<table class='table table-hover'>";
                            echo '<tr>';
                            echo '<th>Date</th>';
                            echo '<th>Libellé du Trajet</th>';
                            echo '<th>Nombre de KM</th>';
                            echo '<th>Cout peage</th>';
                            echo '<th>Cout repas</th>';
                            echo '<th>Cout hebergement</th>';
                            //echo '<th>Modifier</th>';
                            echo '<th>Supprimer</th>';
                            echo '</tr>';

                            foreach ($lignes as $ligne) {
                            echo '<tr>';
                            echo '<td>'. $ligne->getdate_frais() .'</td>';
                            echo '<td>'. $ligne->gettrajet_frais() .'</td>';
                            echo '<td>'. $ligne->getkm_parcourus() .'</td>';
                            echo '<td>'. $ligne->getcout_peage() .'</td>';
                            echo '<td>'. $ligne->getcout_repas() .'</td>';
                            echo '<td>'. $ligne->getcout_hebergement() .'</td>';
                            //echo '<td><a href="modif_ligne.php?id_ligne_frais='.$ligne->getid_ligne_frais().'">Modifier</a></p></td>';
                            echo '<td><a href="delete_ligne.php?id_ligne_frais='.$ligne->getid_ligne_frais().'&id_note_frais='.$id_note_frais.'&licence_adh='. $adherent->getLicence_adh() .'">Supprimer</a></p></td>';
                            echo '</tr>';
                            }
                            echo '</table>';
                        } else {
                        echo '<p align="center">Vous n\'avez pas encore saisie vos lignes de frais.</p>';
                        echo '<p align="center"><a class="btn btn-primary" href="insertion_ligne.php?id_note_frais='.$id_note_frais.'&licence_adh='. $adherent->getLicence_adh() .'" role="button">Ajouter une première ligne de frais »</a></p>';
                        }
                    ?>
					</div>
				</div>
			</div>
		</div><!-- /.row -->
		<!--====== GESTION FRAIS =====-->
	</div><!--/.main-->
	
	<?php 
include('../inc/script_niveau2.php') ; 
?>
		
</body>
</html>