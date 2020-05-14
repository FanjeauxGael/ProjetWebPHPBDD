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
  
  $indemniteDAO = new IndemniteDAO;
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
				<li class="active">Tarif</li>
			</ol>
		</div>
	
		
		<!--======  =====-->
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Créer tarif
						<span class="pull-right clickable panel-toggle"><em class="fas fa-toggle-on"></em></span>
					</div>
					<div class="panel-body">Ajout du tarif kilométrique
                    <?php
                    $submit = isset($_POST['submit']);

                    if($submit){
                        $annee = date('Y');
                        $tarif_kilometrique = isset($_POST['tarif_kilometrique']) ? $_POST['tarif_kilometrique'] : "";

                        $indemnite =  new Indemnite(array(
                        ":annee" => $annee,
                        ":tarif_kilometrique" => $tarif_kilometrique,
                        ));

                        $nb = $indemniteDAO->insert($annee, $tarif_kilometrique);

                            header('Location: see_tarif_km.php?success=success');
                            
                            // Obligatoire sinon PHP continue à exécuter le script
                            exit;  
                        } else {
                            $erreur = "<p align='center'><strong>Vous n'avez pas saisis toutes les informations ! Veuillez remplir tous les champs svp.</strong></p>";
                        }

                        // Ajout du formulaire d'inscription
                        include '../forms/Tresorier_insertion_tarif_km.php';
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