<?php 
// Demarrage session
session_start();

// Head
include('../inc/head_niveau2.php') ;

// Configuration des classes / DAO / BDD
include '../config/init.php';

//On récupère le mail du tresorier (pour trouver ses details personnels)
if (isset($_SESSION['mail_tresorier'])) {
	$mail_tresorier = $_SESSION['mail_tresorier'];
  }else{
  header('Location: ../index.php?private=1');
  }
  $tresorierDAO = new TresorierDAO();
  $tresorier= $tresorierDAO->findByMail($mail_tresorier);
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
						<th scope="col">ID</th>
						<th scope="col">Nom</th>
						<th scope="col">Prenom</th>
						<th scope="col">Adresse Mail</th>
					</tr>
					<?php
					echo '<tr>';
					echo '<td>'.$tresorier->getid_tresorier().'</td>';
					echo '<td>'.$tresorier->getnom_tresorier().'</td>';
					echo '<td>'.$tresorier->getprenom_tresorier().'</td>';
					echo '<td>'.$tresorier->getmail_tresorier().'</td>';
					echo '</tr>';
					?>
					</table>
					<br />
					</div>
				</div>
			</div>
		</div><!-- /.row -->
		<!--====== FIN INFORMATIONS PERSONNELLES =====-->


		<!--======  =====-->
		<div class="row">
			<div class="col-lg-12">
				<h2>Editer Bordereau(x)</h2>
			</div>
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">Gérez les bordereaux
						<span class="pull-right clickable panel-toggle"><em class="fas fa-toggle-on"></em></span>
					</div>
					<div class="panel-body">
						<p>Pour valider ou éditer de(s) bordereau(x), cliquez sur <strong>"Borderaux"</strong>.</p>
						<p align='center'><a class="btn btn-primary" href="list_bordereau_tresorier.php" role="button">Borderaux »</a></p>
					</div>
				</div>
			</div>
		</div><!-- /.row -->
		<!--====== =====-->


		<!--======  =====-->
		<div class="row">
			<div class="col-lg-12">
				<h2>Tarif kilométrique</h2>
			</div>
			<div class="col-md-12">
				<div class="panel panel-success">
					<div class="panel-heading">Modifier le tarif kilométrique
						<span class="pull-right clickable panel-toggle"><em class="fas fa-toggle-on"></em></span>
					</div>
					<div class="panel-body">
						<p>Pour modifier le tarif kilométrique, cliquez sur <strong>"Tarif Kilométrique"</strong>.</p>
						<p align='center'><a class="btn btn-primary" href="see_tarif_km.php" role="button">Tarif Kilométrique »</a></p>
					</div>
				</div>
			</div>
		</div><!-- /.row -->


        <div class="row">
			<div class="col-lg-12">
				<h2>Statistiques</h2>
			</div>
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">Accéder aux clubs
						<span class="pull-right clickable panel-toggle"><em class="fas fa-toggle-on"></em></span>
					</div>
					<div class="panel-body">
						<p>Pour afficher les clubs et les statatistiques, appuyez sur<strong>"Liste"</strong>.</p>
						<p align='center'><a class="btn btn-primary" href="list_club_stats.php" role="button">Liste »</a></p>
					</div>
				</div>
			</div>
		</div>
		<!--====== FIN  =====-->

	</div><!--/.main-->
	
	<?php 
include('../inc/script_niveau2.php') ; 
?>
		
</body>
</html>