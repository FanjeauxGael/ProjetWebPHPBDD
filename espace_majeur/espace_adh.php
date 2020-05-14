<?php 
// Demarrage session
session_start();

// Head
include('../inc/head_niveau2.php') ;

// Configuration des classes / DAO / BDD
include '../config/init.php';

//On récupère le mail de l'adhérent (pour trouver ses details personnels)
if (isset($_SESSION['mail_inscrit'])) {
	$mail_inscrit = $_SESSION['mail_inscrit'];
  }else{
  header('Location: ../index.php?private=1');
  }
  $adherentDAO = new AdherentDAO();
  $adherent= $adherentDAO->findByMail($mail_inscrit);
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
				<li class="active">Mon espace</li>
			</ol>
		</div>
		
		<!-- TITRE -->
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Mon espace</h1>
			</div>
		</div>
		
		<!--====== INFORMATIONS PERSONNELLES =====-->
		<div class="row">
			<div class="col-lg-12">
				<h2>Mes informations</h2>
			</div>
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Accéder à vos informations personnelles
						<span class="pull-right clickable panel-toggle"><em class="fas fa-toggle-on"></em></span>
					</div>
					<div class="panel-body">
						<table class="table table-hover">
							<tr>
								<th scope="col">Licence</th>
								<th scope="col">Nom</th>
								<th scope="col">Prenom</th>
								<th scope="col">Adresse Mail</th>
								<th scope="col">Adresse</th>
								<th scope="col">Ville</th>
								<th scope="col">Code Postal</th>
								<th scope="col">Date de naissance</th>
							</tr>
							<?php
							echo '<tr>';
							echo '<td>'.$adherent->getLicence_adh().'</td>';
							echo '<td>'.$adherent->getNom_adh().'</td>';
							echo '<td>'.$adherent->getPrenom_adh().'</td>';
							echo '<td>'.$adherent->getMail_inscrit().'</td>';
							echo '<td>'.$adherent->getAdresse_adh().'</td>';
							echo '<td>'.$adherent->getVille_adh().'</td>';
							echo '<td>'.$adherent->getCp_adh().'</td>';
							echo '<td>'.$adherent->getDate_naissance_adh().'</td>';
							echo '</tr>';
							?>
						</table>
					</div>
				</div>
			</div>
		</div><!-- /.row -->
		<!--====== FIN INFORMATIONS PERSONNELLES =====-->

		<!--====== BORDEREAUX =====-->
		<div class="row">
			<div class="col-lg-12">
				<h2>Mes bordereaux</h2>
			</div>
			<div class="col-md-12">
				<div class="panel panel-success">
					<div class="panel-heading">Gérez vos borderaux
						<span class="pull-right clickable panel-toggle"><em class="fas fa-toggle-on"></em></span>
					</div>
					<div class="panel-body">
						<p>Pour lire ou éditer votre bordereau, cliquez sur <strong>"Voir mes borderaux"</strong>.</p>
						<p align='center'><a class="btn btn-primary" href="list_borderaux.php" role="button">Voir mes borderaux »</a></p>
					</div>
				</div>
			</div>
		</div><!-- /.row -->
		<!--====== FIN BORDEREAUX =====-->

	</div><!--/.main-->
	
	<?php 
include('../inc/script_niveau2.php') ; 
?>
		
</body>
</html>