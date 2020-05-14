<?php 
// Demarrage session
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
  $tresorierDAO = new TresorierDAO();
  $tresorier= $tresorierDAO->findByMail($mail_tresorier);
  
  $id_club = $tresorier->getid_club();
  
  $notefraisDAO = new NotefraisDAO();
  $notes= $tresorierDAO->find_notes($id_club);
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
				<li class="active">Bordereaux</li>
			</ol>
		</div>
	
		
		<!--======  =====-->
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Liste des Bordereaux
						<span class="pull-right clickable panel-toggle"><em class="fas fa-toggle-on"></em></span>
					</div>
					<div class="panel-body">
                    <?php
                        if (count($notes) !== 0){
                            echo "<table class='table'>";
                            echo '<tr>';
                            echo '<th>Année</th>';
                            echo '<th>licence</th>';
                            echo '<th>Validé</th>';
                            echo '<th>Visualiser les frais</th>';
                            echo '<th>Is Validé?</th>';
                            echo '<th>Exemplaire en PDF</th>';
                            echo '</tr>';
                            
                            foreach ($notes as $note) {
                            echo '<tr>';
                            echo '<td>'.$note->getannee().'</td>';
                            echo '<td>'.$note->getLicence_adh().'</td>';
                            $validate = $note->getis_validate();
                            if ($validate == 0)
                            {
                                echo '<td>Non</td>';
                            } else {
                                echo '<td>Oui</td>';
                            }
                            echo '<td><a href="lire_ligne_tresorier.php?id_note_frais='.$note->getid_note_frais().'">Visualiser</a></td>';
                            if ($validate == 0)
                            {
                                echo '<td><a href = "valider_tresorier.php?id_note_frais='.$note->getid_note_frais().'">Valider</a></td>';
                            } else {
                                echo '<td><a href = "unvalidate_tresorier.php?id_note_frais='.$note->getid_note_frais().'">Dé-Valider</a></td>';
                            }
                            echo '<td><a href="../pdf.php?id_note_frais='.$note->getid_note_frais().'">Lien en PDF</a></td>';
                            echo '</tr>';
                            
                            }
                            echo '</table>';
                        } else {
                            echo 'Aucune ligne de frais saisies';
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