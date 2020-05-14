<?php 
// Demarrage session
session_start();

// Head
include('../inc/head_niveau2.php') ;

// Configuration des classes / DAO / BDD
include '../config/init.php';

//On récupère le mail du tresorier (pour trouver ses details personnels)
if (isset($_SESSION['mail_inscrit'])) {
	$mail_inscrit = $_SESSION['mail_inscrit'];
  }else{
  header('Location: ../index.php?private=1');
  }

$adherentDAO = new AdherentDAO();
$adherent= $adherentDAO->findByMail($mail_inscrit);

$licence_adh = $adherent->getLicence_adh();

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
					<em class="fas fa-home"></em>
				</a></li>
				<li class="active">Mes Bordereaux</li>
			</ol>
		</div>
		
		<!-- TITRE -->
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Gestion des bordereaux</h1>
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
                        <h4 align='center'>Vous avez créer votre premier bordereau, cliquez ci-dessous pour le visualiser ou l'éditer : </h4>
                        <p align = 'center'><a class="btn btn-primary" href="list_borderaux.php" role="button">Voir mes borderaux »</a></p>

                        <br />
                        <?php
                        $licence_adh = $adherent->getLicence_adh();
                        $id_club = $adherent->getid_club();
                        $nb1 = $notefraisDAO->insert($licence_adh, $id_club);
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