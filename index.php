<?php 
// Demarrage session
session_start();

// Head
include('inc/head.php') ;

// Configuration des classes / DAO / BDD
include 'config/init.php';

// Restriction liée à la page
include 'inc/user_restriction.php';
?>

<body>

<?php 
// Barre verticale avec logo
include('inc/header.php') ; 

// Barre horizontale de navigation
include('inc/navbar.php') ;
?>
	<!-- PAGE -->
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

		<!-- BREADCRUMB -->
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Home</li>
			</ol>
		</div>
		
		<!-- TITRE -->
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Home</h1>
			</div>
		</div>
		
		<!-- CONTENU PAGE 1 -->
		<div class="panel panel-container">
			<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
				<?php 
						if (isset($_GET['deconnexion'])){
							echo '<p align="center"><strong>Vous vous êtes déconnecté avec succès !</strong></p>';
						}elseif(isset($_GET['private'])){
							echo '<p align="center"><strong>Vous n\'êtes pas autorisé à accéder à cette page. Veuillez vous authentifier.</strong></p>';
						}
						?>
					<div class="panel-heading">Welcome to the "name" website
						<span class="pull-right clickable panel-toggle"><em class="fas fa-toggle-on"></em></span></div>
					<div class="panel-body">
						<p>You are at the home page</p>
					</div>
				</div>
			</div>
			</div><!--/.row-->
		</div>
	</div>	<!--/.main-->
	
	<?php 
include('inc/script.php') ; 
?>
		
</body>
</html>