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
    header('Location: ../index.php?private=1');
}

$notefraisDAO = new NotefraisDAO();
$notes= $notefraisDAO->findbylicence($licence_adh);
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
				<li class="active">Gestion Bordereaux</li>
			</ol>
		</div>
		
		<!-- TITRE -->
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Voici vos bordereaux</h1>
			</div>
		</div>
		
		<!--====== GESTION FRAIS =====-->
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Licencié : <?php echo $adherent->getPrenom_adh() . ' ' . $adherent->getNom_adh() ;?>
						<span class="pull-right clickable panel-toggle"><em class="fas fa-toggle-on"></em></span>
					</div>
					<div class="panel-body">
                    <?php
                       if (count($notes) !== 0){
                        echo "<table class='table table-hover'";
                        echo '<tr>';
                        echo '<th>Année</th>';
                        echo '<th>Validé</th>';
                        echo '<th>Visualiser vos frais</th>';
                        echo '<th>Ajouter vos frais</th>';
                        echo '<th>Exemplaire en PDF</th>';
                        echo '</tr>';
                    
                        foreach ($notes as $note) {
                          echo '<tr>';
                          echo '<td>'.$note->getannee().'</td>';
                          $validate = $note->getis_validate();
                          if ($validate == 0)
                          {
                              echo '<td>Non</td>';
                              echo '<td><a href="lire_ligne.php?id_note_frais='.$note->getid_note_frais().'">Visualiser</a></td>';
                              echo '<td><a href="insertion_ligne.php?id_note_frais='.$note->getid_note_frais().'">Ajouter</a></td>';
                    
                          } else {
                              echo '<td>Oui</td>';
                              echo '<td>Cette opération n\'est plus disponible</td>';
                              echo '<td><a href="lire_ligne.php?id_note_frais='.$note->getid_note_frais().'">Visualiser</a></td>';
                          }
                    
                    
                          if ($validate == 0)
                          {
                              echo '<td>En attente de validation par le trésorier</td>';
                          } else {
                              echo '<td>Lien en PDF</td>';
                          }
                          echo '</tr>';
                    
                        }
                        echo '</table>';
                    } else {
                        echo 'Voulez vous créer votre premier borderau ?';
                        echo'</br>';echo'</br>';
                        echo '<p><a class="btn btn-primary" href="create_bordereau.php" role="button">Créer un bordereau »</a></p>';
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