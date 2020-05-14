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
  $annee = date('Y');
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
					<div class="panel-heading">Gestion tarif
						<span class="pull-right clickable panel-toggle"><em class="fas fa-toggle-on"></em></span>
					</div>
					<div class="panel-body">Voici le tarif kilométrique pour l'année <?php echo $annee ; ?>
                    <?php
                        if(isset($_GET["success"])){
                          echo '<p align"center"><strong>Le tarif kilométrique à été mis à jour.</strong></p>';
                        }
              
                        //On prépare les mathodes DAO
                        $indemniteDAO = new IndemniteDAO();
              
                        //On récupère l'indemnité de l'annee
                        $indemnite = $indemniteDAO->findIndemnite($annee);
              
                        //Si l'indemnité est présente dans la BDD
                          if ($indemnite->gettarif_kilometrique() ==! null) {
                              ?>
              
                          <table class='table'>>
                              <tr>
                                  <th>Annee</th>
                                  <th>Tarif Kilométrique</th>
                                  <th>Modifier</th>
                              </tr>
                                  <?php
                                      echo '<tr>';
                                      echo '<td>'.$indemnite->getAnnee().'</td>';
                                      echo '<td>'.$indemnite->getTarif_kilometrique().'</td>';
                                      echo '<td><a href="edit_tarif_km.php?annee='.$indemnite->getAnnee().'">Modifier</a></td>';
                                  ?>
                          </table>
              
                        <?php
                          }else{
                            $annee = date('Y');
                            echo '<p>Vous n\'avez pas encore fixer de tarif kilométrique ! Veuillez fixer un tarif kilométrique pour l\'année '.$annee.'.</p>';
                            echo '<p>Pour modifier le tarif kilométrique, cliquez sur <strong>"Fixer un tarif"</strong>.</p>';
                            echo '<p align="center"><a class="btn btn-primary" href="create_tarif_km.php" role="button">Fixer un tarif »</a></p>';
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